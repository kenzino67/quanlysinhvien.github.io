<?php
session_start();           // Bắt đầu session
session_unset();           // Xoá tất cả các biến session
session_destroy();         // Hủy session hoàn toàn

// Chuyển hướng về trang login
header("Location: login.php");
exit();
?>
