<html lang="ja">
  <?php include './modules/header.php'; ?>
  <body>
    <main>
      <p class="errorTxt">不正なアクセスです<br>下記のリンクより、該当の店舗をお選びください</p>
      <!-- 各店へのリンク -->
      <div class="shopList">
        <ul>
          <?php
            foreach ( $data['shops'] as $key => $val  ) {
                echo '<li><a href="' . $data['cdn'] . '/?sid=' . $key . '">' . $val . '</li>';
            }
          ?>
        </ul>
      </div>
    </main>
  </body>
</html>