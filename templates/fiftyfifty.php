<?php require_once 'includes/template_helpers.php' ?>
<!DOCTYPE html>
<?php require_once 'includes/head.php'; ?>
<body>
    <div id="wrapper">
        <div id="container">
            <div id="top_block">
                <h1>Employee Rate</h1>
                <?php th_process_block('top'); ?>
            </div>
            <div id="left_block_50">
                <?php th_process_block('content'); ?>
            </div>
            <div id="right_block_50">
                <?php th_process_block('sidebar'); ?>
            </div>
        </div>
    </div>
    <div id="footer_block">
        <?php th_process_block('footer'); ?>
    </div>
</body>
