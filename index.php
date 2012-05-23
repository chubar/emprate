<?php

$dev_mode = true;
$core_path = 'core/';
ini_set('display_errors', $dev_mode);

require_once $core_path . 'config.php';
require_once $core_path . 'include.php';
if ($dev_mode) {
    Log::timing('total');
}

try {
    $site = new Site();
    Log::timing('flush');
    $site->flushResponse();
    Log::timing('flush');
} catch (Exception $e) {
    echo "\n" . '<pre>' . $e->getMessage() . "\n" . $e->getTraceAsString();
}
if ($dev_mode) {
    Log::timing('total');
    echo "\n" . Log::getHtmlLog();
}


