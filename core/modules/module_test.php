<?php

class module_test extends module {

    function _process($action, $mode) {
        $data = array(
            'test_action' => $action,
            'test_mode' => $mode
        );
        return $data;
    }

}