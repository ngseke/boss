<?php session_start(); ?>
<?php include('connection.php'); ?>
<?php $page_name = '訂單提交' ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php include('style.php') ?>
  <title><?php echo  $page_name. ' - ' .title_name ?></title>
  <meta http-equiv="refresh" content="<?php echo 0 ?>;URL=order_list.php">
  <?php require_once ('js.php') ?>
</head>
<body>
  <?php include('nav.php') ?>
  <?php
    $state = $_POST['state'];
    $manageName = $_POST['manageName'];
    $ID = $_POST['ID'];

    $sqlSID = "SELECT ID FROM member WHERE Name = '" . $manageName . "'";
    $resuldSID = $conn->query($sqlSID);
    $rowSID = mysqli_fetch_array($resuldSID);
    $SID = $rowSID['ID'];

    $sql = "UPDATE order_list SET State = '" . $state . "', SID = '" . $SID . "' WHERE ID = '" . $ID . "'";
    $result = $conn->query($sql);
    if($result === TRUE){
      $_SESSION['AlertMsg'] = array('success','<i class="material-icons">done</i> 修改成功！', false);
    }else{
      $_SESSION['AlertMsg'] = array('danger','<i class="material-icons">block</i> 修改失敗！',false);
    }

   ?>
  <?php include('footer.php') ?>
</body>
<html>
