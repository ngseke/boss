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
  <title><?php echo title_name ?></title>
  <?php require_once ('js.php') ?>
</head>

<body>
  <!-- 引入導覽列 -->
  <?php include('nav.php') ?>
  <div class="container">
  </div>
  <?php include('jumbotron/head.php') ?>
  <div class="container my-3">
    <?php include('jumbotron/page1.php') ?>
  </div>
  <?php include('jumbotron/slogan1.php') ?>
  <?php include('jumbotron/page2.php') ?>
  <?php include('jumbotron/slogan2.php') ?>
  <?php include('footer.php') ?>
</body>

</html>
