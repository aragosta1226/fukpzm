<?php

$output = "";
session_start();

// var_dump($_POST);
// exit();
if (!empty($_POST)) {
    //ブラウザの更新ボタンを押したときに前回のPOST情報で処理が走らず画面が更新されるようにトークン比較
    if ($_POST["chkno"] !== $_SESSION["chkno"]) {
        header("Location:login_u.php");
        exit();
    }

    if (
        !isset($_POST["email"]) || $_POST["email"] === "" ||
        !isset($_POST["password"]) || $_POST["password"] === ""
    ) {
        $output = "メールアドレスもしくはパスワードに誤りがあります。";
    } else {
        include('functions.php');


        // データ受け取り
        $email = $_POST["email"];
        $password = $_POST["password"];

        // DB接続
        $pdo = connect_to_db();

        //管理者はpower=1、ユーザーはpower=0
        $sql = "SELECT * FROM user_master WHERE user_id='$email' AND password='$password' AND power = '0' AND del_f='0'";

        // SQL実行
        $stmt = $pdo->prepare($sql);

        try {
            $status = $stmt->execute();
        } catch (PDOException $e) {
            echo json_encode(["sql error" => "{$e->getMessage()}"]);
        }

        // ユーザ有無で条件分岐
        $val = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$val) {
            $output = "メールアドレスもしくはパスワードに誤りがあります。";
        } else {
            $_SESSION = array();
            $_SESSION['session_id'] = session_id();
            $_SESSION['inquiry_id'] = $val['inquiry_id'];
            $_SESSION['email'] = $email;
            header("Location:home_user.php");
            exit();
        }
    }
}
//2重処理にならないようにトークン設定
$_SESSION["chkno"] = $chkno = strval(mt_rand());

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style_lo.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kosugi+Maru&display=swap" rel="stylesheet">
    <title>ログイン画面</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <form action="" name="login_form" method="POST">
        <div class="login_form_top">
            <img src="./img/pzmlogo.png" alt="ロゴ">
        </div>
        <div class="login_form_btn">
            <input type="id" name="email" placeholder="メールアドレス" required="required"><br>
            <input type="password" name="password" placeholder="パスワード" required="required">
            <p class="red"><?= $output ?></p>
            <input type="submit" id="btn_in" name="botton" value="ログイン">
            <div class="center">
                <button type="button" id="c_color">パスワード再発行</button>
            </div>
        </div>
        <!-- 2重処理にならないようにトークン設定 -->
        <input name="chkno" type="hidden" value="<?= $chkno ?>">
    </form>



</body>

</html>