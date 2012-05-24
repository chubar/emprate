<?php

class Users {

    private static $instance = false;

    public static function getInstance() {
        return self::$instance ? self::$instance : new Collection('user', 'User');
    }

}