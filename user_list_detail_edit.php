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
        //設定地點為台北時區
        date_default_timezone_set('Asia/Taipei');

        $ID=$_POST['ID'];
        $Password=md5($_POST['Password']);
        $Name=$_POST['Name'];
        $Email=$_POST['Email'];
        $Phone=$_POST['Phone'];
        $Birth=$_POST['Birth'];
        $Gender=$_POST['Gender'];
        $Address=$_POST['Address'];
        $Position=$_POST['Position'];
        $sql= "UPDATE MEMBER
        SET Password='$Password',Email='$Email',Name='$Name', Phone='$Phone',Birth='$Birth',Gender='$Gender', Address='$Address',Position='$Position'
        WHERE ID='$ID'";
        $conn->query($sql);

        $_SESSION['AlertMsg'] =
          array('success','<i class="material-icons">done</i> 修改用戶成功',false);

        $conn->close();
        ?>
      </div>
    </div>

  </div>
  <?php include('footer.php') ?>
</body>
<?php include('js.php') ?>
</html>
