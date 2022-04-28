<?php

include("functions.php");
// var_dump($_POST);
// exit();
// POSTデータ確認
if (
    !isset($_POST["sei"]) || $_POST["sei"] === "" ||
    !isset($_POST["mei"]) || $_POST["mei"] === "" ||
    !isset($_POST["tel_no"]) || $_POST["tel_no"] === "" ||
    !isset($_POST["mail"]) || $_POST["mail"] === "" ||
    !isset($_POST["genre"]) || $_POST["genre"] === "" ||
    !isset($_POST["inquiry_com"]) || $_POST["inquiry_com"] === ""
) {
    exit("ParamError");
}

//まず１行目をセット（データがなければinsertあればupdate）

//データがあるかチェック
$pdo = connect_to_db();

//user_idを決める（暫定）
//データ数＋１をuser_idにする
$sql = "SELECT COUNT(*) FROM inquiry";

$stmt = $pdo->prepare($sql);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

$s_count = $stmt->fetchColumn();

$user_id = $s_count + 1;

$kana_sei = $_POST["sei"];
$kana_mei = $_POST["mei"];
$tel_no = $_POST["tel_no"];
$mail = $_POST["mail"];
$type = $_POST["genre"];
$comment = $_POST["inquiry_com"];

$sql = "INSERT INTO inquiry (id,user_id,kana_sei,kana_mei,tel_no,mail,inquiry_type,inquiry_comment,created_at,updated_at,del_f) " .
    "VALUES (NULL, $user_id, '$kana_sei', '$kana_mei', '$tel_no', '$mail', $type, '$comment', now(), now(), '0')";

$stmt = $pdo->prepare($sql);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

header("Location:index.php");
exit();
