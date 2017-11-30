<html>
<head>
  <?php
    if($_SERVER['HTTP_HOST'] == 'localhost'){
      echo '<meta http-equiv=REFRESH CONTENT=100;url=product_list.php>';
    }
    else{
      echo '<meta http-equiv=REFRESH CONTENT=1;url=';
    }
  ?>
</head>
<body>
  <?php include ('connection.php');
    $name = $_POST['name'];
    $stock = $_POST['stock'];
    $stockNum = $_POST['stockNum'];
    $price = $_POST['price'];
    // $uploadImg = $_POST['file'];
    $description = $_POST['description'];
    $ID = $_POST['IDnum'];


    $target_dir = "upload/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if(isset($name)) {
      $check = getimagesize($_FILES["file"]["tmp_name"]);
      if($check !== false) {
          echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
          move_uploaded_file($_FILES["file"]["tmp_name"],$target_file);
          echo $_FILES["file"]["tmp_name"];
      } else {
          echo "File is not an image.";
          $uploadOk = 0;
      }
    }
    else{
      echo "upload error";
    }

    if(isset($name)){
      $sql = "UPDATE product
              SET Name = '$name'
              WHERE ID = " . $ID;

      if ($conn -> query($sql) === TRUE)
        echo "Check Name Successful <br>";
      else
        echo "Check Name fail <br>";
    }

    if(isset($stock)){
      $sql = "UPDATE product
              SET State = '$stock'
              WHERE ID = " . $ID;

      if ($conn -> query($sql) === TRUE)
        echo "Check stock Successful <br>";
      else
        echo "Check stock fail <br>";
    }

    if(isset($stockNum)){
      $sql = "UPDATE product
              SET Stock = '$name'
              WHERE ID = " . $ID;

      if ($conn -> query($sql) === TRUE)
        echo "Check stockNum Successful <br>";
      else
        echo "Check stockNum fail <br>";
    }

    if(isset($price)){
      $sql = "UPDATE product
              SET Price = $price
              WHERE ID = " . $ID;

      if ($conn -> query($sql) === TRUE)
        echo "Check price Successful <br>";
      else
        echo "Check price fail <br>";
    }

    // if(isset($uploadImg)){
    //   $sql = "UPDATE product
    //           SET Img = '$uploadImg'
    //           WHERE ID = " . $ID;
    //
    //   if ($conn -> query($sql) === TRUE)
    //     echo "Check Img Successful <br>";
    //   else
    //     echo "Check Img fail <br>";
    // }

    if(isset($description)){
      $sql = "UPDATE product
              SET Info = '$description'
              WHERE ID = " . $ID;

      if ($conn -> query($sql) === TRUE)
        echo "Check description Successful <br>";
      else
        echo "Check description fail <br>";
    }

    if(isset($ID)){
      echo "ID is exist";
    }
    else{
      echo "ID is not exist";
    }
   ?>
</body>
</html>
