<?php session_start(); ?>
<?php include('connection.php'); ?>
<?php $page_name = '所有商品' ?>

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
      ?>


      <div class="col-12 col-lg-10 offset-lg-1">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-12 col-lg-4 text-center">
                <img src="<?php echo $rows['Img'] ?>" class="img-fluid rounded mx-auto d-block" style="max-height: 16rem; width: auto;">
                <span class="badge badge-light star my-3">
                  <i class="material-icons">star</i>
                  <i class="material-icons">star</i>
                  <i class="material-icons">star_half</i>
                  <i class="material-icons">star_border</i>
                  <i class="material-icons">star_border</i>
                </span>
              </div>
              <div class="col-12 col-lg-8">
                <div class="my-3">
                  <h3 class="text-center text-lg-left d-inline"><?php echo $rows['PName']; ?></h3>
                  <span class="badge badge-dark mx-2"><?php echo $rows['Name']; ?></span>
                </div>
                <hr class="my-4">
                <p><?php echo $rows['Info']; ?></p>
                <small>運費 : NT$<strong>60</strong></small>
                <p>
                  <h5 class="d-inline"><span class="badge badge-pill badge-primary" style="margin-right: 1rem;">NT$ <?php echo $rows['Price']; ?></span></h5>
                  <span class="badge badge-pill badge-secondary">庫存: <?php echo $rows['Stock']; ?></span>
                </p>

                <form method="post" action="">
                  <div class="form-group row ">
                    <div class="col-6">
                      <button type="submit" class="btn btn-primary btn-block">加入購物車</button>
                    </div>
                    <label for="Quantity" class="col-auto col-form-label col-form-label-sm">數量</label>
                    <div class="col-2">
                      <input class="form-control form-control-sm" type="number" name="Quantity" min="1" max="999" value="1">
                    </div>
                  </div>
                </form>
                <hr class="my-4">
                <!-- 評論 -->
                <h6>商品評論</h6>
                <div class="list-group">
                  <?php
                  $sql = 'SELECT * FROM Comment WHERE PID='.$_GET['ID'];
                  $result = $conn->query($sql);
                  while($rows=mysqli_fetch_array($result)){
                    $Name=$rows['CID'];
                    $Date=$rows['Date'];
                    $Comment=$rows['Comment'];
                    echo '<a href="#" class="list-group-item list-group-item-action flex-column">
                    <div class="d-flex w-100 justify-content-between">
                    <h6 class="mb-1">'. $Name .'</h6>
                    <small>'. $Date .'</small>
                    </div>
                    <p class="mb-1">'. $Comment .'</p>
                    </a>';
                  }
                  ?>
                  </div>
                  <form action="post_comment.php" method="post" class="mt-3">
                    <div class="row">
                      <div class="col-auto">
                        <span class="badge badge-info"><?php echo $user_id ?></span>
                      </div>
                      <div class="col">
                        <input type="text" name="Comment" class="form-control form-control-sm"  placeholder="<?php if($user_position == 'G') echo'請先登入';else echo'輸入對此商品的評論' ?>" <?php if($user_position == 'G') echo'disabled' ;?> >
                      </div>
                      <div class="col-2">
                        <button type="submit" class="btn btn-primary btn-block btn-sm ">發表</button>
                      </div>
                    </div>
                    <div class="form-group d-none">
                      <input type="text" name="PID" value="<?php echo $_GET['ID']?>" class="form-control form-control-sm" placeholder="">
                    </div>
                  </form>
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

  </html>
