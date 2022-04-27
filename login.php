<?php

$output = "";
session_start();

// var_dump($_POST);
// exit();
if (!empty($_POST)) {
    //ブラウザの更新ボタンを押したときに前回のPOST情報で処理が走らず画面が更新されるようにトークン比較
    if ($_POST["chkno"] !== $_SESSION["chkno"]) {
        header("Location:login.php");
        exit();
    }

    if (
        !isset($_POST["user_id"]) || $_POST["user_id"] === "" ||
        !isset($_POST["password"]) || $_POST["password"] === ""
    ) {
        $output = "Valid userID required";
    } else {
        include('functions.php');


        // データ受け取り
        $user_id = $_POST["user_id"];
        $password = $_POST["password"];

        //LOGINかCREATE ACCOUNT
        if ($_POST["botton"] === "LOGIN") {
            // DB接続
            $pdo = connect_to_db();

            $sql = "SELECT * FROM user_master WHERE user_id='$user_id' AND password='$password' AND del_f='0'";

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
                $output = "Valid userID or password required";
            } else {
                $_SESSION = array();
                $_SESSION['session_id'] = session_id();
                $_SESSION['power'] = $val['power'];
                $_SESSION['user_id'] = $val['user_id'];
                header("Location:inquiry_list.php");
                exit();
            }
        } elseif ($_POST["botton"] === "CREATE ACCOUNT") {
            // DB接続
            $pdo = connect_to_db();

            //同じemailでの登録が過去にあったかチェック。あった場合エラー（未実装）

            //ユーザーセット
            $sql = "INSERT INTO user_master (id,user_id,password,power,history_no,created_at,updated_at,del_f) " .
                "VALUES (NULL, '$user_id', '$password', 1, 0, now(), now(), '0')";

            // SQL実行
            $stmt = $pdo->prepare($sql);

            try {
                $status = $stmt->execute();
            } catch (PDOException $e) {
                echo json_encode(["sql error" => "{$e->getMessage()}"]);
            }

            $_SESSION = array();
            $_SESSION['session_id'] = session_id();
            $_SESSION['power'] = 0;
            $_SESSION['user_id'] = $user_id;
            header("Location:inquiry_list.php");
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
            <input type="id" name="user_id" placeholder="UserID" required="required"><br>
            <input type="password" name="password" placeholder="Password" required="required">
            <p class="red"><?= $output ?></p>
            <input type="submit" id="btn_in" name="botton" value="LOGIN">
            <div class="center">
                <span id="b_color">or</span>
                <button type="button" onclick="clickTextChange()" id="c_color">CREATE ACCOUNT</button>
            </div>
        </div>
        <!-- 2重処理にならないようにトークン設定 -->
        <input name="chkno" type="hidden" value="<?= $chkno ?>">
    </form>

    <script>
        $(document).ready(function() {});

        //HTMLの読み込みが終わった後、処理開始
        $(window).on('load', function() {


        });

        function clickTextChange() {
            if ($("#c_color").text() === "CREATE ACCOUNT") {
                $("#c_color").text("LOGIN to your account")
                $("#btn_in").val("CREATE ACCOUNT")
            } else if ($("#c_color").text() === "LOGIN to your account") {
                $("#c_color").text("CREATE ACCOUNT")
                $("#btn_in").val("LOGIN")
            }
        };
    </script>


</body>

</html>