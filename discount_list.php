<?php session_start(); ?>
<?php include('connection.php'); ?>
<?php $page_name = '管理折扣' ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php include('style.php') ?>
  <title><?php echo  $page_name. ' - ' .title_name ?></title>
</head>

<body>
  <!-- 引入導覽列 -->
  <?php include('nav.php') ?>
  
  <div class="container my-3">
    <div class="row">
      <div class="col-12 text-center">
        <h2 class="d-inline" style="border-bottom:5px #333 solid;">管理折扣</h2>
        <table class="table table-hover table-dark my-3">
          <thead>
            <tr>
              <th scope="col" style="width:2rem;">#</th>
              <th scope="col" style="width:5rem;" >類型</th>
              <th scope="col" style="width:7rem;">開始</th>
              <th scope="col" style="width:7rem;">結束</th>
              <th scope="col" style="width:6rem;">折扣需求</th>
              <th scope="col" style="width:5rem;">折扣率</th>
              <th scope="col" style="width:9rem;">資訊</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $sql = 'SELECT * FROM DISCOUNT';
            $result = $conn->query($sql);
            while($rows = mysqli_fetch_array($result))
            {
              echo '<tr style="cursor: pointer;" onclick="location.href=\'product_detail.php?ID=' . $rows['ID'].'\'">';
              echo '<th scope="row">'.$rows['ID'].'</th>';
              $EventType = ($rows['EventType']!=NULL)?'-'.$rows['EventType']:'';
              echo '<td>'.$rows['Type'].$EventType.'</td>';
              echo '<td><small>'.$rows['PeriodFrom'].'</small></td>';
              echo '<td><small>'.$rows['PeriodTo'].'</small></td>';
              echo '<td>'.$rows['Requirement'].'</td>';
              echo '<td>'.$rows['Rate'].'</td>';
              echo '<td>'.$rows['Info'].'</td>';
              echo '</tr>';
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  
  <?php include('footer.php') ?>
</body>
<!-- 引入JS -->
<?php include('js.php') ?>

</html>
