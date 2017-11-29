<?php session_start(); ?>
<?php include('connection.php'); ?>
<?php $page_name = '登出' ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php include('style.php') ?>
  <title><?php echo  $page_name. ' - ' .title_name ?></title>
  <meta http-equiv="refresh" content="<?php echo auto_jump_time ?>;URL=index.php">
</head>
<body>
  <?php include('nav.php'); ?>

  <div class="container my-3">
    <div class="row">
      <div class="col-12 text-center">
        <?php
          // 清空登入的Session
          unset($_SESSION['ID']);
          echo '<div class="alert alert-success">';
          echo '<i class="material-icons">power_settings_new</i> 成功登出！';
          echo '</div>';
        ?>
      </div>
    </div>
  </div>
  <?php include('footer.php') ?>
</body>
<?php include('js.php') ?>
</html>
