<?php
session_start();
require_once "../php/k_functions.php";
?>
<?php
if(isset($_SESSION['name'])){
  }else{
    header('refresh:0;../login.html');
    exit;
}

$pdo = connectDB(); 



//データベースにあるデータを降順で取得
$regist = $pdo->prepare("SELECT * FROM post ORDER BY id DESC");
$regist->execute();
$popo = $regist->fetchAll(); //$popo = コメント（配列）

//データベースの値の数を取得
$sqlq = "SELECT * FROM post";
$sth = $pdo -> query($sqlq);
$count = $sth -> rowCount(); //データの総数



include "./PrevNext.php";
include "./Numbers.php";

//ダミーデータジェネレータ
function createDummy($length) {
  $dummy = [];
  foreach(array_fill(0, $length, null) as $k => $v) {
    $dummy[] = 'Item ' . ($k + 1);
    
  }
  return $dummy;
}

$items = createDummy($count); //ダミーデータ
// $count = count($items); // データの総数
$perPage = 10; // １ページあたりのデータ件数
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



<div class="col-lg-6 order-1 order-lg-2">
	                <h2>投稿内容一覧</h2>
		            <?php foreach($popo as $loop):?>
		        	    <div>No:<?php echo $loop['id']?></div>
		        	    <div>名前：<?php echo $loop['name']?></div>
		        	    <div>投稿内容：<?php echo $loop['contents']?></div>
		        	<div>------------------------------------------</div>
		            <?php endforeach;?>
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1">
                    <h2>新規投稿</h2>
                    <form  method="post">
                        名前 : <input type="text" name="name1" value=""><br>
                        投稿内容: <input type="text" name="contents1" value=""><br>
                        <button type="submit">投稿</button>
                    </form>
</div>
</div>


<div>
<!-- <?php paging($totalPage, $page); ?> -->
</div>

<div>
<?php paging2($totalPage, $page); ?>
</div>