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
        <h2 class="d-inline-block my-3" style="border-bottom:5px #333 solid;">修改折扣</h2>
      </div>

      <div class="col-6 offset-3 mt-3">   
        <div class="card">
          <div class="card-header text-center">修改折扣</div>
          <div class="card-body">
            <form class="row" action="discount_list_detail_edit.php" method="post" enctype="multipart/form-data" >
              <div class="col-12 form-group d-none">
                <label for="">ID <span class="text-info">*</span></label>
                <input type="text" name="ID" value="<?php echo $_GET['ID']; ?>" placeholder="" class="form-control" >
              </div>
              <div class="col-12 form-group">
                <label for="">類型 <span class="text-info">*</span></label>
                <select class="form-control" name="Type" required>
                  <option value="shipping">shipping</option>
                  <option value="seasoning">seasoning</option>
                  <option value="event">event</option>
                </select>
              </div>
              <div class="col-12 form-group">
                <label for="">資訊 <span class="text-info">*</span></label>
                <textarea type="text" value="admin" name="Info" placeholder="" maxlength="100" class="form-control" rows="2" required></textarea>
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
                <label for="">Event類型</label>
                <select class="form-control" name="EventType" required>
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

</html>
