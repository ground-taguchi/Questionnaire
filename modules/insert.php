<?php

    $ad   = $_POST['ad'];
    $shop = $_POST['shop'];

    if( !empty( $ad ) ){

        require_once("./db_connection.php");
        require_once __DIR__ . '/libs/autoload.php';

        $db = new Database( HOSTNAME, DATABASE, USERNAME, PASSWORD );
        
        $msg = $db->insertSourceChannel( $ad, $shop );

    }

?>
<html lang="ja">
    <?php include './header.php'; ?>
    <body>    
        <main>
            <p class="completeTxt">
                <?php echo $msg; ?><br>
                5秒後に自動的にアンケート画面にもどります<br><br>
                自動でページが遷移しない場合は<a href="<?php echo $data['cdn'] . '?sid=' . $_GET['sid']; ?>">こちら</a>
            </p>
            <script> $(document).ready( function() { handleRedirect(); } );</script>
        </main>
    </body>
</html>