<?php
session_start();
include_once('../../includes/db.php'); // زیادکردنی فایلەکەی داتابەیس

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $logout_time = date('Y-m-d H:i:s');
    $log_query = "INSERT INTO user_activity_log (user_id, action, ip_address, logout_time, created_at) 
                  VALUES ($user_id, 'logout', '$ip_address', '$logout_time', '$logout_time')";
    mysqli_query($conn, $log_query);
}

session_destroy();
setcookie('username', '', time() - 3600, "/");
setcookie('password', '', time() - 3600, "/");
header("Location: ../../index.php");
exit();
?>
