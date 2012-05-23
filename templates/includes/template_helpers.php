<?php
/**
 *
 */
global $write;
global $data;
global $config;

function th_process_block($block) {
    global $data;
    global $write;
    if (isset($data[$block])) {
        echo "\n<!--block " . $block . '-->' . "\n";
        foreach ($data[$block] as $module) {
            echo "\n<!--" . $module['module'] . '/' . $module['action'] . '/' . $module['mode'] . '-->' . "\n";
            $funcName = 'tp_' . $module['module'] . '_' . $module['action'] . '_' . $module['mode'];
            Log::timing('template [' . $funcName . ']');
            require_once (Config::need('templates_root') . '/modules/' . $module['module'] . '.php');
            if (function_exists($funcName)) {
                th_before_process_block($module['result'], $write);
                eval('echo ' . $funcName . '($module[\'result\']);');
                th_after_process_block($module['result']);
            }
            else
                echo ('missed function ' . $funcName . '($data) ');
            Log::timing('template [' . $funcName . ']');
        }
    }
}

function th_before_process_block(&$data, $write) {
    $data['write'] = $write;
}

function th_after_process_block($data) {
    
}

function th_dump($data) {
    ?>
    <p>params for template:<pre><?php print_r($data); ?></pre></p>
    <?php
}