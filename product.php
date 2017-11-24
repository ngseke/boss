<?php session_start(); ?>
<?php include('connection.php'); ?>
<?php
  // 本頁的標題
  $page_name = '所有商品';
  // 如果有從網址列GET到'search'內容
  $search = isset($_GET['search']) ? $_GET['search'] : '';
  if(isset($_GET['search'])){
    $page_name = '搜尋: ' . $search;
  }
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
          <a href="#" class="list-group-item list-group-item-action active">所有商品</a>
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
            $sql = "SELECT * FROM PRODUCT
                    WHERE Name LIKE '%$search%'
                    OR Info LIKE '%$search%' ";

            // $result 存放查詢到的所有物件
            $result = $conn->query($sql);

            // 若執行搜尋，印出提示文字
            echo '<div class="col-12">';
            if(isset($_GET['search'])){
              echo '<div class="alert alert-info">
                      <i class="material-icons">search</i>
                      查到 <strong>'. mysqli_num_rows($result) .'</strong> 項關於 <em>'. $_GET['search'] .'</em> 的商品。
                    </div>';
            }
            echo '</div>';

            // 用迴圈把每列內容取出 存放在$rows 並印出
            while($rows = mysqli_fetch_array($result)){
              $info = mb_substr($rows['Info'], 0,10,'UTF-8') . '...';
              echo '<div class="col-12 col-lg-4 mb-2">
                      <a href="product_detail.php?ID='. $rows['ID'] .'" class="text-dark">
                        <div class="card">
                          <div class="card-body text-center">
                            <img src="' . $rows['Img'] . '" class="img-fluid mb-3">
                            <h5 class="card-title mb-1">' . $rows['Name'] . '</h5>
                            <p class="card-text mb-2">' . $info . '</p>
                            <span class="badge badge-primary ">NT$ ' . $rows['Price'] . '</span>
                          </div>
                        </div>
                      </a>
                    </div>';
            }
          ?>

        </div>
        <hr>
      </div>
    </div>
  </div>
  <?php include('footer.php') ?>
</body>
<!-- 引入JS -->
<?php include('js.php') ?>

</html>
