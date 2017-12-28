<?php session_start();
include('connection.php');
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

if($ID==""||$Password==md5("")||$Name==""||$Email==""||$Phone==""||$Birth=="")
  die ('fail'); // 若有欄位缺填則die fail

$sql= "INSERT INTO MEMBER(ID,Password,Email,Name,Phone,Regdate,Birth,Gender,Address,Position)
        VALUE('$ID','$Password','$Email','$Name','$Phone','$Regdate','$Birth','$Gender','$Address','$Position')";

// 將使用者輸入的username 和資料庫中的比對，檢查是否重複
$sql_check= "SELECT * FROM MEMBER WHERE ID='" . $_POST['ID']."'";
$rows= $conn->query($sql_check);
if(mysqli_num_rows($rows)>=1){ // 若欲查詢的在資料庫中已存在(結果筆數>=1)
  echo'idduplicate';
} else{
  if ($conn->query($sql) === true) {
    echo'success';
    $_SESSION['ID'] = $_POST['ID'];
  } else {
    echo'regfail';
  }
}
$conn->close();
