<?php

include("functions.php");
// var_dump($_POST);
// exit();
// POSTデータ確認
if (
    !isset($_POST["k_name1"]) || $_POST["k_name1"] === "" ||
    !isset($_POST["s_ymd1"]) || $_POST["s_ymd1"] === "" ||
    !isset($_POST["days1"]) || $_POST["days1"] === "" ||
    !isset($_POST["party_type"]) || $_POST["party_type"] === ""
) {
    exit("ParamError");
}

//まず１行目をセット（データがなければinsertあればupdate）

//データがあるかチェック
$pdo = connect_to_db();

$iname = $_POST["k_name1"];
$ymd = date('Y/m/d', strtotime($_POST["s_ymd1"]));
$days = $_POST["days1"];

//進捗率については未入力（0％）の可能性があるので
if (!isset($_POST["progress1"]) || $_POST["progress1"] === "") {
    $progress = 0;
} else {
    $progress = $_POST["progress1"];
}



$user_id = $_POST["user_id"];
$party_no = $_POST["party_no"];
$type = $_POST["type_sel"];
$party_type = $_POST["party_type"];

$sql = "SELECT COUNT(*) FROM schedule WHERE user_id = $user_id AND party_no = $party_no AND schedule_no = 1";

$stmt = $pdo->prepare($sql);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

$s_count = $stmt->fetchColumn();

if ($s_count != 0) {
    //データがあるのでupdate
    $sql = "UPDATE schedule SET name = '$iname', start_ymd = '$ymd', days = $days, progress = $progress, updated_at = now() WHERE user_id = $user_id AND party_no = $party_no AND schedule_no = 1 AND type = $type";

    $stmt = $pdo->prepare($sql);

    try {
        $status = $stmt->execute();
    } catch (PDOException $e) {
        echo json_encode(["sql error" => "{$e->getMessage()}"]);
        exit();
    }
} else {
    //データがないのでinsert
    $sql = "INSERT INTO schedule (id,user_id,party_no,schedule_no,type,name,party_type,start_ymd,days,progress,created_at,updated_at,del_f) " .
        "VALUES (NULL, $user_id, $party_no, '1', $type, '$iname', $party_type, '$ymd', $days, $progress, now(), now(), '0')";

    $stmt = $pdo->prepare($sql);

    try {
        $status = $stmt->execute();
    } catch (PDOException $e) {
        echo json_encode(["sql error" => "{$e->getMessage()}"]);
        exit();
    }
}


//2行目以降に入力があるか？
$cnt = 1;

for ($i = 2; $i < 6; $i++) {
    $name_str = "k_name" . $i;

    if (isset($_POST[$name_str]) && $_POST[$name_str] !== "") {
        $ymd_str = "s_ymd" . $i;
        $day_str = "days" . $i;
        $progress_str = "progress" . $i;

        $iname = $_POST[$name_str];
        $ymd = date('Y/m/d', strtotime($_POST[$ymd_str]));
        $days = $_POST[$day_str];

        //進捗率については未入力（0％）の可能性があるので
        if (!isset($_POST[$progress_str]) || $_POST[$progress_str] === "") {
            $progress = 0;
        } else {
            $progress = $_POST[$progress_str];
        }

        $sql = "SELECT COUNT(*) FROM schedule WHERE user_id = $user_id AND party_no = $party_no AND schedule_no = $i";

        $stmt = $pdo->prepare($sql);

        try {
            $status = $stmt->execute();
        } catch (PDOException $e) {
            echo json_encode(["sql error" => "{$e->getMessage()}"]);
            exit();
        }

        $s_count = $stmt->fetchColumn();

        if ($s_count != 0) {
            //データがあるのでupdate
            $sql = "UPDATE schedule SET name = '$iname', start_ymd = '$ymd', days = $days, progress = $progress, updated_at = now() WHERE user_id = $user_id AND party_no = $party_no AND schedule_no = $i AND type = $type";

            $stmt = $pdo->prepare($sql);

            try {
                $status = $stmt->execute();
            } catch (PDOException $e) {
                echo json_encode(["sql error" => "{$e->getMessage()}"]);
                exit();
            }
        } else {
            //データがないのでinsert
            $sql = "INSERT INTO schedule (id,user_id,party_no,schedule_no,type,name,party_type,start_ymd,days,progress,created_at,updated_at,del_f) " .
                "VALUES (NULL, $user_id, $party_no, $i, $type, '$iname', $party_type, '$ymd', $days, $progress, now(), now(), '0')";

            $stmt = $pdo->prepare($sql);

            try {
                $status = $stmt->execute();
            } catch (PDOException $e) {
                echo json_encode(["sql error" => "{$e->getMessage()}"]);
                exit();
            }
        }
    }
}

header("Location:inquiry_list.php");
exit();
