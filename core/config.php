<?php

class Config {

    private static $config = array(
        'www_folder' => '',
        'www_domain' => 'emprate.ru',
        'templates_root' => 'templates',
        'dbname' => 'emprate',
        'dbuser' => 'root',
        'dbhost' => 'localhost',
        'dbpass' => '2912',
    );

    public static function need($field, $default = false) {
        return isset(self::$config[$field]) ? self::$config[$field] : $default;
    }

    public static function set($field, $value) {
        self::$config[$field] = $value;
    }

}