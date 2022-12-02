<?php
session_start();
$gobackURL = 'index.php';
$myURL = 'keijiban.php';
$option = '';
require_once "../php/k_functions.php";
?>
<?php
define('MAX', '5');
// メッセージを保存するファイルのパス設定
define('FILENAME', './message.txt');

// タイムゾーン設定
date_default_timezone_set('Asia/Tokyo');

// 変数の初期化
// $current_date = null;
// $data = null;
// $file_handle = null;
// $split_data = null;
// $message = array();
// $message_array = array();
// $success_message = null;
// $error_message = array();
// $clean = array();
// $pdo = null;
// $stmt = null;
// $res = null;
// $option = null;
function ngWordCheck($word = '')
{
  $ngArray = array(
    '事故',
    '死亡',
    '骨折',
    '重傷',
    '殺害',
    '傷害',
    '暴力',
    '被害者',
    '放送事故',
    'ポルノ',
    'アダルト',
    'セックス',
    'バイブレーター',
    'マスターベーション',
    'オナニー',
    'スケベ',
    '羞恥',
    'セクロス',
    'エッチ',
    'SEX',
    '風俗',
    '童貞',
    'ペニス',
    '巨乳',
    'ロリ',
    '触手',
    '羞恥',
    'ノーブラ',
    '手ブラ',
    'ローアングル',
    '禁断',
    'Tバック',
    'グラビア',
    '美尻',
    'お尻',
    'セクシー',
    '無修正',
    '児童ポルノ',
    '青姦',
    '大麻',
    '麻薬',
    '基地外',
    '糞',
    '死ね',
    '殺す',
    'shit',
    'piss',
    'fuck',
    'cunt',
    'cocksucker',
    'motherfucker',
    'tits',
  );
  $ngList = '/' . implode('|', $ngArray) . '/';
  $f = preg_match($ngList, $word);

  if ($f == '1') {
    return true;
  } else {
    return false;
  }
}
if (isset($_SESSION["loggedin"])) {
  $id = $_SESSION["id"];
  $sql = "SELECT * FROM users WHERE id =$id";
  $stm = $pdo->prepare($sql);
  $stm->execute();
  $result = $stm->fetchAll(PDO::FETCH_ASSOC);
  foreach ($result as $row) {
    $name = $row["name"];
  }
} else {
  $name = "匿名";
}
// データベースに接続
if (!empty($_POST['btn_submit'])) {
  $f = ngWordCheck($_POST['message']);
  if ($f == true) {
    // ①$alertにjavascriptのalert関数を代入する。
    $alert = "<script type='text/javascript'>alert('NGワードが含まれています。');</script>";

    // ②echoで①を表示する
    echo $alert;
  } else {
    // 表示名の入力チェック
    // if( empty($_POST['view_name']) ) {
    // 	$error_message[] = '表示名を入力してください。';
    // }else {
    $clean['view_name'] = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
    $clean['view_name'] = preg_replace('/\\r\\n|\\n|\\r/', '', $clean['view_name']);
    // }
    // メッセージの入力チェック
    if (empty($_POST['message'])) {
      $error_message[] = 'ひと言メッセージを入力してください。';
    } else {
      $clean['message'] = htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8');
      $clean['message'] = preg_replace('/\\r\\n|\\n|\\r/', '<br>', $clean['message']);
    }
    if (empty($error_message)) {
      // 書き込み日時を取得
      $current_date = date("Y-m-d H:i:s");
      // SQL作成
      if(isset($_POST["message_id"])){
        $message_id=$_POST["message_id"];
        $sql = "INSERT INTO message (view_name, message, post_date,message_id,IP) VALUES ( :view_name, :message, :current_date,$message_id,:IP)";
        $stmt = $pdo->prepare($sql);
        // $stmt->bindParam(':message_id', $_POST['message_id'], PDO::PARAM_STR);
      }else{
        $sql = "INSERT INTO message (view_name, message, post_date,IP) VALUES ( :view_name, :message, :current_date,:IP)";
        $stmt = $pdo->prepare($sql);
      }
      // 値をセット
      $stmt->bindParam(':view_name', $clean['view_name'], PDO::PARAM_STR);
      $stmt->bindParam(':message', $clean['message'], PDO::PARAM_STR);
      $stmt->bindParam(':current_date', $current_date, PDO::PARAM_STR);
      $stmt->bindParam(':IP', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);

      // SQLクエリの実行
      $res = $stmt->execute();

      if ($res) {
        $success_message = 'メッセージを書き込みました。';
      } else {
        $error_message[] = '書き込みに失敗しました。';
      }

      // プリペアドステートメントを削除
      $stmt = null;
    }
  }
  if (empty($error_message)) {

    // メッセージのデータを取得する
    $sql = "SELECT view_name,message,post_date FROM message ORDER BY post_date DESC";
    $message_array = $pdo->query($sql);
  }
}
?>
<!DOCTYPE html>
<?php require_once("head.php") ?>
<title>貸し借り|一覧</title>
</head>

