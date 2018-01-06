<?php
session_start();
include('connection.php');
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

  // 查看所有DISCOUNT中的項目
  if(isset($_GET['discount'])){
    $sql.= "AND (DEventType IS NOT NULL)";
  }

  $sql .= "ORDER BY CID,PID"; // 令查詢到的項目按類別->PID排序
  $result = $conn->query($sql);  // $result 存放查詢到的所有物件

  // if($search_keyword!=NULL || $search_category!=NULL || $price_from!=NULL || $price_to!=NULL)
  // echo '<div class="col-12">
  // <div class="alert alert-info">
  // <i class="material-icons">search</i>
  // 查到 <strong>'. mysqli_num_rows($result) .'</strong> 項商品。 搜尋條件：';
  // if($search_keyword!=NULL)
  // echo '<span class="badge badge-light">“'. $search_keyword .'”</span> ';
  // if($search_category!=NULL)
  // echo '<span class="badge badge-light">'. mysqli_fetch_array($conn->query("SELECT Name FROM CATEGORY WHERE ID=$search_category"))['Name'] .'</span> ';
  // if($price_from!=NULL && $price_to!=NULL)
  // echo '<span class="badge badge-light"> $'. $price_from .' ~ $'. $price_to .'</span> ';
  //
  // if($search_keyword!=NULL || $search_category!=NULL || $price_from!=NULL || $price_to!=NULL)
  // echo '</div></div>';

  $data = array();
  while ($rows = mysqli_fetch_assoc($result)) {
    $data[] = $rows;
  }
  echo json_encode($data,JSON_UNESCAPED_UNICODE);
