<?php
//SQL文を変数にいれる。$count_sqlはデータの件数取得に使うための変数。
require_once('../php/k_functions.php');
$pdo = connectDB();
$count_sql = 'SELECT COUNT(*) as cnt FROM post';

//ページ数を取得する。GETでページが渡ってこなかった時(最初のページ)のときは$pageに１を格納する。
if(isset($_GET['page']) && is_numeric($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 1;
}

//最大ページ数を取得する。
//５件ずつ表示させているので、$count['cnt']に入っている件数を５で割って小数点は切りあげると最大ページ数になる。
$counts = $database -> query($count_sql);
$count = $counts -> fetch(PDO::FETCH_ASSOC);
$max_page = ceil($count['cnt'] / 5);

if($page == 1 || $page == $max_page) {
    $range = 4;
} elseif ($page == 2 || $page == $max_page - 1) {
    $range = 3;
} else {
    $range = 2;
}

$from_record = ($page - 1) * 5 + 1;

if($page == $max_page && $count['cnt'] % 5 !== 0) {
    $to_record = ($page - 1) * 5 + $count['cnt'] % 5;
} else {
    $to_record = $page * 5;
}

?>