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
        <h2 class="d-inline-block my-3" style="border-bottom:5px #333 solid;">管理折扣</h2>
        <table class="table table-hover table-dark my-3 ">
          <thead>
            <tr>
              <th scope="col" style="width:2rem;">#</th>
              <th scope="col" style="width:5rem;" >類型</th>
              <th scope="col" style="width:12rem;">開始/結束</th>
              <th scope="col" style="width:6rem;">折扣需求</th>
              <th scope="col" style="width:5rem;">折扣內容</th>
              <th scope="col" style="width:9rem;">資訊</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $sql = 'SELECT * FROM DISCOUNT';
            $result = $conn->query($sql);
            while($rows = mysqli_fetch_array($result))
            {
              echo '<tr style="cursor: pointer;" onclick="location.href=\'discount_list_detail.php?ID=' . $rows['ID'].'\'">';
              echo '<th scope="row" class="align-middle">'.$rows['ID'].'</th>';
              $Type = ($rows['EventType']=='event')?'-'.$rows['EventType']:'';

              echo '<td class="align-middle">'.$rows['Type'].$Type.'</td>';
              echo '<td class="align-middle"><small><span class="badge badge-pill badge-warning mr-1">起</span>'.$rows['PeriodFrom'].'<br><span class="badge badge-pill badge-warning mr-1">迄</span>'.$rows['PeriodTo'].'</small></td>';
              echo '<td class="align-middle">NT$ '.$rows['Requirement'].'</td>';
              if($rows['Type']=='shipping'){
                $RateText='免運';
              }else if($rows['EventType']=='BOGO'){
                $RateText='買一送一';
              }else{
                $RateText=($rows['Rate']*100).'%';
              }
              echo '<td class="align-middle">'. $RateText.'</td>';
              echo '<td class="align-middle">'.$rows['Info'].'</td>';
              echo '</tr>';
            }
            ?>
          </tbody>
        </table>
      </div>

      <div class="col-6 offset-3 mt-5">   
        <div class="card">
          <div class="card-header text-center">新增折扣</div>
          <div class="card-body">
            <form class="row" action="discount_list_new_add.php" method="post" enctype="multipart/form-data" >
              <div class="col-12 form-group">
                <label for="">類型 <span class="text-info">*</span></label>
                <select class="form-control" name="Type" required>
                  <option value="shipping">shipping</option>
                  <option value="seasoning">seasoning</option>
                  <option value="event">event</option>
                </select>
              </div>
              <div class="col-12 col-lg-6 form-group">
                <label for="">開始日期 <span class="text-info">*</span></label>
                <input type="date" value="1911-10-10" name="PeriodFrom" class="form-control" >
              </div>
              <div class="col-12 col-lg-6 form-group">
                <label for="">結束日期 <span class="text-info">*</span></label>
                <input type="date" value="1911-10-10" name="PeriodTo" class="form-control" >
              </div>
              <div class="col-12 col-lg-6 form-group">
                <label for="">折扣條件 <span class="text-info">*</span></label>
                <div class="input-group">
                  <span class="input-group-addon">$</span>
                  <input type="number" value="100" name="Requirement" min="1" class="form-control" >
                </div>
              </div>
              <div class="col-12 col-lg-6 form-group">
                <label for="">折扣率</label>
                <input type="number" value="0.01" name="Rate" step="0.01" min="0.01" max="0.99" class="form-control" >
              </div>
              <div class="col-12 form-group">
                <label for="">資訊 <span class="text-info">*</span></label>
                <textarea type="text" value="admin" name="Info" placeholder="" maxlength="100" class="form-control" rows="2" required></textarea>
              </div>
              <div class="col-12 form-group">
                <label for="">Event類型</label>
                <select class="form-control" name="EventType" required>
                  <option value="BOGO">BOGO</option>
                  <option value="discount">discount</option>
                </select>
              </div>
              <div class="col-12 form-group">
                <button class="btn btn-success btn-block" type="submit" >立即註冊</button>
              </div>
            </form>
          </div>
        </div>




      </div>
    </div>
  </div>
  
  <?php include('footer.php') ?>
</body>
<!-- 引入JS -->
<?php include('js.php') ?>

</html>
