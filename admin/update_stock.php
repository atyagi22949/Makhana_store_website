<?php
include '../includes/db_connect.php';

if (isset($_POST['flavor_id']) && isset($_POST['new_stock'])) {
    $id = intval($_POST['flavor_id']);
    $stk = intval($_POST['new_stock']);

    // Ab 'stock' column database mein exist karta hai, toh error nahi aayega
    $sql = "UPDATE flavors SET stock = $stk WHERE id = $id";

    if ($conn->query($sql)) {
        header("Location: admin.php?msg=Stock Updated");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>