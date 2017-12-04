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
      <div class="col-12 col-lg-3 mb-3" style="max-height:30rem; overflow-y: scroll; overflow-x: hidden;">
        <div class="list-group">
          <?php $list_active = !(isset($_GET['category_id'])||isset($_GET['search']))?'active':''  ?>
          <a href="product.php" class="list-group-item list-group-item-action <?php echo $list_active ?>">所有商品</a>
          <?php
            $sql = "SELECT CID, CName, COUNT(*) CNum
                    FROM PRODUCT_VIEW GROUP BY CID
                    ORDER BY CID";
            $result = $conn->query($sql);
            while($rows = mysqli_fetch_array($result)){
              // 查詢該類別下有多少筆商品
              if(isset($_GET['category_id']) && $_GET['category_id']== $rows['CID']){
                $list_active='active';
              }else $list_active='';
              echo '<a href="product.php?category_id='. $rows['CID'] .'"
                      class="list-group-item list-group-item-action d-flex justify-content-between align-items-center '. $list_active .'">'. $rows['CName'] .
                    '<span class="badge badge-dark badge-pill">'. $rows['CNum'] .'</span></a>';
            }
          ?>
        </div>
      </div>

      <!-- 右側商品列表 -->
      <div class="col-12 col-lg-9">
        <div class="row">
          <?php
            // 資料庫指令
            $sql = "SELECT * FROM PRODUCT_VIEW
                    WHERE (PName LIKE '%$search%'
                    OR PInfo LIKE '%$search%'
                    OR CName LIKE '%$search%')
                    AND PState = 'in_stock'
                    ORDER BY CID, PID";

            if(isset($_GET['category_id'])){
              $sql = "SELECT * FROM PRODUCT_VIEW
                      WHERE PState = 'in_stock'
                      AND CID =" . $_GET['category_id'];
            }

            // $result 存放查詢到的所有物件
            $result = $conn->query($sql);
            echo '<div class="col-12">';
            // 若執行搜尋，印出提示文字
            if(isset($_GET['search'])){
              echo '<div class="alert alert-info">
                      <i class="material-icons">search</i>
                      查到 <strong>'. mysqli_num_rows($result) .'</strong> 項關於 <em>'. $_GET['search'] .'</em> 的商品。
                    </div>';
            }else if(isset($_GET['category_id'])){ // 若以分類查詢
              echo '<div class="alert alert-info">
                      <i class="material-icons">search</i>
                      查到 <strong>'. mysqli_num_rows($result) .'</strong> 項類別為 <em>'. mysqli_fetch_array($conn->query('SELECT Name FROM CATEGORY WHERE ID='.$_GET['category_id']))['Name'] .'</em> 的商品。
                    </div>';
            }
            echo '</div>';

            // 用迴圈把每列內容取出 存放在$rows 並印出
            $i=0;
            while($rows = mysqli_fetch_array($result)){
              if(product_item_animation_mode)
                $product_animation='id="product-item" style="animation-delay: '. ($i) .'s;"';
              else
                $product_animation='';

              // 如果有折扣的話 顯示有折扣後的價格
              $card_border = 'border-info';
              if($rows['DEventType']=='Discount'){
                $price_text='<span class="badge badge-danger ">NT$ ' . $rows['PPriceDiscountF'] . '</span> ';
                $price_text.='<span class="badge badge-info">Event</span> ';
              } else if($rows['DEventType']=='BOGO'){
                  $price_text='<span class="badge badge-primary ">NT$ ' . $rows['PPriceF'] . '</span> ';
                  $price_text.='<span class="badge badge-info">買一送一</span> ';
              } else{
                $price_text='<span class="badge badge-primary ">NT$ ' . $rows['PPriceF'] . '</span> ';
                $card_border = '';
              }
              $i+=0.06;
              echo '<div class="col-12 col-lg-4 mb-2">
                      <a href="product_detail.php?ID='. $rows['PID'] .'" class="text-dark">
                        <div class="card '. $card_border .'" '. $product_animation .'>
                          <div class="card-body">
                            <div class="row no-gutters text-left text-lg-center">
                              <div class="col-4 col-lg-12 text-center">
                              <img src="' . $rows['PImg'] . '" class="img-fluid mb-3" style="max-height:6rem; width:auto;">
                              </div>
                              <div class="col-8 col-lg-12">
                                <h5 class="card-title mb-1 text-truncate">' . $rows['PName'] . '</h5>
                                <p class="card-text mb-2 text-truncate">' . $rows['PInfo'] . '</p>'
                                 . $price_text . '
                                <span class="badge badge-dark ">' . $rows['CName'] . '</span>
                              </div>
                            </div>
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
  <?php include('jumbotron/page2.php') ?>
  <?php include('footer.php') ?>
</body>
<!-- 引入JS -->
<?php include('js.php') ?>

</html>
