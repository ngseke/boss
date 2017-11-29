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
  <div class="col-6 offset-3 mt-5">
    <div class="card">
      <div class="card-header text-center">修改商品</div>
      <div class="card-body">
        <form class="row" action="product_list_detail_edit.php" method="post" >
          <div class="col-12 form-group">
            <label for="">名稱 <span class="text-info">*</span></label>
            <input type="text" class="form-control" name="name" >
          </div>
          <div class="col-12 form-group">
            <label for="">庫存狀態 <span class="text-info">*</span></label>
            <select class="form-control" name="stock">
              <option value="InStock">in_stock</option>
              <option value="OutStock">out_of_stock</option>
            </select>
          </div>
          <div class="col-12 col-lg-6 form-group">
            <label for="">庫存數量 <span class="text-info">*</span></label>
            <input type="number" name="stockNum" class="form-control" >
          </div>
          <div class="col-12 col-lg-6 form-group">
            <label for="">價錢 <span class="text-info">*</span></label></label>
            <input type="number" name="price" class="form-control" >
          </div>
          <div class="col-12 col-lg-6 form-group">
            <label for="exampleFormControlFile1">上傳圖片</label>
            <input type="file" class="form-control-file" name="uploadImg">
          </div>
          <div class="col-12 form-group">
            <label for="">商品描述 <span class="text-info">*</span></label>
            <textarea class="form-control" name="description" rows="3"></textarea>
            </select>
          </div>
          <div class="col-12 form-group">
            <button class="btn btn-success btn-block" type="submit" >立即新增</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
