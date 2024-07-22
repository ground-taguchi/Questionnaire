<head>

    <?php

        $uri = strtok($_SERVER['REQUEST_URI'], '?');
        $dir = pathinfo($uri, PATHINFO_FILENAME);

        include __DIR__ . '/common.php';

        $css = $data['cdn'] . "css/style.css";
        $js  = $data['cdn'] . "js/common.js";
        $ico = $data['cdn'] . "favicon.ico";
        $ico192 = $data['cdn'] . "image/android-chrome-192x192.png";
        $ico152 = $data['cdn'] . "image/apple-touch-icon-152x152.png";

    ?>    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $data['page'][$dir]; ?></title>        
    <meta name="description" content="">
    <link rel="icon" href="<?php echo $ico; ?>">
    <link rel="icon" href="<?php echo $ico192; ?>" sizes="192x192">
    <link rel="apple-touch-icon" href="<?php echo $ico152; ?>" sizes="152x152">
    <link rel="stylesheet" href="<?php echo $css; ?>">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="<?php echo $js; ?>"></script>

</head>