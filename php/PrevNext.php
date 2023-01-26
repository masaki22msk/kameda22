<?php
/**
 * 前後ページへのリンク表示
 * @param int $totalPage 最大ページ数
 * @param int $page 現在のページ番号
 */
function paging($totalPage, $page = 1){
  $page = (int) htmlspecialchars($page);

  $prev = max($page - 1, 1); // 前のページ番号
  $next = min($page + 1, $totalPage); // 次のページ番号

  if ($page != 1) { // 最初のページ以外で「前へ」を表示
    print '<a href="?page=' . $prev . '">&laquo; 前へ</a>';
  }
  if ($page < $totalPage){ // 最後のページ以外で「次へ」を表示
    print '<a href="?page=' . $next . '">次へ &raquo;</a>';
  }

  /*確認用*/
  print "<pre>current:".$page."\n";
  print "next:".$next."\n";
  print "prev:".$prev."</pre>";
}
?>
