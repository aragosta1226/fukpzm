<?php


include('functions.php');
$pdo = connect_to_db();

//問い合わせ一覧から取得したデータ（POST）
//ユーザーID
$user_id = $_POST["user_id"];
//ユーザー単位の履歴番号
$party_no = $_POST["party_no"];

//スケジュールデータ取得
$sql = "SELECT * FROM schedule WHERE user_id = $user_id AND party_no = $party_no AND del_f = '0' ORDER BY start_ymd";

$stmt = $pdo->prepare($sql);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

//変数初期化セット
for ($i = 1; $i < 6; $i++) {
  ${"k_name" . $i} = "";
  ${"s_ymd" . $i} = "";
  ${"days" . $i} = "";
  ${"progress" . $i} = "";
}

$cnt = 1;

foreach ($result as $record) {
  ${"k_name" . $cnt} = $record["name"];
  ${"s_ymd" . $cnt} = $record["start_ymd"];
  ${"days" . $cnt} = $record["days"];
  ${"progress" . $cnt} = $record["progress"];

  $cnt++;
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <link rel="stylesheet" href="./css/style_si.css">
  <title>スケジュール設定</title>
</head>

<body>
  <form action="sdata_create.php" method="POST" name="set">
    <div class="daimoku">
      <div class="dai_name">お客様：</div>
      <div id="user_name"></div>
      <input type="hidden" name="user_id" value=<?= $user_id ?>>
      <input type="hidden" name="party_no" value=<?= $party_no ?>>
      <div class="cp_ipselect cp_sl02">
        <select class="plan_select" name="type_sel">
          <option value="1">お客様用</option>
          <option value="2">発注先用</option>
          <option value="3">運営用</option>
        </select>
      </div>
      <button type="submit">更新</button>
    </div>
    <div class="daimoku">
      <div class="dai_name">パーティー種別：</div>
      <div id="party_name"></div>
      <input id="party_type" type="hidden" name="party_type" value=1>
    </div>
    <table>
      <tr>
        <th>工程名</th>
        <th>開始日付</th>
        <th>予定日数</th>
        <th>進捗率</th>
      </tr>
      <tr>
        <td><input class="k_name" type="text" name="k_name1" value=<?= $k_name1 ?>></td>
        <td><input class="s_ymd" type="text" name="s_ymd1" value=<?= $s_ymd1 ?>></td>
        <td><input class="days" type="text" name="days1" value=<?= $days1 ?>></td>
        <td><input class="progress" type="text" name="progress1" value=<?= $progress1 ?>><label>％</label></td>
      </tr>
      <tr>
        <td><input class="k_name" type="text" name="k_name2" value=<?= $k_name2 ?>></td>
        <td><input class="s_ymd" type="text" name="s_ymd2" value=<?= $s_ymd2 ?>></td>
        <td><input class="days" type="text" name="days2" value=<?= $days2 ?>></td>
        <td><input class="progress" type="text" name="progress2" value=<?= $progress2 ?>><label>％</label></td>
      </tr>
      <tr>
        <td><input class="k_name" type="text" name="k_name3" value=<?= $k_name3 ?>></td>
        <td><input class="s_ymd" type="text" name="s_ymd3" value=<?= $s_ymd3 ?>></td>
        <td><input class="days" type="text" name="days3" value=<?= $days3 ?>></td>
        <td><input class="progress" type="text" name="progress3" value=<?= $progress3 ?>><label>％</label></td>
      </tr>
      <tr>
        <td><input class="k_name" type="text" name="k_name4" value=<?= $k_name4 ?>></td>
        <td><input class="s_ymd" type="text" name="s_ymd4" value=<?= $s_ymd4 ?>></td>
        <td><input class="days" type="text" name="days4" value=<?= $days4 ?>></td>
        <td><input class="progress" type="text" name="progress4" value=<?= $progress4 ?>><label>％</label></td>
      </tr>
      <tr>
        <td><input class="k_name" type="text" name="k_name5" value=<?= $k_name5 ?>></td>
        <td><input class="s_ymd" type="text" name="s_ymd5" value=<?= $s_ymd5 ?>></td>
        <td><input class="days" type="text" name="days5" value=<?= $days5 ?>></td>
        <td><input class="progress" type="text" name="progress5" value=<?= $progress5 ?>><label>％</label></td>
      </tr>
    </table>
  </form>
</body>

</html>