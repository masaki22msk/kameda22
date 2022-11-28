<?php
session_start();
$mail = $_POST['mail'];
// $dsn = "mysql:host=localhost; dbname=xxx; charset=utf8";
// $username = "xxx";
// $password = "xxx";
try {
    $pdo = new PDO('mysql:dbname=KASEDASABA;host=localhost;charset=utf8','kame','kamekame');
} catch (PDOException $e) {
    $msg = $e->getMessage();
}

$sql = "SELECT * FROM user WHERE mail = :mail";
$stm = $pdo->prepare($sql);
$stm->bindValue(':mail', $mail);
$stm->execute();
$member = $stm->fetch();
//指定したハッシュがパスワードにマッチしているかチェック
if (password_verify($_POST['password'], $member['password'])) {
    //DBのユーザー情報をセッションに保存
    $_SESSION['id'] = $member['id'];
    $_SESSION['name'] = $member['name'];
    header('refresh:0;http://localhost/kame/popup.html');
    exit();
} else {
    $msg = 'メールアドレスもしくはパスワードが間違っています。';
    $link = '<a href="login_form.html">戻る</a>';
}
?>