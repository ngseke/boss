<?php session_start(); ?>
<?php include('connection.php'); ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php include('style.php') ?>
  <meta http-equiv="refresh" content="<?php echo 0 ?>;URL=user_list.php">
</head>

<body>
  <?php include('nav.php'); ?>
  <div class="container my-3">

    <div class="row">
      <div class="col-12 text-center">
        <?php
          date_default_timezone_set('Asia/Taipei');

        $ID=$_POST['ID'];
        $Password=md5($_POST['Password']);
        $Name=$_POST['Name'];
        $Email=$_POST['Email'];
        $Phone=$_POST['Phone'];
        $Regdate=date("Y/m/d");//取得年份/月/日 時:分:秒
        $Birth=$_POST['Birth'];
        $Gender=$_POST['Gender'];
        $Address=($_POST['Address']=NULL)?NULL:$_POST['Address'];
        $Position=$_POST['Position'];
        $sql= "INSERT INTO MEMBER(ID,Password,Email,Name,Phone,Regdate,Birth,Gender,Address,Position)
        VALUE('$ID','$Password','$Email','$Name','$Phone','$Regdate','$Birth','$Gender','$Address','$Position')";
        // 將使用者輸入的username 和資料庫中的比對，檢查是否重複
        $sql_check= "SELECT * FROM MEMBER WHERE ID='" . $_POST['ID']."'";
        $rows= $conn->query($sql_check);
        if(mysqli_num_rows($rows)>=1){ // 若欲查詢的在資料庫中已存在(結果筆數>=1)
          $_SESSION['AlertMsg'] =
          array('danger','<i class="material-icons">clear</i> 名稱已被使用<br>點擊返回修改',false);
        } else{
          if ($conn->query($sql) === true) {
            $_SESSION['AlertMsg'] =
            array('success','<i class="material-icons">done</i> 成功新增會員！',false);
          } else {
            $_SESSION['AlertMsg'] =
          array('danger','<i class="material-icons">clear</i>Error 註冊: '.$conn->error,false);
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
