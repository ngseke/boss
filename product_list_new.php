<?php session_start(); ?>
<?php include('connection.php'); ?>
<?php $page_name = '新增商品' ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php include('style.php') ?>
  <title><?php echo  $page_name. ' - ' .title_name ?></title>
  <style>
    .d-block{
      display: block;
    }
    .d-none{
      display: none;;
    }
  </style>
</head>

<body>
  <?php include('nav.php');
  // for discount
  $sql = "SELECT * FROM discount WHERE Type = 'event'";
  $result = $conn->query($sql);

  // for CATEGORY
  $sql3 = "SELECT * FROM category";
  $result3 = $conn -> query($sql3);

  ?>
  <div class="container my-3">
    <div class="row">
      <div class="col-12 col-lg-6 offset-lg-3">
        <div class="card">
          <div class="card-header text-center">商品</div>
          <div class="card-body">

            <form class="row" action="product_list_new_add.php" method="post" enctype="multipart/form-data" >
              <div class="col-12 form-group">
                <label for="">商品名稱 <span class="text-info">*</span></label>
                <input type="text" name="Name" placeholder="商品名稱" maxlength="20" class="form-control" required>
              </div>
              <div class="col-12 col-lg-6 form-group">
                <label for="">商品狀態 <span class="text-info">*</span></label>
                <select class="form-control" name="State" required>
                  <option value="in_stock">in_stock</option>
                  <option value="out_of_stock">out_of_stock</option>
                </select>
              </div>
              <div class="col-12 col-lg-6 form-group">
                <label for="">商品分類 <span class="text-info">*</span></label>
                <select class="form-control" name="Type" required>
                  <?php
                  if($result3->num_rows > 0) {
                    while($row3 = $result3->fetch_assoc()){
                      echo "<option value = " . $row3["ID"] . ">" . $row3["Name"] . "</option>";
                    }
                  }
                  ?>
                </select>
              </div>
              <div class="col-12 col-lg-6 form-group">
                <label for="">庫存 <span class="text-info">*</span></label>
                <input type="number" value="99" name="Stock" placeholder="" maxlength="12" class="form-control" required>
              </div>
              <div class="col-12 col-lg-6 form-group">
                <label for="">價格 <span class="text-info">*</span></label>
                <input type="number" value="" name="Price" placeholder="" maxlength="30" class="form-control" required>
              </div>

              <div class="col-12 form-group">
                <label for="">商品介紹<span class="text-info">*</span></label>
                <textarea type="text" value="" name="Info" placeholder="" maxlength="100" class="form-control" rows="5" required></textarea>
              </div>
              <div class="col-12 col-lg-6 form-group">
                <label for="">Event折扣方式</label>
                <select class="form-control " name="Event" required>
                  <?php
                    if($result->num_rows > 0) {
                      while($row = $result->fetch_assoc()){
                        echo "<option value = " . $row["ID"] . ">" . $row["Info"] . "</option>";
                      }
                    }
                  ?>
                </select>
              </div>
              <div class="col-12 col-lg-6 form-group">
                <label for="exampleFormControlFile1">上傳圖片</label>
                <input type="file" class="form-control-file" name="file">
              </div>
              <div class="col-12 form-group mt-3">
                <button class="btn btn-success btn-block" type="submit" >確認新增</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
  <?php include('footer.php') ?>
</body>
<?php include('js.php') ?>
</html>
<!-- <script type="text/javascript">
  $(document).ready(function(){
    $("#DiscountType").change(function() {
      if($("#DiscountType option:selected").index() == 2){
        $("#EventTypeDiv").removeClass("d-none");
        $("#EventTypeDiv").addClass("d-block");
      }
      else{
        $("#EventTypeDiv").removeClass("d-block");
        $("#EventTypeDiv").addClass("d-none");
      }
    });
  });

</script> -->
