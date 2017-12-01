<?php session_start(); ?>
<?php include('connection.php'); ?>
<?php $page_name = '修改折扣' ?>
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
        <h2 class="d-inline-block my-3" style="border-bottom:5px #333 solid;">修改折扣</h2>
      </div>

      <?php
        $sql = 'SELECT * FROM DISCOUNT
                WHERE ID =' . $_GET['ID'];
        $result = $conn->query($sql);
        $row = mysqli_fetch_array($result);
        $Type=$row['Type'];
        $PeriodFrom=$row['PeriodFrom'];
        $PeriodTo=$row['PeriodTo'];
        $Requirement=$row['Requirement'];
        $Rate=$row['Rate'];
        $Info=$row['Info'];
        $EventType=$row['EventType'];
       ?>

      <div class="col-6 offset-3 mt-3">
        <div class="card">
          <div class="card-header text-center">修改折扣</div>
          <div class="card-body">
            <form class="row" action="discount_list_detail_edit.php" method="post" enctype="multipart/form-data" >
              <div class="col-12 form-group d-none">
                <label for="">ID <span class="text-info">*</span></label>
                <input type="text" name="ID" value="<?php echo $_GET['ID']; ?>" placeholder="<?php echo $_GET['ID']; ?>" class="form-control" >
              </div>
              <div class="col-12 form-group">
                <label for="">類型 <span class="text-info">*</span></label>
                <select class="form-control" value = "<?php echo $Type ;?>" placeholder="<?php echo $Type ;?>" name="Type" required>
                  <option value="shipping">shipping</option>
                  <option value="seasoning">seasoning</option>
                  <option value="event">event</option>
                </select>
                <p class="text-muted">123</p>
              </div>

              <div class="col-12 form-group">
                <label for="">資訊 <span class="text-info">*</span></label>
                <textarea type="text" name="Info" maxlength="100" class="form-control" rows="2" required><?php echo $Info;?></textarea>
              </div>
              <div class="col-12 col-lg-6 form-group">
                <label for="">開始日期 <span class="text-info">*</span></label>
                <input type="date" value="<?php echo $PeriodFrom; ?>" name="PeriodFrom" class="form-control" >
              </div>
              <div class="col-12 col-lg-6 form-group">
                <label for="">結束日期 <span class="text-info">*</span></label>
                <input type="date" value="<?php echo $PeriodTo;?>" name="PeriodTo" class="form-control" >
              </div>
              <div class="col-12 col-lg-6 form-group">
                <label for="">折扣條件 <span class="text-info">*</span></label>
                <div class="input-group">
                  <span class="input-group-addon">$</span>
                  <input type="number" value="<?php echo $Requirement ;?>" name="Requirement" min="1" class="form-control" >
                </div>
              </div>
              <div class="col-12 col-lg-6 form-group">
                <label for="">折扣率</label>
                <input type="number" value="<?php echo $Rate ;?>" name="Rate" step="0.01" min="0.01" max="0.99" class="form-control" >
              </div>
              <div class="col-12 form-group">
                <label for="">Event類型</label>
                <select class="form-control" name="EventType" value="<?php echo $EventType;?>" required>
                  <option value="BOGO">BOGO</option>
                  <option value="discount">discount</option>
                </select>
              </div>
              <div class="col-12 form-group">
                <button class="btn btn-success btn-block" type="submit" >立即修改</button>
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
<script type="text/javascript">
  // 動態設定欄位的顯示
  function SetInputDisplay() {
    if($("select[name='Type']").val()=='shipping'){
      $("input[name='Rate']").parent().addClass('d-none');
      $("select[name='EventType']").parent().addClass('d-none');
    } else if($("select[name='Type']").val()=='seasoning'){
      $("input[name='Rate']").parent().removeClass('d-none');
      $("select[name='EventType']").parent().addClass('d-none');
    } else if($("select[name='Type']").val()=='event'){
      $("input[name='Rate']").parent().removeClass('d-none');
      $("select[name='EventType']").parent().removeClass('d-none');
      $("select[name='Rate']").addClass('d-none');
    }
  }
  $(document).ready(function(){
    SetInputDisplay();
  });
  $("select[name='Type']").change(function(){
    SetInputDisplay();
  });


</script>
</html>
