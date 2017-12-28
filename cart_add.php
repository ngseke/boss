<?php session_start();?>
<?php include('connection.php'); ?>
<?php $page_name="加入購物車"?>
<?php include ('cart_set.php')?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php include('style.php') ?>
  <title><?php echo  $page_name. ' - ' .title_name ?></title>
  <meta http-equiv="refresh" content="<?php echo 0 ?>;URL=product_detail.php?ID=<?php echo $_POST['PID'] ?>">
  <?php require_once ('js.php') ?>
</head>

<body>
  <?php include('nav.php'); ?>
  <div class="container my-3">
    <?php
      $PID = $_POST['PID'];
      $Quantity = $_POST['Quantity'];
      $sql = "INSERT INTO CART_RECORD(ID, PID, Quantity)
              VALUES('$CartID', $PID, $Quantity)";

      if($conn->query($sql)){
        $_SESSION['AlertMsg'] =
          array('success','<i class="material-icons">done</i> 成功加入購物車！',false);
      }else {
        if (false !==($rst = strpos($conn->error, 'Duplicate'))){
          $_SESSION['AlertMsg'] =
            array('warning','<i class="material-icons">warning</i> 此商品已在購物車中了！',false);
          }
      };
    ?>
  </div>
  <?php include('footer.php') ?>
</body>

<!-- <script language="Javascript">
  // 返回上一頁
  setTimeout("history.back()", 10);
</script> -->
</html>
