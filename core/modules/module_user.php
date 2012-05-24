<?php

class module_user extends module {

    function _process($action, $mode) {
        $data = array();
        switch ($action) {
            case 'show':
                switch ($mode) {
                    case 'login':
                        $data = $this->getCurrentUserLoginInfo();
                        break;
                    case 'logout':
                        CurrentUser::logout();
                        break;
                    case 'profile':
                        $data = $this->showProfile();
                        break;
                }
                break;
            case 'edit':
                switch ($mode) {
                    case 'profile':
                        $data = $this->showProfile();
                        break;
                }
                break;
        }

        return $data;
    }

    function getCurrentUserLoginInfo() {
        return CurrentUser::getInfo();
    }

    function showProfile() {
        $user_id = CurrentUser::$id;
        $user_nick = false;
        $uri_params = array_values(Site::$request_uri_array);
        if (isset($uri_params[1])) {
            if (is_numeric($uri_params[1])) {
                $user_id = $uri_params[1];
            } else {
                $user_nick = $uri_params[1];
            }
        }

        if (!$user_id) {
            if ($user_nick) {
                $user_id = Database::sql2single('SELECT `id` FROM `user` WHERE `nickname`=' . Database::escape($user_nick));
                if (!$id)
                    return false;
            }else
                return false;
        }
        $user = Users::getInstance()->get($user_id);
        return $user->getInfo();
    }

}