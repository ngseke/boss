<?php session_start(); ?>
<?php include('connection.php'); ?>
<?php $page_name="訂單確認"?>
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
          $CartID = $_GET['CartID'];
          if(isset($CartID)){
            $sql = "INSERT INTO ORDER_LIST(Date, FinalCost, CID, DID, SID)
                    VALUES(CURRENT_TIMESTAMP, '1111', 'zhaozhenting', '3', 'staff')";
            $conn->query($sql);

            $sql = "SELECT PID, Quantity
                    FROM CART_RECORD
                    WHERE ID = '".$CartID."'";
            $result = $conn->query($sql);

            while($rows = mysqli_fetch_array($result)){
              $PID = $rows['PID'];
              $Quantity = $rows['Quantity'];
              $sql = "INSERT INTO ORDER_LIST_RECORD(OID, PID, Quantity)
                      VALUES('1', $PID, $Quantity);";
              echo $sql;
              $conn->query($sql);
            }
          }
        ?>
      </div>
    </div>
  </div>
  <?php include('footer.php') ?>
</body>
<?php include('js.php') ?>
<script language="Javascript">
  // 返回上一頁
  //setTimeout("history.back()", 10);
</script>
</html>
