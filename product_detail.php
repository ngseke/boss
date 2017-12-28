<?php session_start(); ?>
<?php include('connection.php'); ?>
<?php
$sql = "SELECT * FROM PRODUCT_VIEW WHERE PID = ".$_GET['ID'];
$page_name = mysqli_fetch_array($conn->query($sql))['PName'];
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- 引入CSS等樣式內容 -->
  <?php include('style.php') ?>
  <title><?php echo  $page_name. ' - ' .title_name ?></title>
  <?php
  if(!($user_position=='A'||$user_position=='S'))
    die ('<meta http-equiv="refresh" content="0;URL=index.php">');
  ?>
  <?php require_once ('js.php') ?>
</head>

<body>
  <!-- 引入導覽列 -->
  <?php include('nav.php') ?>
  <div class="container my-3">
    <?php include('echo_alert.php') ?>
    <div class="row">
      <?php
      $sql = "SELECT * FROM PRODUCT_VIEW WHERE PID = ".$_GET['ID'];

      $result = $conn->query($sql);
      $rows = mysqli_fetch_array($result);
      ?>

      <div class="col-12 col-lg-12 offset-lg-0">
        <div class="card py-3 " >
          <div class="card-body">
            <div class="row">

              <div class="col-12 col-lg-4 text-center">
                <img src="<?php echo $rows['PImg'] ?>" class="img-fluid rounded mx-auto d-block" style="max-height: 16rem; width: auto;">
                <?php include 'product_get_star.php' ?>
              </div>
              <div class="col-12 col-lg-8">
                <div class="mb-3">
                  <h2 class="text-center text-lg-left d-inline"><?php echo $rows['PName']; ?></h2>
                  <span class="badge badge-dark badge-pill mx-2"><?php echo $rows['CName']; ?></span>
                </div>

                <hr class="my-4">
                <p><?php echo $rows['PInfo']; ?></p>
                <div class="card bg-light border-light">
                  <div class="card-body">
                    <div class="">
                      <h4 class="text-danger d-inline-block">NT$ </h4>
                      <?php
                      if($rows['PPriceDiscountF'] != ''){ // 有折扣
                          echo '<h1 class="text-danger d-inline-block price">'. $rows['PPriceDiscountF'].'</h1>';
                          echo '<h5 class="text-muted d-inline-block ml-2 "><del>NT$ '. $rows['PPriceF'].'</del></h5>';
                      }else{ // 無折扣
                        echo '<h1 class="text-danger d-inline-block price">'. $rows['PPriceF'].'</h1>';
                      }
                      ?>

                    </div>
                    <div>
                      <span class="badge badge-pill badge-primary">運費: NT $60</span>
                      <span class="badge badge-pill badge-success">庫存: <?php echo $rows['PStock']; ?></span>
                      <!-- 印出資訊折扣的資訊 -->
                      <?php include 'product_discount.php'; ?>
                    </div>
                  </div>
                </div>
                <form class="my-4" method="post" action="cart_add.php">
                  <div class="form-group row ">
                    <div class="input-group col-12 col-lg-3 ">
                      <span class="input-group-addon">數量</span>
                      <input class="form-control form-control-sm" type="number" name="Quantity" min="1" max="99" value="1">
                    </div>
                    <div class="input-group col-12 mt-2 col-lg-5 mt-lg-0">
                      <input class="form-control d-none" type="text" name="PID" value="<?php echo $_GET['ID'] ?>">
                      <button type="submit" class="btn btn-outline-success btn-block">
                        <i class="material-icons">add_shopping_cart</i> 加入購物車
                      </button>
                    </div>
                  </div>
                </form>
                <hr class="my-4">
                <!-- 評論 -->
                <?php include ('comment.php') ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include('footer.php') ?>
</body>

</html>
