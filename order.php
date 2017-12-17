<?php session_start(); ?>
<?php include('connection.php'); ?>
<?php $page_name="訂單確認"?>
<?php include ('order_set.php')?>
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
  <div class="container my-3">
    <div class="row" >
      <div class="col-12 text-center ">
        <?php
          $CartID = $_GET['CartID'];
          if(isset($CartID)){
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
          }
        ?>
        <div class="col-12 text-center ">
          <?php include('echo_alert.php') ?>
          <h2 class="d-inline-block my-3" style="border-bottom:5px #333 solid;">訂單詳情</h2>
          <table class="table table-bordered my-3">
            <thead class="thead-dark text-center">
              <tr>
                <th scope="col" class="text-center" style="width:8rem;"></th>
                <th scope="col">商品名稱</th>
                <th scope="col">單價</th>
                <th scope="col">數量</th>
                <th scope="col">小計</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $Total = 0;
                $SelectCount = 0;
                $Fare = 60;
                // 資料庫指令
                $sql = "SELECT O.Quantity OQ, P.DID PDID, P.PPrice PPrice,
                        P.PPriceDiscount PPriceD, P.DEvent PDEvent, P.PImg PIMG, P.PName PName
                        FROM ORDER_LIST_RECORD O
                        JOIN PRODUCT_VIEW P ON O.PID = P.PID
                        WHERE O.OID='".$OrderID."'";
                $result = $conn->query($sql);

                while($rows = mysqli_fetch_array($result)){
                  $CountQuantity = 0;
                  $cost = 0;
                  if($rows['PDID'] == 3){
                    if($rows['OQ'] % 2 == 0) $CountQuantity = $rows['OQ'] / 2;
                    else $CountQuantity = floor($rows['OQ'] / 2) + 1;
                  }
                  else $CountQuantity = $rows['OQ'];
                  if($rows['PPriceD'] != ''){ //有折扣
                    $cost = round($rows['PPriceD']);
                  }
                  else{
                    $cost = $rows['PPrice'];
                  }
                  echo '<tr class="text-lg-center" >
                          <th>
                            <img src="'.$rows['PIMG'].'" class="img-fluid " style="max-height:5rem;">
                          </th>
                          <th scope="row" class="text-left align-middle">'.$rows['PName'].'</br>'.$rows['PDEvent'].'</th>
                          <th class="align-middle">NT$ '.number_format($cost).'</th>
                          <th class="align-middle">'.$rows['OQ'].'</th>
                          <th class="align-middle">NT$ '.number_format($cost * $CountQuantity).'</th>
                        </tr>';
                  $Total += $cost * $CountQuantity;
                  $SelectCount += $rows['OQ'];
                }
              ?>
              <tr class="text-right">
                <td colspan="6">
                  <?php echo '共<strong>'.$SelectCount.'</strong>件商品　商品金額：<strong>NT$ '.number_format($Total).'</strong></br>';
                  if($Total<1000) $Total += $Fare;
                  else $Fare = 0;
                  echo '運費小計：<strong>NT$ '.$Fare.'</strong></br>';
                  echo '<font size="+2">總金額：NT$ <strong>'.number_format($Total).'</strong></font>'; ?>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-12 col-lg-6 offset-lg-3 text-center ">
          <?php
            $sql = "UPDATE ORDER_LIST
                    SET FinalCost = $Total, State = 'Submitted'
                    WHERE ID = '".$OrderID."'";
            $conn->query($sql);
            echo'<a class="btn btn-outline-dark" href="order_submit.php?OrderID='.$OrderID.'&&CartID='.$CartID.'"><i class="material-icons">送出訂單</i></a>
                 <a class="btn btn-outline-dark" href="order_del.php?OrderID='.$OrderID.'&&CartID='.$CartID.'"><i class="material-icons">取消訂單</i></a>';
          ?>
        </div>
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
