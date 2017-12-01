<html>
<head>
  <?php
    if($_SERVER['HTTP_HOST'] == 'localhost'){
      echo '<meta http-equiv=REFRESH CONTENT=1;url=product_list.php>';
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
    $description = $_POST['description'];
    $ID = $_POST['IDnum'];

    $target_dir = "upload/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if(isset($_POST['file'])) {
      $check = getimagesize($_FILES["file"]["tmp_name"]);
      if($check !== false) {
          echo "File is an image - " . $check["mime"] . ". <br>";
          $uploadOk = 1;
          move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
      } else {
          echo "File is not an image. <br>";
          $uploadOk = 0;
      }
    }

    if(isset($_POST['name']) && isset($_POST['stock']) && isset($_POST['stockNum']) &&
       isset($_POST['price']) && isset($_POST['description']) && isset($_POST['IDnum'])){
      $sql = "UPDATE product
              SET Name = '$name', Info = '$description', State = '$stock',
                  Stock = '$stockNum', Price = $price, Img = '$target_file'
              WHERE ID = " . $ID;

      if ($conn -> query($sql) === TRUE)
        echo "Check Successful <br>";
      else
        echo "Check fail <br>";
    }
   ?>
</body>
</html>
