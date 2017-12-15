<?php session_start(); ?>
<?php include('connection.php'); ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php include('style.php') ?>
  <title><?php echo  $page_name. ' - ' .title_name ?></title>
  <meta http-equiv="refresh" content="<?php echo 0 ?>;URL=reg.php">
</head>

<body>
  <?php include('nav.php'); ?>
  <div class="container my-3">

    <div class="row">
      <div class="col-12 text-center">
        <?php
        //設定地點為台北時區
        date_default_timezone_set('Asia/Taipei');

        $ID=$_POST['ID'];
        $Password=md5($_POST['Password']);
        $Name=$_POST['Name'];
        $Email=$_POST['Email'];
        $Phone=$_POST['Phone'];
        $Regdate=date("Y/m/d");//取得年份/月/日 時:分:秒
        $Birth=$_POST['Birth'];
        $Gender=$_POST['Gender'];
        $Address=$_POST['Address'];
        $Position='C';//只能註冊顧客喔～
        $sql= "INSERT INTO MEMBER(ID,Password,Email,Name,Phone,Regdate,Birth,Gender,Address,Position)
        VALUE('$ID','$Password','$Email','$Name','$Phone','$Regdate','$Birth','$Gender','$Address','$Position')";
        // 將使用者輸入的username 和資料庫中的比對，檢查是否重複
        $sql_check= "SELECT * FROM MEMBER WHERE ID='" . $_POST['ID']."'";
        $rows= $conn->query($sql_check);
        if(mysqli_num_rows($rows)>=1){ // 若欲查詢的在資料庫中已存在(結果筆數>=1)
          $_SESSION['AlertMsg'] =
          array('danger','<i class="material-icons">block</i> 帳號<strong> '. $_POST['ID'] .'</strong> 名稱已被使用!',false);
        } else{
          if ($conn->query($sql) === true) {
            $_SESSION['ID'] = $_POST['ID'];
            // $_SESSION['AlertMsg'] =
            // array('success','<i class="material-icons">done</i> 成功註冊！',false);
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

  </div>
  <?php include('footer.php') ?>
</body>
<?php include('js.php') ?>
</html>
