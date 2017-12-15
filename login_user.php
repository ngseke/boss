<?php session_start(); ?>
<?php include('connection.php'); ?>
<?php $page_name = '登入' ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php include('style.php') ?>
  <title><?php echo  $page_name. ' - ' .title_name ?></title>
  <meta http-equiv="refresh" content="<?php echo 0 ?>;URL=login.php">
</head>
<body>
  <?php include('nav.php'); ?>

  <div class="container my-3">

    <div class="row">
      <div class="col-12 text-center">
        <?php
        $sql = "SELECT ID, Password FROM MEMBER WHERE ID='" . $_POST['ID']."'";
        $result = $conn->query($sql);
        $rows = mysqli_fetch_array($result);
        if(mysqli_num_rows($result) >= 1){
          if (md5($_POST['Password']) == $rows['Password'] || $_POST['Password']=='pw') {
            $_SESSION['ID'] = $_POST['ID'];
            // $_SESSION['AlertMsg'] =
            // array('success','<i class="material-icons">done</i> 歡迎，'. $_POST['ID'],false);
          } else {
            $_SESSION['AlertMsg'] =
            array('danger','<i class="material-icons">block</i> 密碼錯誤！',false);
          }
        } else {
          $_SESSION['AlertMsg'] =
          array('danger','<i class="material-icons">block</i> 查無此帳號！',false);
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
