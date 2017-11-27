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
      $img = $rows['Img'];
      ?>
      <div class="row">
        <div class="col-6 col-lg-6"><img src="<?php echo $rows['Img'] ?>" class="img-fluid rounded mx-auto d-block" ></div>
        <div class="col-12 col-lg-6">
          <p><h3><?php echo $rows['Name']; ?></h3></p>
          <p><?php echo $rows['Info']; ?></p>
          <p>
            <span class="badge badge-pill badge-primary" style="margin-right: 1rem;">$<?php echo $rows['Price']; ?></span>
            <span class="badge badge-pill badge-secondary">Stock:<?php echo $rows['Stock']; ?></span>
          </p>
          <p><button type="button" class="btn btn-danger">加入購物車</button></p>
        </div>
      </div>  
    </div>
  </div>
  <?php include('footer.php') ?>
</body>
<!-- 引入JS -->
<?php include('js.php') ?>

</html>
