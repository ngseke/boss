<?php
session_start();
include('connection.php');
// 清空登入的Session
unset($_SESSION['ID']);
