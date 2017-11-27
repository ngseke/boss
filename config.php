<?php
// 儲存MYSQL伺服器資訊, 及定義各種資訊
// define(名稱 , 值, case_insensitive)

if($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST']== '127.0.0.1'){
  // 若當前主機為localhost
  define('db_host',   'localhost', false); // 資料庫host
  define('db_username', 'root', false);    // 資料庫用戶名
  define('db_password', '', false);        // 資料庫密碼
  define('db_name',   'BOSS', false);      // 資料庫名稱
 }else{
  // 若當前主機在遠端上
  define('db_host',   'sql202.byethost24.com', false);
  define('db_username', 'b24_21029138', false);
  define('db_password', 'g122299893', false);
  define('db_name',   'b24_21029138_BOSS', false);
 }

define('auto_jump_time', 1, false); // 自動跳轉的秒數
define('title_name', 'BOSS茶店', false); // 專案名稱
define('debug_mode', true); // 是否為DEBUG MODE

?>