<body>
  <div id="cursor"></div>
  <audio id="audio"></audio>
  <div id="fb-root"></div>
  <script>(function (d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.5&appId=643231655816289";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

  <!--ヘッダー-->
  <?php require_once("header.php"); ?>
  <!-- 入力フォームを作る -->

  <div id="wrapper">
    <!--メイン-->
    <div id="main">
      <section id="point">

        <head>
          <meta charset="utf-8">
          <title>ひと言掲示板</title>
        </head>

        <body>
          <h2 class="h_black">
            <i class="fa fa-comments"></i>
            <?php
try {
  $sql = "SELECT * FROM message";
  $stm = $pdo->prepare($sql);
  $stm->execute();
  $result = $stm->fetchAll(PDO::FETCH_ASSOC);
  $sth = $pdo->query($sql);
  $count = $sth->rowCount();
} catch (Exception $e) {
  echo 'エラーがありました。';
  echo $e->getMessage();
  exit();
}
echo $count . '件'; ?>
          </h2>
          <div class="wiki m15 m10_s">投稿の際は「<a href="#">投稿規約</a>」を順守して投稿して下さい。</div>
          <h1>ひと言掲示板</h1>
          <div class="p15 bg_gray fs13 mb10">貸し借りサイトの愚痴掲示板です。名前を晒す行為や、愚痴に対する文句は禁止しています。</div>
          <form method="POST" action="search_comment.php">
            <ul>
              <li>
                <label>コメントを検索します（部分一致）：<br>
                  <input type="text" name="message" placeholder="名前を入れてください。">
                </label>
              </li>
              <li><input type="submit" value="検索する"></li>
            </ul>
          </form>
          <?php if (!empty($success_message)): ?>
          <p class="success_message">
            <?php
  echo $success_message; ?>
          </p>
          <?php endif; ?>
          <?php if (!empty($error_message)): ?>
          <ul class="error_message">
            <?php foreach ($error_message as $value): ?>
            <li>・
              <?php echo $value; ?>
            </li>
            <?php endforeach; ?>
          </ul>
          <?php endif; ?>
          <form method="post">
            <div>
              <label for="message">ひと言メッセージ</label>
              <textarea id="message" name="message"></textarea>
            </div>
            <input type="submit" name="btn_submit" value="書き込む">
          </form>
          <hr>
          <section>
            <article>
              <?php
    try {
      $sql = "SELECT * FROM message WHERE message_id=0 ORDER BY post_date DESC";
      $stm = $pdo->prepare($sql);
      $stm->execute();
      $result = $stm->fetchAll(PDO::FETCH_ASSOC);
      require_once('paging.php');
      foreach ($disp_data as $row) {
        echo '<table class="table table-striped">';
        echo '<thead><tr>';
        echo '<th>No', $row["id"], ' ', $row["view_name"], ':';
        echo $row["post_date"], '　　　　　<a class="btn btn-primary" href="report.php?id='.$row["id"].'">通報</a></th>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>', $row["message"], '</td>';
        echo '</tr>';
        $message_id=$row["id"];
        $name=$row["view_name"];
        $comment=$row["message"];
        $sql = "SELECT * FROM message WHERE message_id=$message_id";
        $stm = $pdo->prepare($sql);
        $stm->execute();
        $result2 = $stm->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result2 as $row2) {
        echo '<tr>';
        echo '<th>No', $row2["id"], ' ', $row2["view_name"], ':';
        echo $row2["post_date"], '　　　　　<a class="btn btn-primary" href="report.php?id='.$row2["id"].'">通報</a></th></tr><tr>';
        echo '<td>', $row2['message'], '</td>';
        echo '</tr>';
        }
        echo '<tr><td>';
        echo '<form action="reply.php" method="POST" name="replay" onClick="return confirm(\'返信しますか？\');">';
        echo '<input type="hidden" name="message_id" value="'.$message_id.'">';
        echo '<input type="hidden" name="name" value="'.$name.'">';
        echo '<input type="hidden" name="comment" value="'.$comment.'">';
        echo '<input type="submit" class="btn  btn-secondary" value="返信をする" >';
        echo '</form></td></tr>';
        echo '</thead>';
        echo '</table>';
      }
    } catch (Exception $e) {
      echo 'エラーがありました。';
      echo $e->getMessage();
      exit();
    }
    require_once('paging2.php')
      ?>
            </article>
          </section>
        </body>
    </div>
    <!--/メイン-->

    <!--サイド-->
    <?php require_once('side.php'); ?>
    <!--/サイド-->
  </div>
  <!--/wrapper-->

  <!--フッター-->
  <footer>
    <div id="footer_nav">
      <ul>
        <li class="current"><a href="index.php">HOME</a></li>
        <li><a href="add_db.php">商品登録</a></li>
        <li><a href="user_chat_list.php">一覧</a></li>
        <li><a href="mypage.php">マイページ</a></li>
        <li><a href="register.php">アカウント登録</a></li>
        <li><a href="login.php">ログイン</a></li>
      </ul>
    </div>
    <small>&copy; 2015 Bloom.</small>
  </footer>
  <!--/フッター-->
</body>


</html>