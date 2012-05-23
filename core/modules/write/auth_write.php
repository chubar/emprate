<?php

/**
 * авторизация
 */
class auth_write extends write {

    function process() {
        $success = CurrentUser::authorize_password($_POST['email'], $_POST['password']);
        if ($success) {
            // logged in
            Site::passWrite('auth', 'success');
        } else {
            Site::passWrite('auth', 'fail');
        }
    }

}