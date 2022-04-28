<?php


include('functions.php');
$pdo = connect_to_db();

//問い合わせ一覧から取得したデータ（POST）
//ユーザーID
$user_id = $_POST["user_id"];
//ユーザー単位の履歴番号
$party_no = $_POST["party_no"];
//ユーザー用：１、発注先用：２、運営用：３
$type = '1';

//ユーザー情報取得
$sql = "SELECT * FROM (SELECT * FROM inquiry WHERE user_id = $user_id AND id = $party_no AND del_f = '0') AS inquiry LEFT JOIN (
        SELECT meeting.user_id AS userid,meeting.party_no,meeting.party_type,meeting.party_ymd,meeting.status,party_master.str as party_str 
        FROM meeting, party_master 
        WHERE meeting.party_type = party_master.m_id AND meeting.del_f = '0' AND party_master.del_f = '0'
        ) AS meet
        ON inquiry.user_id = meet.userid AND inquiry.id = meet.party_no";

$stmt = $pdo->prepare($sql);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$main = $stmt->fetch(PDO::FETCH_ASSOC);

//名前
$name = $main['kana_sei'] . "　" . $main['kana_mei'] . "様";

//パーティー種別（1:二次会、2:学生パーティー、3:ホームパーティー）
$party_str = $main['party_str'];


//スケジュールデータ取得（問い合わせ一覧から条件はもらう）
$sql = "SELECT schedule_no,name,start_ymd,days,progress FROM schedule WHERE user_id = $user_id AND party_no = $party_no";

$stmt = $pdo->prepare($sql);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$output = array();


//スケジュール表にセットするようにjsonデータ作成
foreach ($result as $record) {

  array_push($output, array(
    "schedule_no" => substr("00" . $record["schedule_no"], -3),
    "name" => $record["name"],
    "sYYYY" => date('Y', strtotime($record["start_ymd"])),
    "sMM" => date('m', strtotime($record["start_ymd"])),
    "sDD" => date('d', strtotime($record["start_ymd"])),
    "eYYYY" => date('Y', strtotime($record["start_ymd"] . " " . $record["days"] . " day")),
    "eMM" => date('m', strtotime($record["start_ymd"] . " " . $record["days"] . " day")),
    "eDD" => date('d', strtotime($record["start_ymd"] . " " . $record["days"] . " day")),
    "progress" => $record["progress"]
  ));
}

$json_output = json_encode($output);

?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <link rel="icon" type="image/png" href="./img/pzmlogo.png">
  <link rel="stylesheet" href="./css/style_s.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Kosugi+Maru&display=swap" rel="stylesheet">
  <title>スケジュール管理</title>
</head>

<body>
  <div class="ga_main">スケジュール</div>
  <div class="daimoku">
    <div class="dai_name">お客様：</div>
    <div id="user_name"><?= $name ?></div>
    <button onclick="history.back()" class="back_btn">戻る</button>
  </div>
  <div class="daimoku">
    <div class="dai_name">パーティー種別：</div>
    <div id="party_name"><?= $party_str ?></div>
    <input id="party_type" type="hidden" name="party_type" value=1>
  </div>
  <div class="cp_ipselect cp_sl02">
    <select class="plan_select" name="dj_sel">
      <option value="1">お客様用</option>
      <option value="2">発注先用</option>
      <option value="3">運営用</option>
    </select>
  </div>
  <div id="chart_div"></div>

  <script>
    google.charts.load('current', {
      'packages': ['gantt']
    });
    google.charts.setOnLoadCallback(drawChart);

    function daysToMilliseconds(days) {
      return days * 24 * 60 * 60 * 1000;
    }

    function drawChart() {

      let data = new google.visualization.DataTable();
      data.addColumn('string', 'Task ID');
      data.addColumn('string', 'Task Name');
      data.addColumn('string', 'Resource');
      data.addColumn('date', 'Start Date');
      data.addColumn('date', 'End Date');
      data.addColumn('number', 'Duration');
      data.addColumn('number', 'Percent Complete');
      data.addColumn('string', 'Dependencies');

      //phpからスケジュールデータ取得
      const scData = <?= $json_output ?>;

      const sc_length = scData.length;

      //google chartsに合わせた形にスケジュールデータを変更
      for (let i = 0; i < sc_length; i++) {
        let tempArray = [];

        tempArray.push(scData[i].schedule_no);
        tempArray.push(scData[i].name);
        tempArray.push('<?= $party_str ?>');
        tempArray.push(new Date(scData[i].sYYYY, scData[i].sMM, scData[i].sDD));
        tempArray.push(new Date(scData[i].eYYYY, scData[i].eMM, scData[i].eDD));
        tempArray.push(null);
        tempArray.push(scData[i].progress);
        tempArray.push(null);

        data.addRows([tempArray]);
      }


      // data.addRows([
      //   ['001', 'パーティー打ち合わせ', '二次会',
      //     new Date(2022, 3, 22), new Date(2022, 3, 28), null, 100, null
      //   ],
      //   ['002', 'ＤＪ打ち合わせ', '二次会',
      //     new Date(2022, 3, 28), new Date(2022, 4, 2), null, 80, null
      //   ],
      //   ['003', '会場下見', '二次会',
      //     new Date(2022, 4, 2), new Date(2022, 4, 10), null, 10, null
      //   ],
      // ]);

      const options = {
        height: 400,
        gantt: {
          trackHeight: 30
        }
      };
      const chart = new google.visualization.Gantt($('#chart_div').get(0));

      chart.draw(data, options);
    }
  </script>

</body>

</html>