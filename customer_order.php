<?php session_start(); ?>
<?php include('connection.php'); ?>
<?php
  // 本頁的標題
  $page_name = '訂單';
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
          <a href="product.php" class="list-group-item list-group-item-action <?php echo $list_active ?>">訂單狀態</a>
          <?php
            $sql = "SELECT State,COUNT(*) ID
                    FROM ORDER_LIST GROUP BY CID
                    ORDER BY Date";
            $result = $conn->query($sql);
            while($rows = mysqli_fetch_array($result)){
              // 查詢該類別下有多少筆訂單
              if($rows['State']=='completed') $states = 'c';
              else $states = 'p';
              if(isset($_GET['state']) && $_GET['state']== $rows['CID']){
                $list_active='active';
              }else $list_active='';
              echo '<a href="product.php?state='. $rows['CID'] .'"
                      class="list-group-item list-group-item-action d-flex justify-content-between align-items-center '. $list_active .'">'. $rows['CName'] .
                    '<span class="badge badge-dark badge-pill">'. $rows['CNum'] .'</span></a>';
            }
          ?>
        </div>
      </div>
        
    </div>
  </div>
  <?php include('jumbotron/page2.php') ?>
  <?php include('footer.php') ?>
</body>
<!-- 引入JS -->
<?php include('js.php') ?>

</html>
