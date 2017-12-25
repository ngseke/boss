<?php session_start(); ?>
<?php include('connection.php'); ?>
<?php $page_name="提交訂單"?>
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
      <?php
        $CartID = $_GET['CartID'];
        $Total = $_GET['Total'];
        $sql = "SELECT COUNT(*)
                FROM CART_RECORD
                WHERE ID = '".$CartID."'";
        $result = $conn->query($sql);
        $rows = mysqli_fetch_array($result);
        echo'<div class="col-12 text-center">用戶資料讀取中...</div>';
        if($rows[0]!=0){
          if($user_id == "guest"){
            $_SESSION['AlertMsg'] =
            array('warning','<i class="material-icons">warning</i> 尚未登入！',false);
            echo '<meta http-equiv=REFRESH CONTENT=1;url=login.php>';
          }
          else{
            include('order_set.php');
            $sql = "SELECT PID, Quantity
                    FROM CART_RECORD
                    WHERE ID = '".$CartID."'";
            $result = $conn->query($sql);

            while($rows = mysqli_fetch_array($result)){
              $PID = $rows['PID'];
              $Quantity = $rows['Quantity'];
              $sql = "INSERT INTO ORDER_LIST_RECORD(OID, PID, Quantity)
                      VALUES('$OrderID', $PID, $Quantity);";
              $conn->query($sql);
            }
            $sql = "UPDATE ORDER_LIST
                    SET FinalCost = $Total
                    WHERE ID='".$OrderID."'";
            $conn->query($sql);
            $sql = "DELETE FROM CART_RECORD
                    WHERE ID='".$CartID."'";
            $conn->query($sql);
            $sql = "DELETE FROM CART
                    WHERE ID='".$CartID."'";
            $conn->query($sql);
            $_SESSION['AlertMsg'] =
            array('success','<i class="material-icons">done</i> 訂單已成功送出！',false);
            echo '<meta http-equiv=REFRESH CONTENT=1;url=order_finish.php?OrderID='.$OrderID.'>';
          }
        }
      ?>
    </div>
  </div>
  <?php include('footer.php') ?>
</body>
<?php include('js.php') ?>
</html>
