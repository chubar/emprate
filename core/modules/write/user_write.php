<?php

/**
 * авторизация
 */
class user_write extends write {

    function process() {
        if (!CurrentUser::$authorized)
            return false;

        if (isset($_FILES['photo'])) {
            if (!$_FILES['photo']['error']) {
                $this->updateUserPhoto($_FILES['photo'], (int) CurrentUser::$id);
            }
        }
    }

    function updateUserPhoto($FILE, $id) {
        $cover_sizes = array(
            array(50, 50, false),
            array(100, 100, false),
            array(250, 250, true)
        );


        //pic_small pic_small_1 pic_big
        $folder = Config::need('static_path') . '/upload/userphoto/' . ($id % 50);
        $filename1 = $folder . '/' . $id . '_small.jpg';
        $filename2 = $folder . '/' . $id . '_normal.jpg';
        $filename3 = $folder . '/' . $id . '_big.jpg';
        @mkdir($folder);
        $thumb = new Thumb();
        try {
            $thumb->createThumbnails($FILE['tmp_name'], array($filename1, $filename2, $filename3), $cover_sizes);
            Database::query('UPDATE `user` SET `has_pic`=1 WHERE `id`=' . $id);
            return true;
        } catch (Exception $e) {
            Database::query('UPDATE `user` SET `has_pic`=0 WHERE `id`=' . $id);
            return false;
        }
    }

}