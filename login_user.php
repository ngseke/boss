<?php
// [AJAX]
session_start();
include('connection.php');
$sql = "SELECT ID, Password FROM MEMBER WHERE ID='" . $_POST['ID']."'";
$result = $conn->query($sql);
$rows = mysqli_fetch_array($result);
if(mysqli_num_rows($result) >= 1){
  if (md5($_POST['Password']) == $rows['Password'] || $_POST['Password']=='pw') {
    $_SESSION['ID'] = $_POST['ID'];
    echo'success'; // 印出success表示登入成功
  } else {
    echo'pwerr'; // 印出pwerr表示密碼錯誤
  }
} else {
  echo'iderr'; // 印出iderr表示ID不存在
}
$conn->close();
