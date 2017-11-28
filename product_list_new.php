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
</head>

<body>
  <?php include('nav.php'); ?>
  <div class="container my-3">
    <div class="row">
      <div class="col-12 col-lg-6 offset-lg-3">
        <div class="card">
          <div class="card-header text-center">註冊</div>
          <div class="card-body">

            <form class="row" action="product_list_new_add.php" method="post" enctype="multipart/form-data" >
              <div class="col-12 form-group">
                <label for="">商品名稱 <span class="text-info">*</span></label>
                <input type="text" name="Name" placeholder="商品名稱" maxlength="20" class="form-control" required>
              </div>
              <div class="col-12 form-group">
                <label for="">商品狀態 <span class="text-info">*</span></label>
                <input type="password" value="" name="State" placeholder="" maxlength="20" class="form-control" required>
              </div>
              <div class="col-12 form-group">
                <label for="">庫存 <span class="text-info">*</span></label>
                <input type="number" value="99" name="Stock" placeholder="" maxlength="12" class="form-control" required>
              </div>
              <div class="col-12 form-group">
                <label for="">價格 <span class="text-info">*</span></label>
                <input type="number" value="" name="Price" placeholder="" maxlength="30" class="form-control" required>
              </div>
              <div class="col-12 form-group">
                <label for="">商品介紹<span class="text-info">*</span></label>
                <input type="text" value="" name="Info" placeholder="" maxlength="100" class="form-control" required>
              </div>
              <div class="col-12 col-lg-6 form-group">
                <label for="">折扣方式</label>
                <select class="form-control" name="Gender" required>
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
<?php include('js.php') ?>
</html>
