<?php session_start(); ?>
<?php include('connection.php'); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- 引入CSS等樣式內容 -->
  <?php include('style.php') ?>

  <!-- 根據所在頁面 印出對應的標題 -->
  <title><?php echo  $page_name. ' - ' .title_name ?></title>
</head>
<body>
<?php include('nav.php'); ?>
<div class="container">
  <div class="row">
    <div class="col-12">


    </div>
  </div>
</div>

</body>
