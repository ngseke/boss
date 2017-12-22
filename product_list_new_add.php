<?php session_start(); ?>
<?php include('connection.php'); ?>
<?php $page_name = '新增中' ?>

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
  <?php
      include ('connection.php');
      $name = $_POST['Name'];
      $state = $_POST['State'];
      $stock = $_POST['Stock'];
      $price = $_POST['Price'];
      $info = $_POST['Info'];
      $event = $_POST['Event'];
      if($event == '')
        $event = 'null';
      $type = $_POST['Type'];
      $target_dir = "upload/";
      $target_file = $target_dir . password_hash(basename($_FILES["file"]["name"]),PASSWORD_BCRYPT);
      $uploadOk = 1;
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
      // Check if image file is a actual image or fake image
      if(!empty(basename($_FILES["file"]["name"]))) {
        $check = getimagesize($_FILES["file"]["tmp_name"]);
        if($check !== false) {
            // echo "File is an image - " . $check["mime"] . ". <br>";
            $uploadOk = 1;
            move_uploaded_file($_FILES["file"]["tmp_name"],$target_file);
            // echo $_FILES["file"]["tmp_name"]."<br>";
        }else{
          $_SESSION['AlertMsg'] = array('danger','<i class="material-icons">block</i> 檔案不為圖片！',false);
        }
      }else{
        $_SESSION['AlertMsg'] = array('danger','<i class="material-icons">block</i> 檔案不存在！',false);
      }

      $sql = "INSERT INTO product
              VALUE(null, '$name', '$state', $stock, $price, '$target_file', '$info', $event, $type)";
      if ($conn -> query($sql) === TRUE)
        $_SESSION['AlertMsg'] = array('success','<i class="material-icons">done</i> 新增成功！', false);
      else
        $_SESSION['AlertMsg'] = array('danger','<i class="material-icons">block</i> 新增失敗！',false);

   ?>
</body>
<?php include('footer.php') ?>
<?php include('js.php') ?>
</html>
