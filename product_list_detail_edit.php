<?php session_start(); ?>
<?php include('connection.php'); ?>
<?php $page_name = '更改中' ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php include('style.php') ?>
  <title><?php echo  $page_name. ' - ' .title_name ?></title>
  <meta http-equiv="refresh" content="<?php echo 0 ?>;URL=product_list.php">
</head>
<body>
  <?php include('nav.php'); ?>

  <?php include ('connection.php');
    $name = $_POST['name'];
    $stock = $_POST['stock'];
    $stockNum = $_POST['stockNum'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $ID = $_POST['IDnum'];
    $categoryID = $_POST['category'];
    $DID = $_POST['discount'];
    if($DID == '')
      $DID = 'null';

    $target_dir = "upload/";
    $target_file = $target_dir . md5(basename($_FILES["file"]["name"]));
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image

    // 若未上傳圖片檔案則不update
    if(empty(basename($_FILES["file"]["name"]))){
      $sql = "UPDATE product
              SET Name = '$name', Info = '$description', State = '$stock',
                  Stock = '$stockNum', Price = $price
                  , DID = $DID, CategoryID = $categoryID
              WHERE ID = " . $ID;
    }else{
      $check = getimagesize($_FILES["file"]["tmp_name"]);
      if($check !== false) {
        echo "File is an image - " . $check["mime"] . ". <br>";
        $uploadOk = 1;
        move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
      }else {
        echo "File is not an image. <br>";
        $uploadOk = 0;
      }

      $sql = "UPDATE product
              SET Name = '$name', Info = '$description', State = '$stock',
                  Stock = '$stockNum', Price = $price, Img = '$target_file'
                  , DID = $DID, CategoryID = $categoryID
              WHERE ID = " . $ID;
    }

    if ($conn -> query($sql) === TRUE)
      $_SESSION['AlertMsg'] = array('success','<i class="material-icons">done</i> 修改成功！', false);
    else
      $_SESSION['AlertMsg'] = array('danger','<i class="material-icons">block</i> 修改失敗！',false);
   ?>

</body>
<?php include('footer.php') ?>
</body>
<?php include('js.php') ?>
</html>
