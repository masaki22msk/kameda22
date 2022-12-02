<?php

include "./PrevNext.php";
include "./Numbers.php";

//ダミーデータジェネレータ
function createDummy($length) {
  $dummy = [];
  foreach(array_fill(0, $length, null) as $k => $v) {
    $dummy[] = 'Item ' . ($k + 1);
    // $dummy[] = $popo[$k]['contents']; 
  }
  return $dummy;
}

$items = createDummy(54); //ダミーデータ
$count = count($items); // データの総数
$perPage = 5; // １ページあたりのデータ件数
$totalPage = ceil($count / $perPage); // 最大ページ数
$page = empty($_GET['page']) ? 1 : (int) $_GET['page']; // 現在のページ

print "<pre>page:" . $page . "\n";
print "count:" . $count . "\n";
print "perPage:". $perPage . "\n";
print "totalPage:" . $totalPage . "</pre>";
?>

<?php
// ページ番号でデータにフィルタかける
function filterData($page, $perPage, $data) {
  return array_filter($data, function($i) use ($page, $perPage) {
    return $i >= ($page - 1) * $perPage && $i < $page * $perPage;
  }, ARRAY_FILTER_USE_KEY);
}

$filterData = filterData($page, $perPage, $items);

print '<ol>';
foreach ($filterData as $data) {
  print '<li>' . $data . '</li>';
}
print '</ol>';
?>

<div>
<!-- <?php paging($totalPage, $page); ?> -->
</div>

<div>
<?php paging2($totalPage, $page); ?>
</div>