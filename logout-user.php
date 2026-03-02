<?php
session_start();
// Sirf user ka session destroy karein, admin ka nahi
unset($_SESSION['user_id']);
unset($_SESSION['user_name']);
header("Location: index.php");
exit;
?>