<?php session_start(); ?>
<?php include('connection.php'); ?>
<?php $page_name="購物車"?>
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
        <table class="table table-bordered">
          <thead class="thead-dark">
            <tr>
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

              $sql = "SELECT C.ID CID, C.DID CDID, P.ID PID, P.Img PIMG, P.Name PName, P.Price PPrice, CR.Quantity CRQ
                      FROM CART C
                      JOIN CART_RECORD CR
                      ON C.ID = CR.ID
                      JOIN PRODUCT P
                      ON CR.PID = P.ID";
              // $result 存放查詢到的所有物件
              $result = $conn->query($sql);
              if(mysqli_num_rows($result)>0){
                while($rows = mysqli_fetch_array($result)){
                  echo '
                  <form action="cart_del.php">
                    <tr>
                      <a href="product_detail.php?ID='. $rows['PID'] .'" class="text-dark">
                        <div class="row no-gutters text-left text-lg-center">
                            <th scope="row" class="text-left">
                              <img src="' . $rows['PIMG'] . '" class="img-fluid mb-3" style="height:7rem; width:auto;">' . $rows['PName'] . '</h5>
                            </th>
                            <th class="align-middle">NT$ ' . $rows['PPrice'] . '</th>
                            <th class="align-middle">'.$rows['CRQ'].'</th>
                            <th class="align-middle">'.$rows['PPrice'] * $rows['CRQ'].'</th>
                            <th class="align-middle">
                              <input type="submit" value="Submit">
                              <input type="hidden" name="temp" value="'.$rows['PID'].'">
                            </th>
                        </div>
                      </a>
                    </tr>
                  </form>';
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
                  <tr class="text-right">
                    <td colspan="5">
                      共<strong>'.$SelectCount.'</strong>件商品　商品金額：<strong>NT$ '. $Total .'</strong></br>
                      運費小計：<strong>NT$ '.$Fare.'</strong></br>
                      <font size="+2">總金額：NT$ <strong>'.$Total.'</strong></font>
                    </td>
                  </tr>';
              }
              else {
                echo'
                  <tr>
                    <td colspan="5">您尚未選購產品</td>
                  </tr>';
              }
            ?>
            <!--<tr>
              <th scope="row" class="text-left"><img src="http://www.pecos.com.tw/tmp/image/20140409/20140409202153_39623.jpg" alt="">
                純喫茶綠茶
              </th>
              <td class="align-middle">25</td>
              <td class="align-middle">1</td>
              <td class="align-middle">25</td>
              <td class="align-middle">
                <button type="button" class="btn btn-outline-dark"><i class="material-icons">delete</i></button>
              </td>
            </tr>
            <tr>
              <td colspan="5">您尚未選購產品</td>
            </tr>-->

          </tbody>
        </table>
      </div>
    </div>

  </div>
  <?php include('footer.php') ?>
</body>
<?php include('js.php') ?>
</html>
