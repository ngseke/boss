<?php session_start(); ?>
<?php include('connection.php'); ?>
<?php $page_name="商品移除"?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php include('style.php') ?>
  <title><?php echo  $page_name. ' - ' .title_name ?></title>
</head>

<body>
  <?php include('nav.php'); ?>
  <div class="container my-3">
    <div class="row" >
      <div class="col-12 text-center ">
        <?php
          if($_POST(['temp'])){
            $temp = $_POST(['temp']);
            $sql = " DELETE FROM CART_RECORD CR
                     WHERE CR.ID =".$temp;
            $conn->query($sql);
          }
        ?>
      </div>
    </div>

  </div>
  <?php include('footer.php') ?>
</body>
<?php include('js.php') ?>
</html>
