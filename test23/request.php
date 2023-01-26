<main>
<h2>登録した部品名の詳細画面</h2>
<?php
require('connect.php');
  //安全に処理するためにprepareとREQUEST変数で処理する
$Data = $db->prepare('SELECT * FROM post WHERE id=? ORDER BY id DESC');
$Data->execute(array($_REQUEST['id']));
$hyouji = $Data->fetch();
?>
<article>
  <pre><?php print($hyouji['contents']);?></pre>
  <a href="index.php">一覧画面へ戻る</a>
</article>
</main>
