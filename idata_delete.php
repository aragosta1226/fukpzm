<?php

include("functions.php");

// 入力項目のチェック
if (
    !isset($_POST['party_no']) || $_POST['party_no'] == ''
) {
    header('Location:inquiry_list.php');
    exit();
}
$del = [$_POST['party_no']];

// DB接続
$pdo = connect_to_db();

// SQL実行
$sql = "UPDATE inquiry SET del_f='1', updated_at=now() WHERE id IN (" . implode(",", $del) . ")";

$stmt = $pdo->prepare($sql);
// $stmt->bindValue(':del', $del, PDO::PARAM_STR);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

header('Location:inquiry_list.php');
exit();
