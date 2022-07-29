<?php
// 儲存MYSQL伺服器資訊, 及定義各種資訊
// define(名稱 , 值, case_insensitive)

define('db_host', 'mysql', false); // 資料庫host
define('db_username', 'root', false); // 資料庫用戶名
define('db_password', '', false); // 資料庫密碼
define('db_name', 'BOSS', false); // 資料庫名稱

define('auto_jump_time', 1, false); // 自動跳轉的秒數
define('title_name', 'BOSS茶店', false); // 專案名稱
define('debug_mode', false); // 是否為DEBUG MODE

define('product_item_animation_mode', true); // 是否開啟product載入的動畫
define('product_detail_animation_mode', false); // 是否開啟product_detail載入的動畫

function EchoCode($sql){
  echo '<pre>'.$sql.'</pre>';
}
