<?php

include("functions.php");
// var_dump($_POST);
// exit();
// POSTデータ確認
if (
    !isset($_POST["user_id"]) || $_POST["user_id"] === "" ||
    !isset($_POST["party_no"]) || $_POST["party_no"] === ""
) {
    exit("ParamError");
}

//まず１行目をセット（データがなければinsertあればupdate）

//ユーザーID
$user_id = $_POST["user_id"];
//ユーザー単位の履歴番号
$party_no = $_POST["party_no"];

//データがあるかチェック
$pdo = connect_to_db();

$sql = "SELECT COUNT(*) FROM meeting WHERE user_id = $user_id AND party_no = $party_no AND del_f = '0'";

$stmt = $pdo->prepare($sql);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

$s_count = $stmt->fetchColumn();

//打ち合わせ画面で入力されたデータをセット
$memory = $_POST["memory"];

if (!isset($_POST["plan_sel"]) || $_POST["plan_sel"] === "") {
    $party_type = 0;
} else {
    $party_type = $_POST["plan_sel"];
}
if (!isset($_POST["place_sel"]) || $_POST["place_sel"] === "") {
    $place = 0;
} else {
    $place = $_POST["place_sel"];
}
if (!isset($_POST["dj_sel"]) || $_POST["dj_sel"] === "") {
    $dj = 0;
} else {
    $dj = $_POST["dj_sel"];
}
if (!isset($_POST["party_ymd"]) || $_POST["party_ymd"] === "") {
    $party_ymd = "";
} else {
    $party_ymd = date('Y/m/d', strtotime($_POST["party_ymd"]));
}
if (!isset($_POST["price"]) || $_POST["price"] === "") {
    $price = 0;
} else {
    $price = $_POST["price"];
}
if (!isset($_POST["option1_sel"]) || $_POST["option1_sel"] === "") {
    $op1_no = 0;
} else {
    $op1_no = $_POST["option1_sel"];
}
if (!isset($_POST["option1_txt"]) || $_POST["option1_txt"] === "") {
    $op1_txt = "";
} else {
    $op1_txt = $_POST["option1_txt"];
}
//写真チェックを数字に変換
if ($_POST["photo_chk"] === "on") {
    $ph_chk = 1;
} else {
    $ph_chk = 0;
}
//ステータス
$status_int = $_POST["status"];


if ($s_count != 0) {
    //データがあるのでupdate
    $sql = "UPDATE meeting SET memory = '$memory', party_type = '$party_type', place_no = $place, dj_no = $dj, photo_flg = $ph_chk, party_ymd = '$party_ymd', price = $price, status = $status_int, option_no1 = $op1_no, option_txt1 = '$op1_txt', updated_at = now() WHERE user_id = $user_id AND party_no = $party_no AND del_f = '0'";

    $stmt = $pdo->prepare($sql);

    try {
        $status = $stmt->execute();
    } catch (PDOException $e) {
        echo json_encode(["sql error" => "{$e->getMessage()}"]);
        exit();
    }
} else {
    //データがないのでinsert
    $sql = "INSERT INTO meeting (id,user_id,party_no,memory,party_type,place_no,dj_no,photo_flg,party_ymd,price,status,option_no1,option_txt1,created_at,updated_at,del_f) " .
        "VALUES (NULL, $user_id, $party_no, '$memory', $party_type, $place, $dj, $ph_chk, '$party_ymd', $price, $status_int, $op1_no, '$op1_txt', now(), now(), '0')";

    $stmt = $pdo->prepare($sql);

    try {
        $status = $stmt->execute();
    } catch (PDOException $e) {
        echo json_encode(["sql error" => "{$e->getMessage()}"]);
        exit();
    }
}



header("Location:inquiry_list.php");
exit();
