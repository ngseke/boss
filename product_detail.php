<?php session_start(); ?>
<?php include('connection.php'); ?>
<?php
$sql = "SELECT *, P.ID PID ,P.Name PName, C.Name CName FROM PRODUCT P
INNER JOIN CATEGORY C
ON P.CategoryID = C.ID
WHERE P.CategoryID = C.ID
AND P.ID = ".$_GET['ID'];
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
</head>

<body>
  <!-- 引入導覽列 -->
  <?php include('nav.php') ?>
  <div class="container my-3">
    <div class="row">
      <?php
      $sql = "SELECT *, P.ID PID ,P.Name PName, C.Name CName FROM PRODUCT P
      INNER JOIN CATEGORY C
      ON P.CategoryID = C.ID
      WHERE P.CategoryID = C.ID
      AND P.ID = ".$_GET['ID'];
      $result = $conn->query($sql);
      $rows = mysqli_fetch_array($result);
      $img = $rows['Img'];
      if(product_detail_animation_mode)
        $product_detail_animation='id="product-detail"';
      else
        $product_detail_animation='';
      ?>

      <div class="col-12 col-lg-10 offset-lg-1">
        <div class="card py-3 " <?php echo $product_detail_animation ?>>
          <div class="card-body">
            <div class="row">
              <div class="col-12 col-lg-4 text-center">
                <img src="<?php echo $rows['Img'] ?>" class="img-fluid rounded mx-auto d-block" style="max-height: 16rem; width: auto;">
                <?php include 'product_get_star.php' ?>
              </div>
              <div class="col-12 col-lg-8">
                <div class="mb-3">
                  <h2 class="text-center text-lg-left d-inline"><?php echo $rows['PName']; ?></h2>
                  <span class="badge badge-dark badge-pill mx-2"><?php echo $rows['Name']; ?></span>
                </div>
                <hr class="my-4">
                <p><?php echo $rows['Info']; ?></p>
                <div class="card bg-light border-light">
                  <div class="card-body">
                    <h4 class="text-danger d-inline-block">NT$ </h4>
                    <h1 class="text-danger d-inline-block"><?php echo $rows['Price']; ?></h1>
                    <div >
                      <span class="badge badge-pill badge-primary">運費: NT $60</span>
                      <span class="badge badge-pill badge-success">庫存: <?php echo $rows['Stock']; ?></span>
                    </div>
                  </div>
                </div>
                <form class="my-4" method="post" action="">
                  <div class="form-group row ">
                    <div class="input-group col-6 col-lg-3 ">
                      <span class="input-group-addon">數量</span>
                      <input class="form-control form-control-sm" type="number" name="Quantity" min="1" max="999" value="1">
                    </div>
                    <div class="input-group col-6 col-lg-5 ">
                      <input class="form-control d-none" type="text" name="ID"  value="<?php echo $_GET['ID'] ?>">
                      <button type="submit" class="btn btn-outline-success btn-block"><i class="material-icons">add_shopping_cart</i> 加入購物車</button>
                    </div>
                  </div>
                </form>
                <hr class="my-4">
                <!-- 評論 -->
                <?php include 'comment.php' ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include('footer.php') ?>
</body>
<!-- 引入JS -->
<?php include('js.php') ?>

</script>
</html>
