<?php

session_start();

include('functions.php');
$pdo = connect_to_db();

//ログインデータ（SESSION）
//問い合わせID
$id = $_SESSION['inquiry_id'];
//ユーザー単位の履歴番号
$email = $_SESSION['email'];

//ユーザー情報取得
$sql = "SELECT * FROM inquiry WHERE id = $id AND mail = '$email' AND del_f = '0'";

$stmt = $pdo->prepare($sql);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$main = $stmt->fetch(PDO::FETCH_ASSOC);

//ないはずだが、ユーザーマスタにはあって問い合わせデータにない場合
if (!$main) {
  //エラーメッセージ（未実装）
  // header("Location:login_u.php");
  // exit();
} else {
  //名前
  $name = $main['kana_sei'] . "　" . $main['kana_mei'] . "様";
  //次画面に渡す情報をセット
  $user_id = $main['user_id'];
  $party_no = $main['id'];
}

?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <link rel="stylesheet" href="./css/style_hu.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Kosugi+Maru&display=swap" rel="stylesheet">
  <title>ホーム</title>
</head>

<body>
  <header>
    <img src="./img/headerlogo.png" alt="">
    <div class="h_name"><?= $name ?></div>
  </header>
  <div class="main">

    <!-- 左側のメニュー部分 -->
    <div class="menu">
      <div class="m_home">ホーム</div>
    </div>
    <!-- 右側のいろいろ部分（各種機能への遷移とお知らせ） -->
    <div class="detail">
      <!-- 各種機能への遷移 -->
      <div class="func">
        <form action="schedule_u.php" method="POST" name="set">
          <button type="submit" class="func_per">
            <img class="img_size" src="./img/shuke-preview.png" alt="">
            <div>
              <div class="blue_str">スケジュール状況</div>
              <div class="detail_str">イベント開催までの各種スケジュール状況が確認できます。</div>
            </div>
            <input type="hidden" name="user_id" value=<?= $user_id ?>>
            <input type="hidden" name="party_no" value=<?= $party_no ?>>
          </button>
        </form>
        <button type="submit" class="func_per">
          <img class="img_size" src="./img/meeting-preview.png" alt="">
          <div>
            <div class="blue_str">打ち合わせ内容確認</div>
            <div class="detail_str">打ち合わせさせていただいて決定した内容が確認できます。</div>
          </div>
        </button>
        <button type="submit" class="func_per">
          <img class="img_size" src="./img/mitumori-preview.png" alt="">
          <div>
            <div class="blue_str">見積内容確認</div>
            <div class="detail_str">今回のイベントを開催する上で係る費用が確認できます。</div>
          </div>
        </button>
      </div>
      <div class="func">
        <button type="submit" class="func_per">
          <img class="img_size" src="./img/syoutaikyaku-preview.png" alt="">
          <div>
            <div class="blue_str">招待客情報</div>
            <div class="detail_str">招待客リストの作成および確認、招待状の作成などを行うことが出来ます。</div>
          </div>
        </button>
      </div>
      <!-- お知らせ -->
      <div class="news">お知らせ</div>
      <div class="news_detail">
        2022/04/18に打ち合わせをさせていただきました。
      </div>
      <div class="news_detail">
        2022/04/16にお問い合わせいただきました。
      </div>
    </div>
  </div>
  <script>

  </script>

</body>

</html>