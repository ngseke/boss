<?php session_start(); ?>
<?php include('connection.php'); ?>
<?php $page_name="完成訂單"?>
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
      <div class="col-12">
      <?php include('echo_alert.php') ?>
        <div class="text-center">
          <table class="table table-bordered my-3 ">
            <thead class="thead-dark">
              <tr>
                <th scope="col" class="text-lg-center">訂單詳情</th>
              </tr>
            </thead>
            <tbody>
              <tr class="text-lg-left">
                <?php
                  $OrderID = $_GET['OrderID'];
                  $sql = "SELECT FinalCost FROM ORDER_LIST
                          WHERE ID = '".$OrderID."'";
                  $result = $conn->query($sql);
                  $rows = mysqli_fetch_array($result);
                  $Total = $rows['FinalCost'];
                  echo '
                    <th>
                      訂單編號：<strong>'.$OrderID.'</strong></br>
                      訂單總金額：<strong>NT$ '.number_format($Total).'</strong>
                    </th>';
                ?>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <?php include('footer.php') ?>
</body>
<?php include('js.php') ?>
<script language="Javascript">

</script>
</html>
