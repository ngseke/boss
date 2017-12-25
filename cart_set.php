<?php
//
// 初始化購物車
//

// 如果瀏覽器還未擁有一台車
if(!isset($_SESSION['CartID'])){
  // 產生一組隨機的購物車ID (8位英數)
  $CartID=mb_strimwidth(md5(rand()*rand()),0,8);
  // DB中插入此購物車
  $sql="INSERT INTO CART(ID,Date) VALUES('$CartID',CURRENT_TIMESTAMP)";
  $conn->query($sql);
  // 設定瀏覽器的購物車編號
  $_SESSION['CartID']=$CartID;
}

// 如果瀏覽器已擁有一台車
if(isset($_SESSION['CartID'])){
  $CartID = $_SESSION['CartID'];
  $sql="SELECT * FROM CART WHERE ID='$CartID'";
  // 為了避免瀏覽器有註冊購物車 但DB卻沒有
  if(mysqli_num_rows($conn->query($sql))==0){
    $sql="INSERT INTO CART(ID,Date) VALUES('$CartID',CURRENT_TIMESTAMP)";
    $conn->query($sql);
  }
}
