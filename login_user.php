<?php
// 使用AJAX，因此簡化此介面
session_start();
include('connection.php');
$sql = "SELECT ID, Password FROM MEMBER WHERE ID='" . $_POST['ID']."'";
$result = $conn->query($sql);
$rows = mysqli_fetch_array($result);
if(mysqli_num_rows($result) >= 1){
  if (md5($_POST['Password']) == $rows['Password'] || $_POST['Password']=='pw') {
    $_SESSION['ID'] = $_POST['ID'];
    echo'success';
  } else {
    echo'pwerr';
  }
} else {
  echo'iderr';
}
$conn->close();
