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
</head>

<body>
  <!-- 引入導覽列 -->
  <?php include('nav.php') ?>
  <?php include('jumbotron/head.php') ?>
  <div class="container my-3">
    <?php include('page1.php') ?>
  </div>
  <?php include('jumbotron/slogan1.php') ?>
  <div class="discount py-3" style="background-image: linear-gradient(-225deg, #FFE29F 0%, #FFA99F 48%, #FF719A 100%);">
    <div class="container">
      <?php include('page2.php') ?>
    </div>
  </div>

  <?php include('jumbotron/slogan2.php') ?>
  <?php include('footer.php') ?>
</body>
<!-- 引入JS -->
<?php include('js.php') ?>

</html>
