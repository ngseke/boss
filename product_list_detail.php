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
  <?php  include ('connection.php');
    // for product
    $sql = "SELECT * FROM product WHERE ID = " . $_GET['ID'];
    $result = $conn -> query($sql);
    $row = mysqli_fetch_array($result);
    $name = $row['Name'];
    $stockNum = $row['Stock'];
    $price = $row['Price'];
    $description = $row['Info'];
    $Img = $row['Img'];
    $DID = $row['DID'];
    $CategoryID = $row['CategoryID'];

    // for discount
    $sql2 = "SELECT * FROM discount WHERE Type = 'event'";
    $result2 = $conn -> query($sql2);

    // for CATEGORY
    $sql3 = "SELECT * FROM category";
    $result3 = $conn -> query($sql3);

  ?>

  <div class="col-6 offset-3 mt-5">
    <div class="card">
      <div class="card-header text-center">修改商品</div>
      <div class="card-body">
        <form class="row" action="product_list_detail_edit.php" method="post" enctype="multipart/form-data" >
          <div class="col-12 form-group">
            <label for="">名稱 <span class="text-info">*</span></label>
            <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" >
          </div>
          <div class="col-12 form-group">
            <label for="">庫存狀態 <span class="text-info">*</span></label>
            <select class="form-control" name="stock" >
              <option value="in_stock">in_stock</option>
              <option value="out_of_stock">out_of_stock</option>
              <option value="removed_from_shelves">removed_from_shelves</option>
            </select>
          </div>
          <div class="col-12 col-lg-6 form-group">
            <label for="">庫存數量 <span class="text-info">*</span></label>
            <input type="number" name="stockNum" class="form-control" value = "<?php echo $stockNum; ?>" >
          </div>
          <div class="col-12 col-lg-6 form-group">
            <label for="">價錢 <span class="text-info">*</span></label></label>
            <input type="number" name="price" class="form-control" value = "<?php echo $price?>" >
          </div>
          <div class="col-12 col-lg-6 form-group">
            <label for="">折扣狀態 <span class="text-info">*</span></label>
            <select class="form-control" name="discount" >
              <?php
              if($result2->num_rows > 0) {
                while($row2 = $result2->fetch_assoc()){
                  echo "<option value = " . $row2["ID"] . ">" . $row2["Info"] . "</option>";
                }
              }
               ?>
            </select>
          </div>
          <div class="col-12 col-lg-6 form-group">
            <label for="">商品分類 <span class="text-info">*</span></label>
            <select class="form-control" name="category" required>
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
            <label for="exampleFormControlFile1">上傳圖片</label>
            <input type="file" class="form-control-file" name="file" >
          </div>
          <div class="col-12 form-group">
            <label for="">商品描述 <span class="text-info">*</span></label>
            <textarea class="form-control" name="description" rows="3" ><?php echo $description ?></textarea>
            </select>
          </div>
          <div class="col-12 form-group">
            <input type="hidden" name="IDnum" value="<?php echo $_GET['ID'] ?>">
            <button class="btn btn-success btn-block" type="submit" >立即新增</button>
          </div>
        </form>

      </div>
    </div>
  </div>
</body>
