<?php session_start(); ?>
<?php include('connection.php'); ?>
<?php
  // 本頁的標題
  $page_name = '所有商品'
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- 引入CSS等樣式內容 -->
  <?php include('style.php') ?>

  <!-- 根據所在頁面 印出對應的標題 -->
  <title><?php echo  $page_name. ' - ' .title_name ?></title>
</head>

<body>
  <!-- 引入導覽列 -->
  <?php include('nav.php') ?>
  <div class="container">
    <div class="row">
      <!-- 左側選單 -->
      <div class="col-12 col-lg-3 mb-3">
        <div class="list-group">
          <a href="#" class="list-group-item list-group-item-action active">  Cras justo odio  </a>
          <a href="#" class="list-group-item list-group-item-action">Dapibus ac facilisis in</a>
          <a href="#" class="list-group-item list-group-item-action">Morbi leo risus</a>
          <a href="#" class="list-group-item list-group-item-action">Porta ac consectetur ac</a>
        </div>
      </div>

      <!-- 右側商品列表 -->
      <div class="col-12 col-lg-9">
        <div class="row">
          <?php
            // 資料庫指令
            $sql = "SELECT * FROM PRODUCT WHERE Name LIKE '%". $_GET['search'] ."%'";
            // $result 存放查詢到的所有物件
            $result = $conn->query($sql);

            // 用迴圈把每列內容取出 存放在$rows
            while($rows = mysqli_fetch_array($result)){
              echo '<div class="col-12 col-lg-4 mb-2">
                <a href="product_detail.php?ID='. $rows['ID'] .'" class="text-dark">
                <div class="card">
                  <div class="card-body text-center">
                    <img src="' . $rows['Img'] . '" class="img-fluid mb-2">
                    <h4 class="card-title">' . $rows['Name'] . '</h4>
                    <p class="card-text">' . $rows['Info'] . '</p>
                    <span class="badge badge-warning">NT$ ' . $rows['Price'] . '</span>
                  </div>
                </div>
                </a>
              </div>';
            }
          ?>


        </div>
      </div>
    </div>
  </div>
  <?php include('footer.php') ?>
</body>
<!-- 引入JS -->
<?php include('js.php') ?>

</html>
