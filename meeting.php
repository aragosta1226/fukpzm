<?php


include('functions.php');
$pdo = connect_to_db();

//問い合わせ一覧から取得したデータ（POST）
//ユーザーID
$user_id = $_POST["user_id"];
//ユーザー単位の履歴番号
$party_no = $_POST["party_no"];

//ミーティングデータ取得
$sql = "SELECT meet.*,party_master.str AS party_str 
        FROM (SELECT meeting.* FROM meeting WHERE user_id = $user_id AND party_no = $party_no AND del_f = '0') AS meet,party_master 
        WHERE meet.party_type = party_master.m_id AND party_master.del_f = '0'";

$stmt = $pdo->prepare($sql);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

// $s_count = $stmt->fetchColumn();
$s_count = $stmt->rowCount();
$main = $stmt->fetch(PDO::FETCH_ASSOC);

//打ち合わせデータがある場合（保存、予約などされている場合）
if ($s_count != 0) {
    //パーティー種別（文字列用）
    $party_str = $main['party_str'];
    //議事録
    $memory = $main['memory'];
    //写真OK有無
    if ($main['photo_flg'] === 1) {
        $pho_flg = "checked";
    } else {
        $pho_flg = "";
    }
    //開催日
    $par_ymd = $main['party_ymd'];
    //料金
    $pri = $main['price'];
    //オプション１
    $opt1_txt = $main['option_txt1'];
    //ステータス
    switch ($main["status"]) {
        case "0":
            $status_str = "";
            break;
        case "1":
            $status_str = "予約";
            break;
        case "2":
            $status_str = "保存";
            break;
        default:
            $status_str = "";
            break;
    }

    //各セレクト要素セット
    //パーティー種別
    $sql = "SELECT * FROM party_master WHERE del_f = '0' ORDER BY m_id";
    $stmt = $pdo->prepare($sql);

    try {
        $status = $stmt->execute();
    } catch (PDOException $e) {
        echo json_encode(["sql error" => "{$e->getMessage()}"]);
        exit();
    }
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $party_output = "<option value=''>--パーティー種別--</option>";

    foreach ($result as $record) {
        if ($record["m_id"] !== 0) {
            if ($record["m_id"] === $main['party_type']) {
                //保存されているデータを表示
                $party_output .= "<option value='{$record["m_id"]}' selected>{$record["str"]}</option>";
            } else {
                $party_output .= "<option value='{$record["m_id"]}'>{$record["str"]}</option>";
            }
        }
    }

    //会場
    $sql = "SELECT * FROM place_master WHERE del_f = '0' ORDER BY m_id";
    $stmt = $pdo->prepare($sql);

    try {
        $status = $stmt->execute();
    } catch (PDOException $e) {
        echo json_encode(["sql error" => "{$e->getMessage()}"]);
        exit();
    }
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $place_output = "<option value=''>--会場--</option>";

    foreach ($result as $record) {
        if ($record["m_id"] !== 0) {
            if ($record["m_id"] === $main['place_no']) {
                //保存されているデータを表示
                $place_output .= "<option value='{$record["m_id"]}' selected>{$record["str"]}</option>";
            } else {
                $place_output .= "<option value='{$record["m_id"]}'>{$record["str"]}</option>";
            }
        }
    }

    //ＤＪ
    $sql = "SELECT * FROM dj_master WHERE del_f = '0' ORDER BY m_id";
    $stmt = $pdo->prepare($sql);

    try {
        $status = $stmt->execute();
    } catch (PDOException $e) {
        echo json_encode(["sql error" => "{$e->getMessage()}"]);
        exit();
    }
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $dj_output = "<option value=''>--DJ--</option>";
    $dj_detail = "";
    $djArray = array();

    foreach ($result as $record) {
        if ($record["m_id"] !== 0) {

            //詳細情報を配列にセット
            array_push($djArray, $record["detail"]);

            if ($record["m_id"] === $main['dj_no']) {
                //保存されているデータを表示
                $dj_output .= "<option value='{$record["m_id"]}' selected>{$record["str"]}</option>";
                $dj_detail = $record["detail"];
            } else {
                $dj_output .= "<option value='{$record["m_id"]}'>{$record["str"]}</option>";
            }
        }
    }

    //オプション
    $sql = "SELECT * FROM option_master WHERE del_f = '0' ORDER BY m_id";
    $stmt = $pdo->prepare($sql);

    try {
        $status = $stmt->execute();
    } catch (PDOException $e) {
        echo json_encode(["sql error" => "{$e->getMessage()}"]);
        exit();
    }
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $option_output = "<option value=''>--オプション--</option>";

    foreach ($result as $record) {
        if ($record["m_id"] !== 0) {
            if ($record["m_id"] === $main['option_no1']) {
                //保存されているデータを表示
                $option_output .= "<option value='{$record["m_id"]}' selected>{$record["str"]}</option>";
            } else {
                $option_output .= "<option value='{$record["m_id"]}'>{$record["str"]}</option>";
            }
        }
    }


    //ない場合（初期値セット）    
} else {

    $party_str = "";
    //議事録
    $memory = "";
    //写真OK有無
    $pho_flg = "";
    //開催日
    $par_ymd = "";
    //料金
    $pri = "";
    //オプション１
    $opt1_txt = "";
    //ステータス
    $status_str = "";


    //各セレクト要素セット
    //パーティー種別
    $sql = "SELECT * FROM party_master WHERE del_f = '0' ORDER BY m_id";
    $stmt = $pdo->prepare($sql);

    try {
        $status = $stmt->execute();
    } catch (PDOException $e) {
        echo json_encode(["sql error" => "{$e->getMessage()}"]);
        exit();
    }
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $party_output = "<option value=''>--パーティー種別--</option>";

    foreach ($result as $record) {
        if ($record["m_id"] !== 0) {
            $party_output .= "<option value='{$record["m_id"]}'>{$record["str"]}</option>";
        }
    }

    //会場
    $sql = "SELECT * FROM place_master WHERE del_f = '0' ORDER BY m_id";
    $stmt = $pdo->prepare($sql);

    try {
        $status = $stmt->execute();
    } catch (PDOException $e) {
        echo json_encode(["sql error" => "{$e->getMessage()}"]);
        exit();
    }
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $place_output = "<option value=''>--会場--</option>";

    foreach ($result as $record) {
        if ($record["m_id"] !== 0) {
            $place_output .= "<option value='{$record["m_id"]}'>{$record["str"]}</option>";
        }
    }

    //ＤＪ
    $sql = "SELECT * FROM dj_master WHERE del_f = '0' ORDER BY m_id";
    $stmt = $pdo->prepare($sql);

    try {
        $status = $stmt->execute();
    } catch (PDOException $e) {
        echo json_encode(["sql error" => "{$e->getMessage()}"]);
        exit();
    }
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $dj_output = "<option value=''>--DJ--</option>";
    $djArray = array();

    foreach ($result as $record) {
        if ($record["m_id"] !== 0) {

            //詳細情報を配列にセット
            array_push($djArray, $record["detail"]);

            //selectをセット
            $dj_output .= "<option value='{$record["m_id"]}'>{$record["str"]}</option>";
        }
    }

    //オプション
    $sql = "SELECT * FROM option_master WHERE del_f = '0' ORDER BY m_id";
    $stmt = $pdo->prepare($sql);

    try {
        $status = $stmt->execute();
    } catch (PDOException $e) {
        echo json_encode(["sql error" => "{$e->getMessage()}"]);
        exit();
    }
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $option_output = "<option value=''>--オプション--</option>";

    foreach ($result as $record) {
        if ($record["m_id"] !== 0) {
            $option_output .= "<option value='{$record["m_id"]}'>{$record["str"]}</option>";
        }
    }
}





