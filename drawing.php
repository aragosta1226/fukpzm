<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
  <link rel="stylesheet" href="./css/style_d.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Kosugi+Maru&display=swap" rel="stylesheet">
  <title>現地平面図</title>
</head>

<body>
  <div id="main">
    <div id="drawing">
      <div class="door"></div>
    </div>
    <div id="app">
      <img src="./img/DJ_table.png" id="dj_table" width="100px">
      <img src="./img/table8.png" class="table" width="100px">
      <img src="./img/table8.png" class="table" width="100px">
      <img src="./img/table8.png" class="table" width="100px">
      <img src="./img/table8.png" class="table" width="100px">
      <img src="./img/table8.png" class="table" width="100px">
      <img src="./img/table8.png" class="table" width="100px">
      <img src="./img/table8.png" class="table" width="100px">
      <img src="./img/table8.png" class="table" width="100px">
      <img src="./img/table8.png" class="table" width="100px">
      <img src="./img/table8.png" class="table" width="100px">
      <img src="./img/sikaku_table.png" class="table" width="100px">
      <img src="./img/sikaku_table.png" class="table" width="100px">
      <img src="./img/sikaku_table.png" class="table" width="100px">
      <img src="./img/sikaku_table.png" class="table" width="100px">
      <img src="./img/sikaku_table.png" class="table" width="100px">
      <img src="./img/sikaku_table.png" class="table" width="100px">
      <img src="./img/sikaku_table.png" class="table" width="100px">
      <img src="./img/sikaku_table.png" class="table" width="100px">
      <img src="./img/sikaku_table.png" class="table" width="100px">
      <img src="./img/isu.png" class="table" width="50px">
      <img src="./img/isu.png" class="table" width="50px">
      <img src="./img/isu.png" class="table" width="50px">
      <img src="./img/isu.png" class="table" width="50px">
      <img src="./img/dai.png" class="table" width="300px">
    </div>
  </div>

  <script>
    $(function() {
      $("#dj_table").draggable();
      $(".table").draggable();
    });
  </script>

</body>

</html>