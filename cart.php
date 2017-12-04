<?php session_start();?>
<?php include('connection.php'); ?>
<?php $page_name="購物車"?>
<?php include ('cart_set.php')?>

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
        <?php include('echo_alert.php') ?>
        <h2 class="d-inline-block my-3" style="border-bottom:5px #333 solid;">看購物車</h2>
        <p class="text-muted"><?php echo $CartID ?></p>
        <table class="table table-bordered my-3">
          <thead class="thead-dark text-center">
            <tr>
              <th scope="col" class="text-center" style="width:8rem;"></th>
              <th scope="col">商品名稱</th>
              <th scope="col">單價</th>
              <th scope="col">數量</th>
              <th scope="col">小計</th>
              <th scope="col">刪除</th>
            </tr>
          </thead>
          <tbody>
            <?php
              // 資料庫指令
              $sql = "SELECT P.PID PID, P.PImg PIMG, P.PName PName, P.PPrice PPrice, CR.Quantity CRQ
                      FROM CART C
                      JOIN CART_RECORD CR ON C.ID = CR.ID
                      JOIN PRODUCT_VIEW P ON CR.PID = P.PID
                      WHERE C.ID='".$CartID."'";
              $result = $conn->query($sql);
              if(mysqli_num_rows($result)>0){
                while($rows = mysqli_fetch_array($result)){
                  echo '<tr class="text-lg-center" >
                          <th>
                            <img src="' . $rows['PIMG'] . '" class="img-fluid " style="max-height:5rem;">
                          </th>
                          <th scope="row" class="text-left align-middle">'
                            . $rows['PName'] . '
                          </th>
                          <th class="align-middle">NT$ ' . $rows['PPrice'] . '</th>
                          <th class="align-middle">'.$rows['CRQ'].'</th>
                          <th class="align-middle">'.$rows['PPrice'] * $rows['CRQ'].'</th>
                          <th class="align-middle">
                            <a class="btn btn-outline-dark" href="cart_del.php?CartID='.$CartID.'&PID='.$rows['PID'].'"><i class="material-icons">delete</i></a>
                          </th>
                        </tr>';
                }

                $result2 = $conn->query($sql);
                $SelectCount = 0;
                $Total = 0;
                $Fare = 60;
                while($rows = mysqli_fetch_array($result2)){
                  $SelectCount += $rows['CRQ'];
                  $Total += $rows['CRQ'] * $rows['PPrice'];
                }
                if($Total<1000) $Total+=$Fare;
                else $Fare=0;
                echo '
                  <form action="cart_del.php" method="post">
                  <input type="hidden" name="temp" value="' . $rows['PID'] . '">
                  <tr class="text-right">
                    <td colspan="6">
                      共<strong>'.$SelectCount.'</strong>件商品　商品金額：<strong>NT$ '. $Total .'</strong></br>
                      運費小計：<strong>NT$ '.$Fare.'</strong></br>
                      <font size="+2">總金額：NT$ <strong>'.$Total.'</strong></font>
                    </td>
                  </tr>';
              }
              else {
                echo'
                  <tr>
                    <td colspan="6">您尚未選購產品</td>
                  </tr>';
              }

            ?>
          </tbody>
        </table>
      </div>
      <div class="col-12 col-lg-6 offset-lg-3 text-center ">
        <a class="btn btn-outline-dark btn-block" href="#">確認訂單</a>
      </div>
    </div>

  </div>
  <?php include('footer.php') ?>
</body>
<?php include('js.php') ?>
</html>
