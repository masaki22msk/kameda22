<main>
<h2>登録した部品名一覧</h2>
<?php
require('connect.php');

$page = $_REQUEST['page'];
$start = 10 * ($page-1);
// 部品登録テーブルの部品名の値を降順に取得して$entryに格納
$entry = $db->query('SELECT * FROM post ORDER BY contents DESC LIMIT ?,10');
$entry->bindParam(1,$start, PDO::PARAM_INT);
$entry->execute();
?>
<article>
  <?php while($resister = $entry->fetch()): ?><!-- $entryの値をfetchで1件ずつ取得して$resistorへ格納 -->
    <a href="request.php"><?php print(mb_substr($resister['contents'],0,50)); ?></a>
    <time><?php print($resister['created_at']); ?></time>
    <hr size='3' color="#a9a9a9" width="450" align="left">
  <?php endwhile; ?>
</article>
</main>
