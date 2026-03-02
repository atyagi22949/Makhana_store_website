<?php
include 'includes/db_connect.php';
$conn->query("UPDATE flavors SET stock = stock - 1 WHERE id = '$flavor_id'");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $address = $conn->real_escape_string($_POST['address']);
    $total = $conn->real_escape_string($_POST['total']);

    $sql = "INSERT INTO orders (customer_name, phone, address, total_amount, status) 
            VALUES ('$name', '$phone', '$address', '$total', 'Pending')";

    if ($conn->query($sql)) {
        echo "Success";
    } else {
        echo "Error: " . $conn->error;
    }
}
