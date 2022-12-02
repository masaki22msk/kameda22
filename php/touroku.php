<!DOCTYPE html>
<html lang="ja">
<head>
<!-- <meta  http-equiv="Refresh" content="5;URL=../login.html"> -->
<title>レコード追加</title>
<link href="../../../css/style.css" rel="stylesheet">
<!-- テーブル用のスタイルシート -->
<link href="../../css/tablestyle.css" rel="stylesheet">
</head>

<body>
<div>
  <?php
  $gobackURL = "login.html";
  $name = $_POST['name'];
  $age = $_POST['age'];
  $sex = $_POST['sex'];
  $mail = $_POST['mail'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  //MySQLデータベースに接続する

  if( filter_var( $mail,FILTER_VALIDATE_EMAIL) ){

    try {
      $pdo = new PDO('mysql:dbname=KASEDASABA;host=localhost;charset=utf8','kame','kame');
      // プリペアドステートメントのエミュレーションを無効にする
      $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      // 例外がスローされる設定にする
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      // SQL文を作る
      $sql = "INSERT INTO user (name, age, sex, mail, password) VALUES (:name, :age, :sex, :mail, :password)";
      // プリペアドステートメントを作る
      $stm = $pdo->prepare($sql);
      // プレースホルダに値をバインドする
      $stm->bindValue(':name', $name, PDO::PARAM_STR);
      $stm->bindValue(':age', $age, PDO::PARAM_INT);
      $stm->bindValue(':sex', $sex, PDO::PARAM_STR);
      $stm->bindValue(':mail', $mail, PDO::PARAM_STR);
      $stm->bindValue(':password', $password, PDO::PARAM_STR);
      // SQL文を実行する
      if ($stm->execute()){
        // レコード追加後のレコードリストを取得する
        $sql = "SELECT * FROM user";
        // プリペアドステートメントを作る
        $stm = $pdo->prepare($sql);
        // SQL文を実行する
        $stm->execute();
        header('refresh:0;../popup_touroku.html');
        

      } else {
        echo '<span class="error">追加エラーがありました。</span><br>';
      };
    } catch (Exception $e) {
      header('refresh:0;../popup_touroku3.html');
      echo $e->getMessage();
    }
  }else{
    //メールアドレスが正しくなかった場合
    header('refresh:0;../popup_touroku2.html');
  }
  ?>

<!-- １，同じメールアドレスが使えないように改造 -->