<html lang="ja">
    <?php include('../modules/data_page.php'); ?> 
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $data['page'][$dir]; ?></title>
        <meta name="description" content="">
        <link rel="stylesheet" href="./css/style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=RocknRoll+One&display=swap" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="<?php echo $data['cdn']; ?>js/common.js"></script>
    </head>
    <body>
        <main>
            <section class="headBox">
                <h1 class="rocknrollRegular">KGP流入経路 アンケート結果</h1>
                <div class="selectMonth"><?php CreateHtmlTag::generateForm( $monthlyCounts, $yearMonth ); ?></div>
            </section>
            <?php 
                $createTblSets = [
                    'agg' => $sortKeyData,
                    'ad' => $roas
                ];
                foreach ( $createTblSets as $clskey => $param ) {

                    if ( $clskey == 'ad' ) {

                        echo '<section class="headBox"><h2>ROAS</h2></section>';

                    }

                    echo '<section class="contents"><div class="sticky">';

                    $aggregateTable = new CreateHtmlTag( $param );
                    $aggregateTable->renderTable( $clskey,'sum' );

                    echo '</div></section>';

                }
            ?>
            <script> $(document).ready( function() { formatAdTable(); autoSubmitOnChange('select[name="month"]'); } ); </script>
        </main>
    </body>
</html>