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
  foreach ($images as $image) {
    echo $image['watch'];
    if(!array_key_last($image)){
      echo ","; // 最後の要素ではないとき
    }
  }
    } catch (Exception $e) {
    echo '<span class="error">エラーがありました。</span><br>';
    echo $e->getMessage();
    exit();
  }
  ?>