//問い合わせ情報取得
$sql = "SELECT * FROM inquiry WHERE user_id = $user_id AND id = $party_no AND del_f = '0'";

$stmt = $pdo->prepare($sql);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

$val = $stmt->fetch(PDO::FETCH_ASSOC);

$simei = "お名前：　" . $val['kana_sei'] . "　" . $val['kana_mei'] . "様";
$inquiry_com = $val['inquiry_comment'];

$dj_out = json_encode($djArray);


?>

<!DOCTYPE html>
<html lang='ja'>

<head>
    <meta charset='utf-8' />
    <script src='fullcalendar/lib/main.js'></script>
    <script src="fullcalendar/lib/locales/ja.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <link href='fullcalendar/lib/main.css' rel='stylesheet' />
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP" rel="stylesheet">
    <link rel="stylesheet" href="./css/style_m.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kosugi+Maru&display=swap" rel="stylesheet">
    <title>打ち合わせ管理</title>

</head>

<body>

    <form action="rdata_create.php" method="POST" name="set">
        <div class="main">
            <!-- 打ち合わせ画面の左側（お客様問い合わせ情報、議事録、プラン、カレンダー、会場、DJ -->
            <div class="left">
                <!-- お客様問い合わせ情報、議事録、プラン -->
                <div class="customer">
                    <div class="name"><?= $simei ?></div>
                    <input type="hidden" name="user_id" value=<?= $user_id ?>>
                    <input type="hidden" name="party_no" value=<?= $party_no ?>>
                    <div class="inquiry">
                        <div class="in_lf">
                            <div id="party_name">種別：　<?= $party_str ?></div>
                        </div>
                        <div class="in_rg">
                            <div id="free_meg"><?= $inquiry_com ?></div>
                            <textarea name="memory" id="memory" cols="60" rows="6"><?= $memory ?></textarea>

                        </div>
                    </div>
                </div>
                <!-- プラン、カレンダー、会場、DJ -->
                <div class="plan_main">
                    <!-- プラン、カレンダー -->
                    <div class="plan">
                        <div class="cp_ipselect cp_sl02">
                            <select id="plan_sel" class="plan_select" name="plan_sel">
                                <?= $party_output ?>
                            </select>
                        </div>
                        <div class="cal_st" id="cal"></div>
                    </div>
                    <!-- 会場、DJ -->
                    <div class="place_dj">
                        <div class="place_main">
                            <div class="place">
                                <div class="cp_ipselect cp_sl02">
                                    <select id="place_sel" class="plan_select" name="place_sel">
                                        <?= $place_output ?>
                                    </select>
                                </div>
                                <a id="p_url" href="">https://www.xxxx.com</a>
                            </div>
                            <div id="map"></div>
                        </div>
                        <div class="dj_main">
                            <div class="dj">
                                <div class="cp_ipselect cp_sl02">
                                    <select id="dj_sel" class="plan_select" name="dj_sel">
                                        <?= $dj_output ?>
                                    </select>
                                </div>
                                <button class="detail_btn">詳細</button>
                            </div>
                            <div id="dj_detail"><?= $dj_detail ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="right">
                <div class="btn_group">
                    <button type="submit" id="save_btn">保存</button>
                    <button type="button" id="clear_btn">クリア</button>
                    <button type="submit" id="reserve_btn">予約</button>
                    <button type="button" onclick="history.back()" class="back_btn">戻る</button>
                </div>
                <input id="photo_chk" type="checkbox" name="photo_chk" <?= $pho_flg ?>><label>写真および動画の使用許可</label>
                <div class="open_day">
                    <label>開催日：</label>
                    <input id="party_ymd" type="text" name="party_ymd" value="<?= $par_ymd ?>">
                </div>
                <div class="p_val">
                    <label>料金：</label>
                    <input id="price" type="text" name="price" value="<?= $pri ?>">
                </div>
                <div class="sta">
                    <label>ステータス：</label>
                    <input id="status" type="text" readonly="readonly" disabled="disabled" value="<?= $status_str ?>">
                    <input type="hidden" id="status_int" name="status" value="">
                </div>
                <div class="supplier_group">
                    <button id="add_btn">追加</button>
                    <div class="supplier">
                        <div class="cp_ipselect cp_sl02">
                            <select id="supplier_sel" class="plan_select" name="option1_sel">
                                <?= $option_output ?>
                            </select>
                        </div>
                        <button class="detail_btn">詳細</button>
                        <button class="delete_btn">削除</button>
                    </div>
                    <textarea name="option1_txt" class="sup_coment" cols="30" rows="4"><?= $opt1_txt ?></textarea>

                </div>
            </div>
        </div>
    </form>

    <script>
        $(document).on("change", "#plan_sel", function() {
            switch ($("#plan_sel").val()) {
                case "1":
                    $("#party_name").text("1.5次会、2次会");
                    break;
                case "2":
                    $("#party_name").text("学生パーティー");
                    break;
                case "3":
                    $("#party_name").text("ラウンジパーティー");
                    break;
                case "4":
                    $("#party_name").text("企業パーティー");
                    break;
                case "5":
                    $("#party_name").text("キャンプパーティー");
                    break;
                case "6":
                    $("#party_name").text("学校行事");
                    break;
                default:
                    $("#party_name").text("");
                    break;
            }
        });

        $(document).on("change", "#dj_sel", function() {
            const dj_detail = <?= $dj_out ?>;
            $("#dj_detail").text(dj_detail[$("#dj_sel").val() - 1]);
        });

        document.addEventListener('DOMContentLoaded', function() {
            const calendar = new FullCalendar.Calendar($("#cal").get(0), {
                initialView: 'dayGridMonth',
                locale: 'ja',
                events: [{
                    title: "DJ",
                    start: "2022-04-08"
                }, ],

                //日付を選択可能に
                selectable: true,
                //日付を選択したときの処理
                dateClick: function(info) {
                    $("#party_ymd").val(info.dateStr);
                    // alert('Clicked on: ' + info.dateStr);
                }

                // height: 'auto',
            });
            calendar.render();
        });

        let map;
        let marker;

        function initMap() {
            map = new google.maps.Map($("#map").get(0), {
                center: {
                    lat: 33.590184,
                    lng: 130.401689
                },
                zoom: 15,
            });

            marker = new google.maps.Marker({
                position: {
                    lat: 33.590184,
                    lng: 130.401689
                },
                map: map
            });
        }
        //予約ボタン
        $("#reserve_btn").on("click", function() {
            $("#status_int").val(1);
        });
        //保存ボタン
        $("#save_btn").on("click", function() {
            $("#status_int").val(2);
        });
        //クリアボタン
        $("#clear_btn").on("click", function() {
            $("#memory").val("");
            $("#plan_sel option[value='']").prop('selected', true);
            $("#place_sel option[value='']").prop('selected', true);
            $("#dj_sel option[value='']").prop('selected', true);
            $("#supplier_sel option[value='']").prop('selected', true);
            $("#party_name").text("種別：　");
            $("#party_ymd").val("");
            $("#price").val("");
            $("#photo_chk").removeAttr('checked').prop('checked', false).change()
        });
    </script>
    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBaGFiCXKiZmeI_lVL9u7A5Tlqhe5G3xoA&callback=initMap&v=weekly" async></script> -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAanbIwFlVoNeWfX5hPR7EqvhIHmdrd6vA&callback=initMap&v=weekly" async></script>

</body>

</html>