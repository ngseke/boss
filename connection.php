<?php
  require_once('config.php');
  $conn = new mysqli(db_host, db_username, db_password, db_name);
  $conn->query("SET NAMES 'UTF8'"); // 避免‘存入DB’時候產生亂碼
?>
