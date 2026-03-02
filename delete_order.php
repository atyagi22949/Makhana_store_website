<?php
include'includes/db_connect.php';
session_start();

// Security: Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $order_id = intval($_GET['id']);

    // Order delete karne ki query
    $sql = "DELETE FROM orders WHERE id = $order_id";

    if ($conn->query($sql)) {
        // Delete hone ke baad wapas admin.php par bhej do
        header("Location: admin.php?msg=Order Deleted");
    } else {
        echo "Error deleting order: " . $conn->error;
    }
}
?>