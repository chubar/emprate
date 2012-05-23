<?php

class CurrentUser {

    public static $authorized = false;
    public static $loaded = false;
    public static $id = false;
    public static $data = false;

    public static function getInfo() {
        if (self::$authorized && self::$loaded) {
            $profile = array(
                'first_name' => self::$data['first_name'],
                'last_name' => self::$data['last_name'],
                'middle_name' => self::$data['middle_name'],
                'authorized' => true,
                'has_pic' => self::$data['has_pic'],
                'pic_small' => '/static/upload/userphoto/' . (self::$id % 50) . '/' . self::$id . '_small.jpg',
                'pic_normal' => '/static/upload/userphoto/' . (self::$id % 50) . '/' . self::$id . '_normal.jpg',
                'pic_big' => '/static/upload/userphoto/' . (self::$id % 50) . '/' . self::$id . '_big.jpg',
                'id' => self::$data['id']
            );
        }else
            $profile = array(
                'authorized' => false,
            );
        return $profile;
    }

    public static function logout() {
        self::remove_cookie();
        self::$authorized = false;
        self::$loaded = false;
    }

    public static function authorize_cookie() {
        $id = isset($_COOKIE['id']) ? max(0, (int) $_COOKIE['id']) : false;
        $sess = isset($_COOKIE['sess']) ? (string) $_COOKIE['sess'] : false;
        if ($sess && $id) {
            $query = 'SELECT * FROM `user` WHERE `id`=' . $id . ' AND `sess`=' . Database::escape($sess) . ' AND `session_expire`>' . time();
            $data = Database::sql2row($query);
            if (count($data) && isset($data['id'])) {
                self::$authorized = true;
                self::load($data);
                return true;
            } else {
                return false;
            }
        }
    }

    public static function authorize_password($email = '', $password = '') {
        $query = 'SELECT * FROM `user` WHERE `email`=' . Database::escape($email) . ' AND `password`=' . Database::escape(md5($password));
        $data = Database::sql2row($query);
        if (count($data) && isset($data['id'])) {
            self::$authorized = true;
            self::load($data);
            self::set_cookie();
            return true;
        } else {
            return false;
        }
    }

    public static function set_cookie() {
        $sess = md5(self::$id . time() . rand(100, 200));
        $expire = time() + 60 * 60 * 24 * 2;
        $query = 'UPDATE `user` SET `sess`=' . Database::escape($sess) . ',`session_expire`=' . $expire . ' WHERE `id`=' . self::$id;
        Database::query($query);
        setcookie('id', self::$id, $expire, '/', '.' . Config::need('www_domain'));
        setcookie('sess', $sess, $expire, '/', '.' . Config::need('www_domain'));
    }

    public static function remove_cookie() {
        $expire = time();
        setcookie('id', '', $expire, '/', '.' . Config::need('www_domain'));
        setcookie('sess', '', $expire, '/', '.' . Config::need('www_domain'));
    }

    public static function load($data = false) {
        if (self::$loaded)
            return true;
        if (!$data) {
            if (self::$id) {
                $query = 'SELECT * FROM `user` WHERE `id`=' . self::$id;
                $data = Database::sql2row($query);
            }
        }
        self::$loaded = true;
        self::$id = isset($data['id']) ? $data['id'] : false;
        self::$data = $data;
    }

}