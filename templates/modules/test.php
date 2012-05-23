<?php

function tp_test_show_test($data, $blockname = 'content') {
    ?>
    <div>It's a test module</div>
    <div>Module test</div>
    <div>Action show</div>
    <h3>Mode test</h2>
    <p>params for template:<pre><?php th_dump($data); ?></pre></p>

    <p>Shown in block <b><?php echo $blockname ?></b></p>
    <?php
}