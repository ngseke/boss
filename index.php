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
  <?php $bg_url='https://c.pxhere.com/photos/05/e4/bar_human_bottles_beverages_alcohol_lamps_club_party-1333424.jpg!d' ; ?>
  <?php include('index-jumbotron.php') ?>
  <div class="container my-3">
    <?php include('page.php') ?>
  </div>
  <?php include('footer.php') ?>
</body>
<!-- 引入JS -->
<?php include('js.php') ?>

</html>
