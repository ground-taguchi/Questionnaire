<?php

    // URLを取得
    $uri = strtok( $_SERVER['REQUEST_URI'], '?' );
    $dir = pathinfo( $uri, PATHINFO_FILENAME );

    // 関連ファイル読み込み
    require_once __DIR__ . '/common.php';
    require_once __DIR__ . '/db_connection.php';
    require_once __DIR__ . '/libs/autoload.php';

    // 表示する年月を取得
    $dateManager = new DateManager();
    $month = $dateManager->getMonth();
    if ( $month === null ) {
        $yearMonth = $dateManager->getYearMonth();
    } else {
        $yearMonth = $month;
    }
    
    // DBから各種データ取得
    $db = new Database( HOSTNAME, DATABASE, USERNAME, PASSWORD );
    $rows = $db->getSourceChannels( $yearMonth );
    $monthlyCounts = $db->groupedByMonth();
    $advertisingExpenses = $db->getAdvertisingExpenses( $yearMonth );
    $storeSales  = $db->getStoreSales( $yearMonth );
    $shopSummary = $db->getShopSummary( $yearMonth );

    // 取得した流入経路のデータを集計
    $aggregation = new AggregatedSourceChannels( $data['channels'], $data['shops'], $rows );
    $aggregatedData = $aggregation->getAggregatedData();
    $replaceKeyData = ArrayConverter::replaceKeys( $aggregatedData, $data['seq'] );
    $sortKeyData = ArrayConverter::sortKeys( $replaceKeyData, $data['seq'] );

    // 広告費のデータの配列をテーブル表示用配列に変換
    $adExpenses = ArrayConverter::xAdExpenses( $advertisingExpenses );

    // 売上データ
    $result = CalculateData::mergeAndCalculate( $storeSales, $shopSummary );

    // 広告からの売上データ
    $sales = ArrayConverter::xStoreSales( $storeSales );
    $adSales = CalculateData::multiplication( $sortKeyData, $sales );
    $adList  = $adExpenses;
    ArrayConverter::overwriteArray( $adList, $adSales );

    // ROASデータ
    $roas = CalculateData::division( $adList, $adExpenses );








