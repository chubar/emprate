<?php

class User extends CollectionObject {

    function init() {
        $this->table_name = 'user';
    }

    function getInfo() {
        $this->load();
        if ($this->loaded) {
            $profile = array(
                'first_name' => $this->data['first_name'],
                'last_name' => $this->data['last_name'],
                'middle_name' => $this->data['middle_name'],
                'authorized' => true,
                'has_pic' => $this->data['has_pic'],
                'pic_small' => '/static/upload/userphoto/' . ($this->id % 50) . '/' . $this->id . '_small.jpg',
                'pic_normal' => '/static/upload/userphoto/' . ($this->id % 50) . '/' . $this->id . '_normal.jpg',
                'pic_big' => '/static/upload/userphoto/' . ($this->id % 50) . '/' . $this->id . '_big.jpg',
                'id' => $this->data['id']
            );
        }else
            $profile = array(
                'authorized' => false,
            );
        return $profile;
    }

}