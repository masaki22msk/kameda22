<?php
define('MAX','25'); // 1ページの記事の表示数
require('connect.php');

$entry = $db->query('SELECT * FROM post ORDER BY created_at DESC');
$entry->execute();
$post = $entry->fetchAll(); //$post= 全部の情報
$count = COUNT($post);//データの総数を取得

$max_page = ceil($count / MAX); // トータルページ数※ceilは小数点を切り捨てる関数
 
if(!isset($_GET['page_id'])){ // $_GET['page_id'] はURLに渡された現在のページ数
    $now = 1; // 設定されてない場合は1ページ目にする
}else{
    $now = $_GET['page_id'];
}
 
$start_no = ($now - 1) * MAX; // 配列の何番目から取得すればよいか


// array_sliceは、配列の何番目($start_no)から何番目(MAX)まで切り取る関数
$disp_data = array_slice($post, $start_no, MAX, true);
 

foreach($disp_data as $val){ // データ表示
    // echo $post[$r]['name']. '　'.$post[$r]['contents']. '<br />'; 
    echo $val['name']. '　'.$val['contents']. '<br />';
    

}

echo '全件数'. $count. '件'. '　'; // 全データ数の表示です。
 
 if($now > 1){ // リンクをつけるかの判定
    // $now = $now - 1;
    echo '<a href="/kame/test2023/test.php?page_id='.$now .'" >前へ</a>'. '　';
 } else {
    echo '前へ'. '　';
 }
 for($i = 1; $i <= $max_page; $i++){
     if ($i == $now) {
        echo $now. '　'; 
     } else {
        echo '<a href="/kame/test2023/test.php?page_id='.$i.'" >'. $i. '</a>'. '　';
     }
 }
 if($now < $max_page){ // リンクをつけるかの判定
    // $now = $now + 2;
    echo '<a href="/kame/test2023/test.php?page_id='. $now .'" >次へ</a>'. '　';
 } else {
    echo '次へ';
 }
 
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>health first</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Lato:400,300,700,900" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Amoeba - v4.8.0
  * Template URL: https://bootstrapmade.com/free-one-page-bootstrap-template-amoeba/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">

      <div class="logo me-auto">
        <h1><a href="index.html">Health First</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar">
      <ul>
        <li><a href="indexs.php">ホーム画面</a></li>
        <li><a href="picture.php">写真アップロード</a></li>
        <li><a href="gallery.php">写真閲覧</a></li>
        <li><a href="form2.php">お問い合わせ</a></li>
        <li><a class="nav-link scrollto active" href="keijiban.php">掲示板</a></li>
        <li><a href="logout.php">ログアウト</a></li>
      </ul>
      <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navbar -->

    </div>
  </header><!-- End #header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div class="hero-container">
      <h1>Welcome to Health First</h1>
      <h2>私たちは、健康を一番に才能のあるWebデザインのチームです。</h2>
    </div>
  </section><!-- #hero -->

  <main id="main">

    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
        <div class="container">
            <div class="row">

                <div class="col-lg-6 order-1 order-lg-2">
	                <?php foreach($disp_data as $val):?>  <!--データ表示  -->
                        <div>No:<?php echo $val['id']?></div>
		        	    <div>名前：<?php echo $val['name']?></div>
		        	    <div>投稿内容：<?php echo $val['contents']?></div>
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
                <div>
                    <!-- <?php paging2($totalPage, $page); ?> -->
                </div> 

            </div>
            
    </section><!-- End About Us Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
      <div class="container">

        <div class="section-title">
          <h2>サービス</h2>
          <p>利益を得るには多大な労力が必要です。貴方のニーズは、実際に貴方の憤怒と欲望の中から生じます。貴方が理想を望むものにしましょう。そして、他人はそれを受け入れません。</p>
        </div>

        <div class="row">
          <div class="col-lg-4 col-md-6 icon-box">
            <div class="icon"><i class="bi bi-cpu"></i></div>
            <h4 class="title"><a href="">食事写真アップロード機能</a></h4>
          </div>
          <div class="col-lg-4 col-md-6 icon-box">
            <div class="icon"><i class="bi bi-clipboard-data"></i></div>
            <h4 class="title"><a href="">カレンダーで全てを管理</a></h4>
          </div>
          <div class="col-lg-4 col-md-6 icon-box">
            <div class="icon"><i class="bi bi-globe"></i></div>
            <h4 class="title"><a href="chatbot.html">専門スタッフのアフタフォロー</a></h4>
          </div>
      </div>
    </section><!-- End Services Section -->

    
  <!-- Vendor JS Files -->
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

</body>

</html>
