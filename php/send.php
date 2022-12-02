<!DOCTYPE html>
<meta charset="UTF-8">
<title>掲示板サンプル</title>
<h1>掲示板サンプル</h1>
<section>
    <h2>投稿完了</h2>
    <button onclick="location.href='keijiban.php'">戻る</button>
</section>
 
<!-- 追記ここから -->
<?php

$name = $_POST["name"];
$contents = $_POST["contents"];
date_default_timezone_set('Asia/Tokyo');
$created_at = date("Y-m-d H:i:s");
//DB接続情報を設定します。
$pdo = new PDO(
    "mysql:dbname=kasedasaba;host=localhost","kame","kame",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`")
);

//SQLを実行。
$regist = $pdo->prepare("INSERT INTO post(name, contents, created_at) VALUES (:name,:contents, :created_at)");
$regist->bindParam(":name", $name);
$regist->bindParam(":contents", $contents);
$regist->bindParam(":created_at", $created_at);

$regist->execute();
?>