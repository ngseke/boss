<?php session_start(); ?>
<?php include('connection.php'); ?>
<?php $page_name = '所有商品' ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- 引入CSS等樣式內容 -->
  <?php include('style.php') ?>
  <title><?php echo  $page_name. ' - ' .title_name ?></title>
</head>

<body>
  <!-- 引入導覽列 -->
  <?php include('nav.php') ?>
  <div class="container my-3">
    <div class="row">
      <?php
        $sql = 'SELECT * FROM PRODUCT WHERE ID=' . $_GET['ID'];
        $result = $conn->query($sql);
        $rows = mysqli_fetch_array($result);
      ?>
      <div class="col-12 col-lg-9">
        <p><?php echo $rows['Name'];  ?></p>
        <p>$<?php echo $rows['Price'];  ?></p>
        <p><?php echo $rows['Info'];  ?></p>
        <p>Stock:<?php echo $rows['Stock'];  ?></p>
      </div>
    </div>
  </div>
  <?php include('footer.php') ?>
</body>
<!-- 引入JS -->
<?php include('js.php') ?>

</html>
