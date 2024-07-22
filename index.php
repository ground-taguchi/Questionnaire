<html lang="ja">
    <?php include './modules/header.php'; ?>
    <body>    
        <main>
            <div class="form-wrapper">
                <!--<h1>
                    <?php echo '
                        <source srcset="./image/logo'.$shopId.'.webp" type="image/webp">
                        <img src="./image/logo'.$shopId.'.png" alt="'.$shopName.'ロゴ">
                    '; ?>
                </h1>-->
                <form id="selectChannel" method="post" action="./modules/insert.php?sid=<?php echo $shopId; ?>">
                    <div class="box shopLogoSelect">
                        <!--<h2>ご来店ありがとうございました。<br>本日はどちらをご覧頂きましたでしょうか？</h2>-->
                        <div class="flex-wrap over3cell">
                            <?php
                                $max = count( $data['channels'] );
                                for ( $i = 0; $i <= $max; $i ++ ) {
                                    if ( $i == $max ) {
                                        echo '<div class="flex-box"></div>';
                                    } else {
                                        echo '
                                            <div class="flex-box"><input type="radio" name="ad" id="ad-'.$i.'" value="'.$data['channels'][$i].'" required><label for="ad-'.$i.'"><img src="./image/'.$data['files'][$i].'.png" alt="'.$data['channels'][$i].'" class="photo"></label></div>
                                        ';
                                    }
                                }
                            ?>
                        </div>
                    </div>
                    <input type="hidden" name="shop" value="<?php echo $shopName; ?>">
                    <!-- <div class="formBtn"><button type="submit" id="submit-btn">登録</button></div> -->
                </form>
            </div>
        </main>
        <script> $(document).ready( function() { handleRadioClick(); } ); </script>
    </body>
</html>