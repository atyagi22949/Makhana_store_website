<?php
include '../includes/db_connect.php';
session_start();

// Security Check: Sirf admin hi status badal sake
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $order_id = intval($_GET['id']);

    // Pehle current status check karte hain
    $check = $conn->query("SELECT status FROM orders WHERE id = $order_id");
    $current = $check->fetch_assoc();

    // Agar Pending hai toh Delivered kar do, agar Delivered hai toh Pending (Toggle logic)
    $new_status = ($current['status'] == 'Pending') ? 'Delivered' : 'Pending';

    $update = $conn->query("UPDATE orders SET status = '$new_status' WHERE id = $order_id");

    if ($update) {
        // Wapas admin page par bhej do success message ke saath
        header("Location: admin.php?msg=Status Updated");
    } else {
        echo "Error updating status: " . $conn->error;
    }
}
?>