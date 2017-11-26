<?php session_start(); ?>
<?php include('connection.php'); ?>
<?php
  // 本頁的標題
  $page_name = '所有商品';
  // 如果有從網址列GET到'search'內容
  $search = isset($_GET['search']) ? $_GET['search'] : '';
  if(isset($_GET['search'])){
    // set本頁面名稱為搜尋的內容
    $page_name = '搜尋: ' . $search;
  }else if(isset($_GET['category_id'])){
    // set本頁面名稱為選擇的Category
    $sql = "SELECT Name N FROM CATEGORY C WHERE ID=". $_GET['category_id'];
    $page_name = mysqli_fetch_array($conn->query($sql))['N'];
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
  <div class="container my-3">
    <div class="row">
      <!-- 左側選單 -->
      <div class="col-12 col-lg-3 mb-3">
        <div class="list-group">
          <?php $list_active = !(isset($_GET['category_id'])||isset($_GET['search']))?'active':''  ?>
          <a href="product.php" class="list-group-item list-group-item-action <?php echo $list_active ?>">所有商品</a>
          <?php
            $sql = "SELECT * FROM CATEGORY C ORDER BY ID ASC";
            $result = $conn->query($sql);

            while($rows = mysqli_fetch_array($result)){
              // 查詢該類別下有多少筆商品
              $sql1 = "SELECT COUNT(*) COUNT_NUM FROM PRODUCT P, CATEGORY C
                      WHERE P.CategoryID = C.ID
                      AND P.CategoryID =" . $rows['ID'];
              if(isset($_GET['category_id']) && $_GET['category_id']== $rows['ID']){
                $list_active='active';
              }else $list_active='';
              echo '<a href="product.php?category_id='. $rows['ID'] .'"
                      class="list-group-item list-group-item-action d-flex justify-content-between align-items-center '. $list_active .'">'. $rows['Name'] .
                    '<span class="badge badge-dark badge-pill">'. mysqli_fetch_array($conn->query($sql1))['COUNT_NUM'] .'</span></a>';
            }
          ?>
        </div>
      </div>

      <!-- 右側商品列表 -->
      <div class="col-12 col-lg-9">
        <div class="row">
          <?php
            // 資料庫指令
            $sql = "SELECT *, P.Name PName, C.Name CName FROM PRODUCT P
                    INNER JOIN CATEGORY C
                    ON P.CategoryID = C.ID
                    WHERE P.CategoryID = C.ID
                    AND (P.Name LIKE '%$search%'
                    OR P.Info LIKE '%$search%') ";

            if(isset($_GET['category_id'])){
              $sql = "SELECT *, P.Name PName, C.Name CName FROM PRODUCT P, CATEGORY C
                      WHERE P.CategoryID = C.ID
                      AND P.CategoryID =" . $_GET['category_id'];
            }

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
                            <img src="' . $rows['Img'] . '" class="img-fluid mb-3" style="max-height:7rem;">
                            <h5 class="card-title mb-1">' . $rows['PName'] . '</h5>
                            <p class="card-text mb-2">' . $info . '</p>
                            <span class="badge badge-primary ">NT$ ' . $rows['Price'] . '</span>
                            <span class="badge badge-dark ">' . $rows['CName'] . '</span>
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
