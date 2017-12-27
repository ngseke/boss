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
        $sql = "SELECT COUNT(*) Count FROM ORDER_LIST WHERE CID = '$user_id'";
        $result = $conn->query($sql);
        $all = mysqli_fetch_array($result)[0];
        //查詢未完成的訂單
        $sql = "SELECT COUNT(*) Count
        FROM ORDER_LIST
        WHERE CID = '$user_id'
        AND (State ='submitted'
        OR State ='processed'
        OR State ='delivered')";
        $result = $conn->query($sql);
        $processed=mysqli_fetch_array($result)[0];
        //查詢已完成的訂單
        $sql = "SELECT COUNT(*) Count
        FROM ORDER_LIST
        WHERE CID = '$user_id' AND State ='completed'";
        $result = $conn->query($sql);
        $completed=mysqli_fetch_array($result)[0];
        ?>

        <div class="list-group">
          <a href="customer_order.php?state=all" class="list-group-item list-group-item-action <?=($state == 'all')?'active':'' ?>" >所有 <span class="badge badge-dark badge-pill"><?=$all ?></span></a>
          <a href="customer_order.php?state=processed" class="list-group-item list-group-item-action  <?=($state == 'processed')?'active':'' ?>" >未完成 <span class="badge badge-dark badge-pill"><?=$processed?></span></a>
          <a href="customer_order.php?state=completed" class="list-group-item list-group-item-action <?=($state == 'completed')?'active':'' ?>" >完成 <span class="badge badge-dark badge-pill"><?=$completed ?></span></a>
        </div>
      </div>
      <!-- 右側訂單列表 -->
      <div class="col-9">
        <?php
        // 基本Query指令
        $sql = "SELECT * FROM ORDER_LIST
                WHERE CID = '$user_id'";

        // 根據訂單狀態Query
        if(isset($_GET['state'])){
          switch ($_GET['state']) {
            case 'all': //查詢全部的訂單
              break;

            case 'processed': //查詢未完成的訂單
              $sql = $sql. "AND (State ='submitted'
                            OR State ='delivered'
                            OR State ='processed') ";
              break;
            case 'completed': //查詢已完成的訂單
              $sql = $sql. "AND (State ='completed') ";
              break;
          }
          $sql .= " ORDER BY Date ASC"; // 按照日期排序
          $result = $conn->query($sql);

          // 顯示訂單狀態樣式
          while($rowsAll = mysqli_fetch_array($result)){
            // 預設全部皆bg-secondary
            $isSubmitted=$isProcessed=$isDelivered=$isCompleted='bg-secondary';
            $porgressBarDefault = 'bg-primary';
            $porgressBarInProcess = ' progress-bar-striped progress-bar-animated'; // 條紋動畫
            switch ($rowsAll['State']) {

              case 'submitted':
                // Submitted為bg-primary
                $isSubmitted= $porgressBarDefault;
                $isSubmitted.=$porgressBarInProcess;
                break;

              case 'processed':
                $isSubmitted=$isProcessed= $porgressBarDefault;
                $isProcessed.=$porgressBarInProcess;
                break;

              case 'delivered':
                $isSubmitted=$isProcessed=$isDelivered= $porgressBarDefault;
                $isDelivered.=$porgressBarInProcess;
                break;

              case 'completed':
                // 全部皆bg-success
                $isSubmitted=$isProcessed=$isDelivered=$isCompleted='bg-success ';
                break;
              default: break;
            }

            $cardStart='<div class="col-12"><div class="card mb-3">';
            $orderNumber='<h5 class="card-header">
                            <strong>'.$rowsAll['Date'].'</strong> 訂單編號 : '.$rowsAll['ID'].'
                          </h5>';

            $orderProgressBar ='<div class="card-body"><div class="row"><div class="col-12 mb-3">
            <div class="progress" style="height: 2rem;">
            <div class="progress-bar '.$isSubmitted.' text-light " style="width: 25%; ">已提交</div>
            <div class="progress-bar '.$isProcessed.' text-light " style="width: 25%; ">處理中</div>
            <div class="progress-bar '.$isDelivered.' text-light " style="width: 25%; ">運輸中</div>
            <div class="progress-bar '.$isCompleted.' text-light " style="width: 25%; ">已完成</div>
            </div></div>';

            $orderInformation ='<div class="col-4"><strong>收件人: </strong>'.$user_name.'</div>
            <div class="col-6"><strong>收件人電話:</strong> '.$user_phone.'</div>
            <div class="col-6"><strong>收件地址:</strong> '.$user_address.'</div>';

            $OID=$rowsAll['ID'];
            
            $sql_0 = "SELECT Name,Price,OLR.Quantity,Img From PRODUCT P, ORDER_LIST_RECORD OLR
                    WHERE OLR.OID = '$OID'
                    AND OLR.PID = P.ID";
            $result_0 = $conn->query($sql_0);
            $str='';
            $i=1;
            while ($rows_0= mysqli_fetch_array($result_0)){
                $str .='<tr>
                <th class="align-middle" scope="row">'.($i++).'</th>
                <td class="text-center"><img src="'.$rows_0['Img'].'" class="img-fluid rounded d-block" style="max-height: 3rem; width: auto;"></td>
                <td class="align-middle">'.$rows_0['Name'].' </td>
                <td class="align-middle">$ '.$rows_0['Price'].'</td>
                <td class="align-middle">'.$rows_0['Quantity'].'</td>
              </tr>';

            }

            $orderDetail = ' <div class="col-9">
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
            '.$str.'
            </tbody>
            </table>
            </div>';

            $orderCost = '<div class="col-3 text-right position-relative" >
            <div class="position-absolute  " style="bottom:0rem; right:2rem;">
            總金額:  <h3 class="d-inline-block"><strong class="text-danger">NT$ '.$rowsAll['FinalCost'].'</strong></h3>
            </div></div></div></div>';

            $cardEnd="</div></div>";

            echo  $cardStart.$orderNumber.$orderProgressBar.$orderInformation.$orderDetail.$orderCost.$cardEnd;

            // RESET (好像其實也用不到)
            // $orderNumber = $orderProgressBar = $orderInformation = $orderDetail = $orderCost ='';
            // $isSubmitted = $isProcessed = $isDelivered = $isCompleted = '';
          }
        }
        ?>

      </div>
    </div>
  </div>
  <?php include('jumbotron/page2.php') ?>
  <?php include('footer.php') ?>
</body>
<!-- 引入JS -->
<?php include('js.php') ?>

</html>
