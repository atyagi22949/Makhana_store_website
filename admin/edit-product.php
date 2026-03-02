<?php
include '../includes/db_connect.php';
session_start();

// Security Check
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
$res = $conn->query("SELECT * FROM flavors WHERE id=$id");
$product = $res->fetch_assoc();

if (isset($_POST['update_product'])) {
    $name = $_POST['name'];
    $tagline = $_POST['tagline'];
    $price = $_POST['price'];
    $bg_color = $_POST['bg_color'];

    // Agar nayi image upload hui hai
    if (!empty($_FILES["image_file"]["name"])) {
        $file_name = basename($_FILES["image_file"]["name"]);
        move_uploaded_file($_FILES["image_file"]["tmp_name"], "../images/" . $file_name);
        $sql = "UPDATE flavors SET name='$name', tagline='$tagline', price='$price', image_url='$file_name', bg_color='$bg_color' WHERE id=$id";
    } else {
        // Sirf text update karein
        $sql = "UPDATE flavors SET name='$name', tagline='$tagline', price='$price', bg_color='$bg_color' WHERE id=$id";
    }

    if ($conn->query($sql)) {
        header("Location: admin.php?msg=Updated");
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Flavor | Admin</title>
    <style>
        body {
            background: #000;
            color: #fff;
            font-family: 'Poppins';
            padding: 50px;
        }

        .edit-container {
            max-width: 500px;
            margin: auto;
            background: #111;
            padding: 30px;
            border-radius: 20px;
            border: 1px solid #FFD700;
        }

        input,
        textarea {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            background: #222;
            border: 1px solid #444;
            color: #fff;
            border-radius: 8px;
            box-sizing: border-box;
        }

        .update-btn {
            width: 100%;
            padding: 15px;
            background: #FFD700;
            border: none;
            font-weight: bold;
            border-radius: 50px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="edit-container">
        <h2 style="color: #FFD700;">Edit <span>Flavor</span></h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="name" value="<?php echo $product['name']; ?>" required>
            <textarea name="tagline" rows="2"><?php echo $product['tagline']; ?></textarea>
            <input type="number" name="price" value="<?php echo $product['price']; ?>" required>
            <input type="text" name="bg_color" value="<?php echo $product['bg_color']; ?>">

            <p style="font-size: 0.8rem; color: #888;">Current Image: <?php echo $product['image_url']; ?></p>
            <input type="file" name="image_file">

            <button type="submit" name="update_product" class="update-btn">UPDATE PRODUCT</button>
            <br><br>
            <a href="../admin/admin.php" style="color: #888; text-decoration: none; font-size: 0.9rem;">← Back to Dashboard</a>
        </form>
    </div>
</body>

</html>