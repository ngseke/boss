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
      <div class="col-12 col-lg-3 mb-3" >
         <?php
            
            // 查詢該類別下有多少筆訂單 這是數量喔喔喔～
            if(isset($_GET['state'])){
              switch ($_GET['state']) {
                case 'all':
                  $sql = "SELECT COUNT(*) Count FROM ORDER_LIST";
                  $result = $conn->query($sql);
                  break;
                case 'processed':
                  $sql = "SELECT COUNT(*) Count 
                          FROM ORDER_LIST
                          WHERE State ='submitted' 
                          OR State ='processed' 
                          OR State ='delivered'";
                  $result = $conn->query($sql);
                  break;
                case 'completed':
                  $sql = "SELECT COUNT(*) Count 
                          FROM ORDER_LIST
                          WHERE State ='completed'";
                  $result = $conn->query($sql);
                  break;
                default:
                  # code...
                  break;
              }
              $rows = mysqli_fetch_array($result);
              $count = $rows[0];
              echo $count;
            }
            if(isset($_GET['state']) && $_GET['state']== $rows['State']){
              $list_active='active';
            }else $list_active='';
            echo '<a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center '. $list_active .'">'. $rows['CName'] .
                  '<span class="badge badge-dark badge-pill">'. $rows['CNum'] .'</span></a>';
              
              
          ?>
        <div class="list-group">
          <a class="list-group-item list-group-item-action <?php echo $list_active ?>" href="customer_order.php?state=all" >所有</a>
          <a class="list-group-item list-group-item-action <?php echo $list_active ?>" href="customer_order.php?state=processed">未完成</a>
          <a class="list-group-item list-group-item-action <?php echo $list_active ?>" href="customer_order.php?state=completed">完成</a>
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
