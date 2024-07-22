<?php

    // ランダム処理
    // require_once __DIR__ . '/libs/helpers.php';

    $ini  = __DIR__ . '/config.ini';
    $data = parse_ini_file( $ini );

    function redirectToError() {

        header( "Location://oidemo.kyotogp.com/roas/error.php" );
        exit;

    }

    $shopId = $_GET['sid'];
    if ( is_numeric( $shopId )  ) {
        
        
        // ランダム処理
        // $shuffler = new ArrayShufflers( $data['channels'], $data['files'] );
        // $shuffler->shuffle();
        // $shuffledChannels = $shuffler->getFirstSet();
        // $shuffledFiles    = $shuffler->getSecondSet();
        
        $shopName = $data['shops'][$shopId];
        $logoFile = $data['files'][4].$shopId;
        $data['files'][4] = $logoFile;
        if ( isset( $shopName ) ) {
       
            return [ $shopId, $shopName, $logoFile ];

        } else {

            redirectToError();

        }

    } else {

        if ( $dir != 'error' && $dir != 'data' ) {
            
            redirectToError();

        }

    }
