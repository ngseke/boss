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
  <?php require_once ('js.php') ?>
</head>

<body>
  <?php include('nav.php'); ?>
  <div class="container my-3">
    <div class="row" >
      <div class="col-12 text-center ">
        <?php include('echo_alert.php') ?>
        <h2 class="d-inline-block my-3" style="border-bottom:5px #333 solid;">購物車</h2>
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
            <?php include 'price_calculate.php'; ?>
            <tr class="text-right">
              <td colspan="6">
                <?php
                  echo '共<strong>'.$SelectCount.'</strong>件商品　商品總金額：<strong>NT$ '.number_format($IniTotal).'</strong></br>';
                  echo '運費小計：<strong>NT$ '.$Fare.'</strong></br>';
                  if($IniTotal == $FinalTotal)
                    echo '<font size="+2">總金額：NT$ <strong>'.number_format($FinalTotal + $Fare).'</strong></font>';
                  else
                    echo '<font size="+2">總金額：<font size="-1"><del>NT$ '.number_format($IniTotal + $Fare).'</del></font>NT$ <strong>'.number_format($FinalTotal + $Fare).'</strong></font>';
                ?>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-12 col-lg-6 offset-lg-3 text-center ">
        <?php
          if($FinalTotal > 0)
            echo'<a class="btn btn-outline-dark" href="order.php?CartID='.$CartID.'">確認訂單</a>';
        ?>
      </div>
    </div>
  </div>
  <?php include('footer.php') ?>
</body>
</html>
