<?php
session_start ();
if(isset($_SESSION['name'])){
    //echo "ようこそ、".$_SESSION['name']."さん！";
  }else{
    header('refresh:0;http://localhost/kame/login.html');
    exit;
}
?>
<?php
// データベースユーザ
$user = 'kame';
$password = 'kamekame';
// 利用するデータベース
$dbName = 'kasedasaba';
// MySQLサーバ
$host = 'localhost:3306';
// MySQLのDSN文字列
$dsn = "mysql:host={$host};dbname={$dbName};charset=utf8";
?>
  <?php
  //MySQLデータベースに接続する
  try {
    $pdo = new PDO($dsn, $user, $password);
    // プリペアドステートメントのエミュレーションを無効にする
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    // 例外がスローされる設定にする
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "データベース{$dbName}に接続しました。", "<br>";
    // SQL文を作る（全レコード）
    $sql = "SELECT watch FROM images";
    // プリペアドステートメントを作る
    $stm = $pdo->prepare($sql);
    // SQL文を実行する
    $stm->execute();

    //データを全てimagesに移動する
    $images = $stm->fetchAll();
    // 結果の取得（連想配列で返す）
    $image = [];
  foreach ($images as $image) {
      $image['watch'];
    //if(!array_key_last($image)){
    //  ","; // 最後の要素ではないとき
    //  }
    //,JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT
    $image = json_encode($image,JSON_PRETTY_PRINT);
    //$image = str_replace('¥u0022', '¥¥¥"', $image);
    var_dump($image);
    }
  } catch (Exception $e) {
    echo '<span class="error">エラーがありました。</span><br>';
    echo $e->getMessage();
    exit();
  }
  ?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>health first</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Lato:400,300,700,900" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="calen_link/calendar.css">
  <!-- =======================================================
  * Template Name: Amoeba - v4.8.0
  * Template URL: https://bootstrapmade.com/free-one-page-bootstrap-template-amoeba/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
        <div id="calendar"></div>
			  <!--<script src="calendar.js"></script>-->
        <span id="calenArea"></span>
        <!--<script type="text/javascript" src="calen_link/calendar_test.js"></script>-->
        <script type="text/javascript" src="calen_link/php_test.js"></script>
</body>

</html>