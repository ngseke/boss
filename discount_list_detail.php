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
  <?php require_once ('js.php') ?>
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
                <select class="form-control" value = "<?php echo $Type ;?>" name="Type" required>
                  <?php
                    // 如果直接對select標籤預設value是不管用der
                    // 所以改以PHP生成下拉式選單的選項，為了個別設置原來選項的selected
                    $discountList= array('shipping','seasoning','event');
                    $discountTextList= array('運費 (shipping)','季節 (seasoning)','活動 (event)');
                    foreach ($discountList as $key => $ppap) {
                      $isThisSelected = ($Type==$ppap)?'selected ':'';
                      echo '<option value="'.$ppap.'" '. $isThisSelected .' >'.$discountTextList[$key].'</option>';
                    }
                  ?>
                </select>
              </div>
              <div class="col-12">
                <p class="text-muted" id="TypeDescribe">折扣說明</p>
              </div>
              <div class="col-12 form-group">
                <label for="">資訊 <span class="text-info">*</span></label>
                <textarea type="text" name="Info" maxlength="100" class="form-control" rows="2" required><?php echo $Info;?></textarea>
              </div>
              <div class="col-12 col-lg-6 form-group">
                <label for="">開始日期 <span class="text-info">*</span></label>
                <input type="date" value="<?php echo $PeriodFrom; ?>" name="PeriodFrom" class="form-control" placeholder="年/月/日">
              </div>
              <div class="col-12 col-lg-6 form-group">
                <label for="">結束日期 <span class="text-info">*</span></label>
                <input type="date" value="<?php echo $PeriodTo;?>" name="PeriodTo" class="form-control" placeholder="年/月/日">
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
                <select class="form-control" name="EventType" required>
                  <?php
                    // 如果直接對select標籤預設value是不管用der
                    // 所以改以PHP生成下拉式選單的選項，為了個別設置原來選項的selected
                    $eventTypeList= array('BOGO','discount');
                    $eventTypeTextList= array('買一送一 (BOGO)','打折 (discount)');
                    foreach ($eventTypeList as $key => $ppap) {
                      $isThisSelected = ($EventType==$ppap)?'selected ':'';
                      echo '<option value="'.$ppap.'" '. $isThisSelected .' >'.$eventTypeTextList[$key].'</option>';
                    }
                  ?>
                </select>
              </div>
              <div class="col-12 form-group">
                <button class="btn btn-success btn-block" type="submit" >立即修改</button>
              </div>
              <div class="col-12 form-group">
                <a class="btn btn-danger btn-block" href="discount_list_detail_delete.php?ID=<?php echo $_GET['ID'] ?>" >直接刪除</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include('footer.php') ?>
</body>
</html>
