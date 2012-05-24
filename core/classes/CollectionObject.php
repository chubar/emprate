<?php

class CollectionObject {

    public $id;
    public $data;
    public $loaded = false;
    public $table_name = false;
    

    function __construct($id, $data = false) {
        $this->init();
        $this->id = $id;
        if ($data)
            $this->load($data);
    }

    function init() {
        throw new Exception('Must be implemented');
    }

    public function load($data = false) {
        if ($data && is_array($data)) {
            $this->loaded = true;
            $this->data = $data;
            return true;
        }
        $query = 'SELECT * FROM WHERE `id`=' . $this->id;
    }

}