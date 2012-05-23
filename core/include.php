<?php

$includePathes = array(
    $core_path,
    $core_path . 'modules',
    $core_path . 'modules/write',
    $core_path . 'classes',
    $core_path . 'classes/user',
);
require_once 'Log.php';
set_include_path(get_include_path() . PATH_SEPARATOR . implode(PATH_SEPARATOR, $includePathes));

function __autoload($className) {
    Log::timingplus('autoload');
    require_once($className . '.php');
    Log::timingplus('autoload');
    Log::logHtml('class loaded [' . $className . ']');
}

/*
 * functions
 */

function dpe($dumped_var) {
    die(print_r($dumped_var));
}

function dpr($dumped_var) {
    return dpe($dumped_var);
}