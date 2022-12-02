<?php
/**
 * ページ番号リンクの表示
 * @param int $totalPage データの最大件数
 * @param int $page 現在のページ番号
 * @param int $pageRange $pageから前後何件のページ番号を表示するか
 */
function paging2($totalPage, $page = 1, $pageRange = 2){
    
  // ページ番号
  $page = (int) htmlspecialchars($page);
  
  // 前ページと次ページの番号計算
  $prev = max($page - 1, 1);
  $next = min($page + 1, $totalPage);
  
  $nums = []; // ページ番号格納用
  $start = max($page - $pageRange, 2); // ページ番号始点
  $end = min($page + $pageRange, $totalPage - 1); // ページ番号終点
  
  if ($page === 1) { // １ページ目の場合
    $end = $pageRange * 2; // 終点再計算
  }

  // ページ番号格納
  for ($i = $start; $i <= $end; $i++) {
    $nums[] = $i;
  }
  
  //最初のページへのリンク
  if ($page > 1 && $page !== 1){
  	print '<a href="?page=1" title="最初のページへ">« 最初へ</a>';
  } else {
    print '<span>« 最初へ</span>';
  }
  
  // 前のページへのリンク
  if ($page > 1) {
    print '<a href="?page=1" title="前のページへ">&laquo; 前へ</a>';
  } else {
    print '<span>&laquo; 前へ</span>';
  }
  
  // 最初のページ番号へのリンク
  print '<a href="?page=1">1</a>';
  if ($start > $pageRange) print "..."; // ドットの表示
	
  	
  //ページリンク表示ループ
  foreach ($nums as $num) {
    
    // 現在地
    if ($num === $page) {
      print '<span class="current">' . $num . '</span>';
    } else {
      // ページ番号リンク表示
      print '<a href="?page='. $num .'" class="num">' . $num . '</a>';
    }

  }
  
  if (($totalPage - 1) > $end ) print "...";	//ドットの表示
	
  //最後のページ番号へのリンク
  if ($page < $totalPage) {
	  print '<a href="?page='. $totalPage .'">' . $totalPage . '</a>';
  } else {
    print '<span>' . $totalPage . '</span>';
  }
  
  // 次のページへのリンク
  if ($page < $totalPage){
    print '<a href="?page='.$next.'">次へ &raquo;</a>';
  } else {
    print '<span>次へ &raquo;</span>';
  }
  
  //最後のページへのリンク
  if ($page < $totalPage){
  	print '<a href="?page=' . $totalPage . ' title="最後のページへへ">最後へ »</a>';
  } else {
    print '<span>最後へ »</span>';
  }
  
}