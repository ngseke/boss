<?php session_start(); ?>
<?php include('connection.php'); ?>
<?php
  // 本頁的標題
  $page_name = '商品';
  // // 如果有從使用任一種搜尋
  // if($search_keyword!=NULL || $search_category!=NULL || $price_from!=NULL || $price_to!=NULL)
  //   $page_name = '查詢結果';
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
          <?php
           $list_active =
           !(isset($_GET['category']) ||
           isset($_GET['search']) ||
           isset($_GET['page']))?'active':'';
          ?>
          <a href="product.php?page=search" class="list-group-item list-group-item-action <?php  if(isset($_GET['page']))echo 'active' ?>"><i class="material-icons">search</i> 搜尋</a>
          <a href="product.php" class="list-group-item list-group-item-action <?php echo $list_active ?>">所有商品</a>

          <?php
            $sql = "SELECT CID, CName, COUNT(*) CNum
                    FROM PRODUCT_VIEW GROUP BY CID
                    ORDER BY CID";
            $result = $conn->query($sql);
            while($rows = mysqli_fetch_array($result)){
              // 查詢該類別下有多少筆商品
              if(isset($_GET['category']) && $_GET['category']== $rows['CID']){
                $list_active='active';
              }else $list_active='';
              echo '<a href="product.php?category='. $rows['CID'] .'"
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
            $search_keyword=$search_category=$price_from=$price_to=NULL;
            //基本查詢指令
            $sql = "SELECT * FROM PRODUCT_VIEW
                    WHERE PState = 'in_stock' ";

            if(isset($_GET['keyword'])){
              if($_GET['keyword']!=""){
                // 加入keyword做篩選條件
                $search_keyword=$_GET['keyword'];
                $sql .= "AND (PName LIKE '%$search_keyword%'
                        OR PInfo LIKE '%$search_keyword%'
                        OR CName LIKE '%$search_keyword%') ";
              }
            }
            if(isset($_GET['category'])){
              if($_GET['category']!=""){
                // 加入種類做篩選條件
                $search_category=$_GET['category'];
                $sql .= "AND CID=$search_category ";
              }
            }
            if(isset($_GET['price_from'])&&isset($_GET['price_to'])){
              if(is_numeric($_GET['price_from']) && is_numeric($_GET['price_to'])){
                if($_GET['price_from'] <= $_GET['price_to']){
                  // 加入價做篩選條件
                  $price_from=$_GET['price_from'];
                  $price_to=$_GET['price_to'];
                  $sql .= "AND (PPrice>=$price_from AND PPrice<=$price_to) ";
                }
              }
            }

            $sql .= "ORDER BY CID,PID"; // 令查詢到的項目按類別->PID排序
            $result = $conn->query($sql);  // $result 存放查詢到的所有物件

            if($search_keyword!=NULL || $search_category!=NULL || $price_from!=NULL || $price_to!=NULL)
            echo '<div class="col-12">
                  <div class="alert alert-info">
                    <i class="material-icons">search</i>
                    查到 <strong>'. mysqli_num_rows($result) .'</strong> 項商品。 搜尋條件：';
            if($search_keyword!=NULL)
              echo '<span class="badge badge-light">“ '. $search_keyword .' ”</span> ';
            if($search_category!=NULL)
              echo '<span class="badge badge-light">'. mysqli_fetch_array($conn->query("SELECT Name FROM CATEGORY WHERE ID=$search_category"))['Name'] .'</span> ';
            if($price_from!=NULL && $price_to!=NULL)
              echo '<span class="badge badge-light"> $'. $price_from .' ~ $'. $price_to .'</span> ';

            if($search_keyword!=NULL || $search_category!=NULL || $price_from!=NULL || $price_to!=NULL)
            echo '</div> </div>';

            // 用迴圈把每列內容取出 存放在$rows 並印出
            if(!isset($_GET['page'])){
              while($rows = mysqli_fetch_array($result)){

              // 如果有折扣的話 顯示有折扣後的價格
              $card_border = '';
              $gift_icon = '<span class="position-absolute" style="right:.8rem; top:.8rem;">
                              <i class="material-icons text-info">card_giftcard</i>
                            </span>';
              if($rows['DEventType']=='Discount'){
                $price_text='<span class="badge badge-danger ">NT$ ' . $rows['PPriceDiscountF'] . '</span> ';
                $price_text.='<span class="badge badge-info">Event</span> ';
              } else if($rows['DEventType']=='BOGO'){
                  $price_text='<span class="badge badge-primary ">NT$ ' . $rows['PPriceF'] . '</span> ';
                  $price_text.='<span class="badge badge-info">買一送一</span> ';
              } else{
                $price_text='<span class="badge badge-primary ">NT$ ' . $rows['PPriceF'] . '</span> ';
                $card_border= $gift_icon = '';
              }

              echo '<div class="col-12 col-lg-4 mb-2">
                      <a href="product_detail.php?ID='. $rows['PID'] .'" class="text-dark">
                        <div class="card '. $card_border .'">
                          <div class="card-body position-relative">
                              '.$gift_icon.'
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
            }
          ?>
          <div class="col-12 col-lg-9 <?php if(!isset($_GET['page'])) echo 'd-none'; ?>">
            <?php include('search.php')  ?>
          </div>
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
