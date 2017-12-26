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
      <div class="col-3">
        <?php
        if(isset($_GET['state'])){
          $state=$_GET['state'];
        }
      // 查詢該類別下有多少筆訂單 這是數量喔喔喔～
      //查詢全部的訂單
        $sql = "SELECT COUNT(*) Count FROM ORDER_LIST";
        $result = $conn->query($sql);
        $all = mysqli_fetch_array($result)[0];
      //查詢未完成的訂單
        $sql = "SELECT COUNT(*) Count 
        FROM ORDER_LIST
        WHERE State ='submitted' 
        OR State ='processed' 
        OR State ='delivered'";
        $result = $conn->query($sql);
        $processed=mysqli_fetch_array($result)[0];
      //查詢已完成的訂單
        $sql = "SELECT COUNT(*) Count 
        FROM ORDER_LIST
        WHERE State ='completed'";
        $result = $conn->query($sql);
        $completed=mysqli_fetch_array($result)[0];
        ?>

        <div class="list-group">
          <a href="customer_order.php?state=all" class="list-group-item list-group-item-action <?=($state == 'all')?'active':'' ?>" >所有 <span class="badge badge-dark badge-pill"><?php echo $all ?></span></a>
          <a href="customer_order.php?state=processed" class="list-group-item list-group-item-action  <?=($state == 'processed')?'active':'' ?>" >未完成 <span class="badge badge-dark badge-pill"><?php echo $processed ?></span></a>
          <a href="customer_order.php?state=completed" class="list-group-item list-group-item-action <?=($state == 'completed')?'active':'' ?>" >完成 <span class="badge badge-dark badge-pill"><?php echo $completed ?></span></a>
        </div>
      </div>

      <!-- 右側訂單列表 -->

      <?php 
      //變數宣告 是駝峰式的喔～
      $orderNumber = '';//訂單日期與編號
      $orderProgressBar = '';//訂單狀態列
      $orderInformation = '';//收件者資訊
      $orderDetail = '';//訂單詳細內容
      $orderCost = '';//訂單總金額
      $isSubmitted = '';
      $isProcessed = '';
      $isDelivered = '';
      $isCompleted = '';


      


      //印出資訊的方遜
      function PrintOrder($orderNumber,$orderProgressBar,$orderInformation,$orderDetail,$orderCost) {
        echo $orderNumber.$orderProgressBar.$orderInformation.$orderDetail.$orderCost;
      }

      if(isset($_GET['state'])){
        switch ($_GET['state']) {
          case 'all':
          //查詢全部的訂單
          $sql = "SELECT * FROM ORDER_LIST";
          $result = $conn->query($sql);
          
          while($rowsAll = mysqli_fetch_array($result)){

            switch ($rowsAll['State']) {
              case 'submitted':
              $isSubmitted='bg-secondary';
              $isProcessed='bg-primary';
              $isDelivered='bg-primary';
              $isCompleted='bg-primary';
              break;
              case 'processed':
              $isSubmitted='bg-secondary';
              $isProcessed='bg-secondary';
              $isDelivered='bg-primary';
              $isCompleted='bg-primary';
              break;
              case 'delivered':
              $isSubmitted='bg-secondary';
              $isProcessed='bg-secondary';
              $isDelivered='bg-secondary';
              $isCompleted='bg-primary';
              break;
              case 'completed':
              $isSubmitted='bg-success';
              $isProcessed='bg-success';
              $isDelivered='bg-success';
              $isCompleted='bg-success';
              break; 
              default:
              echo 'bitch!';
              break;
            }


            $orderNumber.='<div class="col-9"><div class="card mb-3"><h5 class="card-header">
            <strong>'.$rowsAll['Date'].'</strong>訂單編號 : '.$rowsAll['ID'].'</h5>';
            
            $orderProgressBar .='<div class="card-body"><div class="row"><div class="col-12 mb-3">
            <div class="progress" style="height: 2rem;">
            <div class="progress-bar '.$isSubmitted.'text-light " style="width: 25%; ">已提交</div>
            <div class="progress-bar '.$isProcessed.'text-light " style="width: 25%; ">處理中</div>
            <div class="progress-bar '.$isDelivered.'text-light " style="width: 25%; ">運輸中</div>
            <div class="progress-bar '.$isCompleted.'text-light " style="width: 25%; ">已完成</div>
            </div></div>';

            $orderInformation .='<div class="col-4"><strong>收件人:</strong>'.$user_name.'</div>
            <div class="col-6"><strong>收件人電話:</strong> '.$user_phone.'</div>
            <div class="col-6"><strong>收件地址:</strong> '.$user_address.'</div>'; 

            $orderDetail .= ' <div class="col-12">
            <table class="table table-hover table-sm mt-3">
            <thead class="thead-dark">
            <tr>
            <th scope="col" style="width:2rem;">#</th>
            <th scope="col" style="width:4rem;"></th>
            <th scope="col">商品名稱</th>
            <th scope="col">單價</th>
            <th scope="col">數量</th>
            </tr>

            </thead>
            <tbody>
            <tr>
            <th class="align-middle" scope="row">1</th>
            <td class="text-center"><img src="http://www.pecos.com.tw/tmp/image/20140409/20140409202153_39623.jpg" class="img-fluid rounded d-block" style="max-height: 3rem; width: auto;"></td>
            <td class="align-middle">純喫茶綠茶 </td>
            <td class="align-middle">$ 199</td>
            <td class="align-middle">99</td>
            </tr>
            <?php
            for ($i=0; $i < 5; $i++) {
              <tr>
              <th class="align-middle" scope="row">1</th>
              <td class="text-center"><img src="http://www.pecos.com.tw/tmp/image/20140409/20140409202153_39623.jpg" class="img-fluid rounded d-block" style="max-height: 3rem; width: auto;"></td>
              <td class="align-middle">純喫茶綠茶 </td>
              <td class="align-middle">$ 199</td>
              <td class="align-middle">99</td>
              </tr>;
            }
            ?>
            </tbody>
            </table>
            </div>';

            PrintOrder($orderNumber,$orderProgressBar,$orderInformation,$orderDetail,$orderCost);

          }

          break;
          case 'processed':
          //查詢未完成的訂單
          $sql = "SELECT * FROM ORDER_LIST";
          $result = $conn->query($sql);
          
          while($rowProcessed = mysqli_fetch_array($result)){

          }



          break;
          case 'completed':
             //查詢已完成的訂單
          $sql = "SELECT COUNT(*) Count 
          FROM ORDER_LIST
          WHERE State ='completed'";
          $result = $conn->query($sql);
          while($rowCompleted = mysqli_fetch_array($result)){

          }


          break;
          default:
              # code...
          break;
        }
      }

      ?>

      <div class="col-9">
        <div class="card mb-3">
          <h5 class="card-header">
            <strong>2017/12/12</strong>
            訂單編號 : ABCDEFGH
          </h5>
          <div class="card-body">
            <div class="row">
              <div class="col-12 mb-3">
                <div class="progress" style="height: 2rem;">
                  <div class="progress-bar bg-primary text-light " style="width: 25%; ">已提交</div>
                  <div class="progress-bar bg-secondary text-light " style="width: 25%; ">處理中</div>
                  <div class="progress-bar bg-secondary text-light " style="width: 25%; ">運輸中</div>
                  <div class="progress-bar bg-secondary text-light " style="width: 25%; ">已完成</div>
                </div>
              </div>

              <div class="col-4"><strong>收件人:</strong> 黃省喬</div>
              <div class="col-6"><strong>收件人電話:</strong> 099999999</div>
              <div class="col-6"><strong>收件地址:</strong> 台北市台北市台北市台北市台北市</div>

              <div class="col-12">
                <table class="table table-hover table-sm mt-3">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col" style="width:2rem;">#</th>
                      <th scope="col" style="width:4rem;"></th>
                      <th scope="col">商品名稱</th>
                      <th scope="col">單價</th>
                      <th scope="col">數量</th>
                    </tr>

                  </thead>
                  <tbody>
                    <tr>
                      <th class="align-middle" scope="row">1</th>
                      <td class="text-center"><img src="http://www.pecos.com.tw/tmp/image/20140409/20140409202153_39623.jpg" class="img-fluid rounded d-block" style="max-height: 3rem; width: auto;"></td>
                      <td class="align-middle">純喫茶綠茶 </td>
                      <td class="align-middle">$ 199</td>
                      <td class="align-middle">99</td>
                    </tr>
                    <?php
                    for ($i=0; $i < 5; $i++) {
                      echo '                        <tr>
                      <th class="align-middle" scope="row">1</th>
                      <td class="text-center"><img src="http://www.pecos.com.tw/tmp/image/20140409/20140409202153_39623.jpg" class="img-fluid rounded d-block" style="max-height: 3rem; width: auto;"></td>
                      <td class="align-middle">純喫茶綠茶 </td>
                      <td class="align-middle">$ 199</td>
                      <td class="align-middle">99</td>
                      </tr>';
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <div class="col-12 text-right">
                總金額:  <h3 class="d-inline-block"><strong class="text-danger">NT$ 9990</strong></h3>
              </div>
            </div>
          </div>
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
