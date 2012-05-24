<?php

class Collection {

    public $objects;
    public $table_name = '';
    public $class_name = '';

    function __construct($table, $class) {
        $this->table_name = $table;
        $this->class_name = $class;
    }

    public function get($id) {
        $res = $this->getByIdsLoaded(array($id));
        return isset($res[$id]) ? $res[$id] : false;
    }

    public function getByIdsLoaded(array $ids) {
        $tofetch = array();
        $out = array();
        foreach ($ids as $id)
            if (isset($this->objects[$id]))
                $out[$id] = $this->objects[$id];
            else
                $tofetch[] = $id;
        if (count($tofetch)) {
            $query = 'SELECT * FROM `' . $this->table_name . '` WHERE `id` IN (' . implode(',', $tofetch) . ')';
            $data = Database::sql2array($query);
            foreach ($data as $row) {
                $this->objects[$row['id']] = new $this->class_name($row['id'], $row);
                $out[$row['id']] = $this->objects[$row['id']];
            }
        }
        return $out;
    }

}