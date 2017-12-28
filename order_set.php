<?php
  // 產生一組隨機的訂單ID (8位英數)
  if(isset($_SESSION['OrderID'])){
    unset($_SESSION['$OrderID']);
  }
  $OrderID = mb_strimwidth(md5(rand()*rand()),0,8);
  // DB中插入此購物車
  $sql="INSERT INTO ORDER_LIST(ID, Date, CID, DID)
        VALUES('$OrderID', CURRENT_TIMESTAMP, '".$user_id."', '3')";
  $conn->query($sql);
  $_SESSION['OrderID']=$OrderID;
