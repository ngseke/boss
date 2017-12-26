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
            if(isset($_GET['state'])){
              $state=$_GET['state'];
            }
            // 查詢該類別下有多少筆訂單 這是數量喔喔喔～
            $sql = "SELECT COUNT(*) Count FROM ORDER_LIST";
                  $result = $conn->query($sql);
                  $all = mysqli_fetch_array($result)[0];

            $sql = "SELECT COUNT(*) Count 
                          FROM ORDER_LIST
                          WHERE State ='submitted' 
                          OR State ='processed' 
                          OR State ='delivered'";
                  $result = $conn->query($sql);
                  $processed=mysqli_fetch_array($result)[0];

            $sql = "SELECT COUNT(*) Count 
                          FROM ORDER_LIST
                          WHERE State ='completed'";
                  $result = $conn->query($sql);
                  $completed=mysqli_fetch_array($result)[0];



            if(isset($_GET['state'])){
              switch ($_GET['state']) {
                case 'all':
                  
                  break;
                case 'processed':
                  
                  break;
                case 'completed':
                  
                  break;
                default:
                  # code...
                  break;
              }
            }

          ?>
        <div class="list-group">
          <a href="customer_order.php?state=all" class="list-group-item list-group-item-action <?=($state == 'all')?'active':'' ?>" >所有 <span class="badge badge-dark badge-pill"><?php echo $all ?></span></a>
          <a href="customer_order.php?state=processed" class="list-group-item list-group-item-action  <?=($state == 'processed')?'active':'' ?>" >未完成 <span class="badge badge-dark badge-pill"><?php echo $processed ?></span></a>
          <a href="customer_order.php?state=completed" class="list-group-item list-group-item-action <?=($state == 'completed')?'active':'' ?>" >完成 <span class="badge badge-dark badge-pill"><?php echo $completed ?></span></a>
        </div>
      </div>

      <!-- 右側訂單列表 -->
      
        
    </div>
  </div>
  <?php include('jumbotron/page2.php') ?>
  <?php include('footer.php') ?>
</body>
<!-- 引入JS -->
<?php include('js.php') ?>

</html>
