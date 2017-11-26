<?php session_start(); ?>
<?php include('connection.php'); ?>
<!DOCTYPE html>
<html>

<head>
 <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- 引入CSS等樣式內容 -->
  <?php include('style.php') ?>
  <title><?php echo title_name ?> </title>
</head>

<body>
  <?php include('nav.php'); ?>
  <div class="container mt-3">
    <form method="post">
      <div class="row">
        <div class="col-12 text-center">
          <?php
          //设定要用的默认时区。自 PHP 5.1 可用
			date_default_timezone_set('UTC');

          $ID=$_POST['ID'];
          $Password=md5($_POST['Password']);
          $Email=$_POST['Email'];
          $Phone=$_POST['Phone'];
          $Regdate=;//QQ
          $Birth=$_POST['Birth'];
          $Gender=$_POST['Gender'];//QQ
          $Address=$_POST['Address'];
          $Position=//QQ
          $sql= "INSERT INTO MEMBER(ID,Password,Email,Phone,Regdate,Birth,Gender,Address,Position)
                 VALUE('$ID','$Password','$Email','$Phone','$Regdate','$Birth','$Gender','$Address','$Position')";
          // 將使用者輸入的username 和資料庫中的比對，檢查是否重複
          $sql_check= "SELECT * FROM MEMBER WHERE ID='" . $_POST['ID']."'";
          $rows= $conn->query($sql_check);
          if(mysqli_num_rows($rows)>=1){ // 若欲查詢的在資料庫中已存在(結果筆數>=1)
            echo '<div class="alert alert-danger">';
            echo "帳號<strong>". $_POST['username'] ."</strong>名稱已被使用" . $conn->error;
            echo '</div>';
          } else{
            if ($conn->query($sql) === true) {
              $_SESSION['username']=$_POST['username'];
              echo '<div class="alert alert-success">成功註冊!';
            } else {
              echo '<div class="alert alert-danger">';
              echo "Error 註冊: " . $conn->error;
              echo '</div>';
            }
          }
          $conn->close();
          ?>
        </div>
      </div>
    </form>
  </div>
<?php include('footer.php') ?>
</body>
<!-- 引入JS -->
<?php include('js.php') ?>
</html>