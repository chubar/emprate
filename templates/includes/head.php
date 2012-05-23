<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name='yandex-verification' content='6d5d98ee8c3f9cfd' />
    <title><?php echo $config['title']; ?></title>
    <?php
    echo "\n<!--css-->\n";
    foreach ($config['css'] as $css) {
        echo '<link rel="stylesheet" href="' . $css['href'] . '"/>' . "\n";
    }
    echo "\n<!--js-->\n";
    foreach ($config['js'] as $js) {
        echo '<script src="' . $js['href'] . '"></script>' . "\n";
    }
    echo "\n";
    ?>

</head>
