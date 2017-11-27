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
        <div class="card py-3">
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
                      <button type="submit" class="btn btn-outline-success btn-block">加入購物車</button>
                    </div>
                  </div>
                </form>
                <hr class="my-4">
                <!-- 評論 -->
                <h6>商品評論</h6>
                <div class="list-group">
                  <?php
                  $sqlnone = 'SELECT COUNT(*) COUNT_NUM FROM Comment
                  WHERE PID='.$_GET['ID'];
                  if( mysqli_fetch_array($conn->query($sqlnone))['COUNT_NUM']==0)
                  echo '<a href="#" class="list-group-item list-group-item-action flex-column">
                  <i class="text-muted">目前尚無評論</i>
                  </a>';
                  $sql = 'SELECT * FROM Comment WHERE PID='.$_GET['ID'];
                  $result = $conn->query($sql);
                  while($rows=mysqli_fetch_array($result)){
                    $Name=$rows['CID'];
                    $Date=$rows['Date'];
                    $Comment=$rows['Comment'];
                    $Star=$rows['Star'];
                    $star_text='<span class="badge badge-light star mx-2">
                                  <i class="material-icons">star</i>'. $Star .'
                                </span>';
                    echo '<a href="#" class="list-group-item list-group-item-action flex-column">
                            <div class="d-flex w-100 justify-content-between">
                              <h6 class="mb-2"><i class="material-icons">account_circle</i> '. $Name . $star_text .'</h6>
                              <small>'. $Date .'</small>
                            </div>
                            <p class="mb-0">'. $Comment .'</p>
                          </a>';
                  }
                  ?>
                </div>
                <form class="row mt-3" action="post_comment.php" method="post" >
                  <div class="col-auto">
                    <span class="badge badge-info"><?php echo $user_id ?></span>
                  </div>
                  <div class="col">
                    <input type="text" name="Comment" class="form-control form-control-sm"  placeholder="<?php if($user_position == 'G') echo'請先登入';else echo'輸入對此商品的評論' ?>" <?php if($user_position == 'G') echo'disabled' ;?> required>
                  </div>
                  <div class="col-3 col-lg-2">
                    <button type="submit" class="btn btn-primary btn-block btn-sm "<?php if($user_position == 'G') echo'disabled' ;?>>發表</button>
                  </div>
                  <div class="form-group d-none">
                    <input type="text" name="PID" value="<?php echo $_GET['ID']?>" placeholder="">
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
