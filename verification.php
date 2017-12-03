<?php
// 此頁用於取得'登入後'的用戶資料
// 已包含在connect.php
// 所以每個頁面都可以取用。

include('connection.php');

// INIT Guset 的資訊
$user_name= '訪客';
$user_position='G';
$user_id='guest';
$user_email= $user_phone= $user_reg_date= $user_birth=$user_gender=$user_address='';

if(isset($_SESSION['ID'])){ // 若已登入
  $user_id = $_SESSION['ID']; // 登入的用戶id
  $sql = "SELECT * FROM MEMBER WHERE ID='$user_id'";
  $rows = mysqli_fetch_array($conn->query($sql));

  $user_name = $rows['Name'];         // 用戶名稱
  $user_position = $rows['Position']; // 用戶職位
  $user_email = $rows['Email'];       // 用戶Email
  $user_phone =  $rows['Phone'];      // 用戶電話
  $user_reg_date = $rows['RegDate'];  // 註冊日期
  $user_birth = $rows['Birth'];       // 生日
  $user_gender = $rows['Gender'];     // 性別
  $user_address = $rows['Address'];   // 地址
}
