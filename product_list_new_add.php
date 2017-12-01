<html>
<head>
  <?php
    if($_SERVER['HTTP_HOST'] == 'localhost'){
      echo '<meta http-equiv=REFRESH CONTENT=100;url=product_list_new.php>';
    }
    else{
      echo '<meta http-equiv=REFRESH CONTENT=1;url=';
    }
  ?>
</head>
<body>
  <?php
      include ('connection.php');
      $name = $_POST['Name'];
      $state = $_POST['State'];
      $stock = $_POST['Stock'];
      $price = $_POST['Price'];
      $info = $_POST['Info'];
      $event = $_POST['Event'];
      $type = $_POST['Type'];

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
            move_uploaded_file($_FILES["file"]["tmp_name"],$target_file);
            // echo $_FILES["file"]["tmp_name"]."<br>";
            if ($conn -> query($sql) === TRUE)
              echo "Check File Successful <br>";
            else
              echo "Check File fail <br>";

        } else {
            echo "File is not an image. <br>";
            $uploadOk = 0;
        }
      }
      else{
        echo "file is not exist";
      }

      if(isset($_POST['Name']) && isset($_POST['State']) && isset($_POST['Type'])
          && isset($_POST['Stock']) && isset($_POST['Price']) && isset($_POST['Info'])
          && isset($_POST['Event'])){

            $sql = "INSERT INTO product
                    VALUE(null, '$name', '$state', $stock, $price, '$target_file', '$info', $event, $type)";
            if ($conn -> query($sql) === TRUE){
              echo "新增成功";
            }
            else{
              echo '新增失敗';
            }
          }


   ?>
</body>
</html>
