<?php
try { // データーベースtestへ接続
  $db = new PDO('mysql:dbname=kasedasaba;host=localhost;charset=utf8','kame','kame');
} catch (PDOException $e) {
  // 接続できなかったらエラー表示
  echo 'DB接続エラー！:' . $e->getMessage();
}
?>
