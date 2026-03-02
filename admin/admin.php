<?php
// Ek step peeche ja kar database aur session connect karein
include '../includes/db_connect.php';
session_start();

// Security Check
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ../admin/login.php"); // Path updated to root
    exit;
}

if ($conn) {
    $stats_query = $conn->query("SELECT 
        (SELECT COUNT(*) FROM orders) as total_orders,
        (SELECT SUM(total_amount) FROM orders) as total_revenue,
        (SELECT COUNT(*) FROM orders WHERE status = 'Pending') as pending_orders,
        (SELECT COUNT(*) FROM flavors) as total_flavors
    ");
    $stats = $stats_query->fetch_assoc();
} else {
    die("Database connection failed.");
}

// --- LOGIC: Handle New Product Addition ---
if (isset($_POST['save_product'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $tagline = $conn->real_escape_string($_POST['tagline']);
    $price = intval($_POST['price']);
    $bg_color = $conn->real_escape_string($_POST['bg_color']);

    $target_dir = "../images/";
    $file_name = time() . "_" . basename($_FILES["image_file"]["name"]); // Added time() to prevent cache issues
    $target_file = $target_dir . $file_name;

    if (move_uploaded_file($_FILES["image_file"]["tmp_name"], $target_file)) {
        $conn->query("INSERT INTO flavors (name, tagline, price, image_url, bg_color) VALUES ('$name', '$tagline', '$price', '$file_name', '$bg_color')");
        header("Location: admin.php?msg=success");
    }
}

// --- LOGIC: Delete Flavor ---
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM flavors WHERE id=$id");
    header("Location: admin.php");
}

// Fetch Data for Tables
$flavors_result = $conn->query("SELECT * FROM flavors");
$recent_orders = $conn->query("SELECT * FROM orders ORDER BY order_date DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Admin Dashboard | Makhana Munch Control</title>

    <link rel="stylesheet" href="assets/style.css">
    <style>
        /* KEEPING YOUR ORIGINAL DESIGN */
        body {
            background: #111;
            color: #fff;
            padding: 20px;
            font-family: 'Poppins', sans-serif;
        }

        .admin-card {
            background: #222;
            padding: 20px;
            border-radius: 15px;
            border: 1px solid #FFD700;
            margin-bottom: 30px;
        }

        input,
        select {
            padding: 10px;
            margin: 10px 0;
            width: 100%;
            background: #333;
            color: #fff;
            border: 1px solid #444;
            border-radius: 5px;
            box-sizing: border-box;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            min-width: 600px;
        }

        th,
        td {
            padding: 15px;
            border-bottom: 1px solid #333;
            text-align: left;
        }

        th {
            color: #FFD700;
        }

        .btn-add {
            background: #FFD700;
            color: #000;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-weight: bold;
            border-radius: 5px;
        }

        .status-badge {
            background: #FFD700;
            color: #000;
            padding: 4px 10px;
            border-radius: 5px;
            font-weight: bold;
            font-size: 0.75rem;
        }

        /* ALL-DEVICE FRIENDLY: Table Scroll for Mobile */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            margin-bottom: 20px;
        }

        /* SPEED: Image optimization */
        img {
            object-fit: contain;
        }

        /* Stats Grid Fix */
        .admin-stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: #222;
            padding: 20px;
            border-radius: 15px;
            border: 1px solid #333;
            text-align: center;
        }

        .stat-value {
            color: #FFD700;
            font-size: 2rem;
            margin: 10px 0;
            font-family: 'Fredoka One';
        }
    </style>
</head>

<body>

    <div style="display:flex; justify-content:space-between; align-items:center;">
        <h1>Admin Dashboard</h1>
        <a href="logout.php" style="color: #ff4d4d; font-weight: bold; text-decoration: none;">Logout System →</a>
    </div>

    <div class="admin-stats-grid">
        <div class="stat-card">
            <span style="color: #888;">Total Orders</span>
            <div class="stat-value"><?php echo $stats['total_orders']; ?></div>
            <p style="font-size: 0.8rem;">📦 All time sales</p>
        </div>
        <div class="stat-card">
            <span style="color: #888;">Total Revenue</span>
            <div class="stat-value">₹<?php echo number_format($stats['total_revenue'], 2); ?></div>
            <p style="font-size: 0.8rem;">💰 Lifetime earnings</p>
        </div>
        <div class="stat-card">
            <span style="color: #888;">Pending Tasks</span>
            <div class="stat-value" style="color: #ff9800;"><?php echo $stats['pending_orders']; ?></div>
            <p style="font-size: 0.8rem;">⏳ Needs attention</p>
        </div>
        <div class="stat-card">
            <span style="color: #888;">Active Flavors</span>
            <div class="stat-value" style="color: #fff;"><?php echo $stats['total_flavors']; ?></div>
            <p style="font-size: 0.8rem;">🍿 Live on site</p>
        </div>
    </div>

    <div class="admin-card">
        <h2>✨ Add New Flavor</h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Flavor Name (e.g. Pudina Party)" required>
            <input type="text" name="tagline" placeholder="Tagline (e.g. Cool & Refreshing)" required>
            <input type="number" name="price" placeholder="Price (₹)" required>
            <input type="text" name="bg_color" placeholder="Background Color Hex (e.g. #2ecc71)" required>
            <label style="display:block; margin-top:10px;">Product Image (PNG):</label>
            <input type="file" name="image_file" required>
            <button type="submit" name="save_product" class="btn-add">SAVE PRODUCT</button>
        </form>
    </div>

    <div class="admin-card">
        <h2>🍿 Current Inventory</h2>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Action</th>
                        <th>Stock Control</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $flavors_result->fetch_assoc()): ?>
                        <tr>
                            <td><img src="../images/<?php echo $row['image_url']; ?>" width="50" loading="lazy"></td>
                            <td><?php echo $row['name']; ?></td>
                            <td>₹<?php echo $row['price']; ?></td>
                            <td>
                                <a href="edit-product.php?id=<?php echo $row['id']; ?>" style="color: #FFD700; text-decoration: none; margin-right: 10px;">Edit</a>
                                <a href="?delete=<?php echo $row['id']; ?>" onclick="return confirm('Delete this flavor?')" style="color: #ff4d4d; text-decoration: none;">Delete</a>
                            </td>
                            <td>
                                <form action="update_stock.php" method="POST" style="display:flex; align-items:center; gap:8px;">
                                    <input type="hidden" name="flavor_id" value="<?php echo $row['id']; ?>">
                                    <input type="number" name="new_stock" value="<?php echo isset($row['stock']) ? $row['stock'] : 0; ?>" style="width:60px; margin:0;">
                                    <button type="submit" style="background:#FFD700; border:none; padding:5px 10px; border-radius:5px; font-weight:bold; cursor:pointer;">SET</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="admin-card">
        <h2>📦 Recent Orders & Management</h2>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Contact</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($recent_orders->num_rows > 0):
                        while ($order = $recent_orders->fetch_assoc()): ?>
                            <tr>
                                <td><strong><?php echo $order['customer_name']; ?></strong><br><small><?php echo $order['address']; ?></small></td>
                                <td><?php echo $order['phone']; ?></td>
                                <td><?php echo date('d M, Y', strtotime($order['order_date'])); ?></td>
                                <td style="color: #FFD700;">₹<?php echo $order['total_amount']; ?></td>
                                <td><span class="status-badge" style="background: <?php echo ($order['status'] == 'Pending') ? '#ff9800' : '#4caf50'; ?>;"><?php echo $order['status']; ?></span></td>
                                <td>
                                    <div style="display:flex; gap:10px; flex-wrap: wrap;">
                                        <a href="update_status.php?id=<?php echo $order['id']; ?>"
                                            style="background: #FFD700; color: #000; padding: 8px 12px; border-radius: 8px; text-decoration: none; font-size: 11px; font-weight: 800; text-transform: uppercase; transition: 0.3s; display: inline-block; text-align: center;">
                                            🔄 Status
                                        </a>

                                        <a href="delete_order.php?id=<?php echo $order['id']; ?>"
                                            onclick="return confirm('Are you sure you want to delete this order?')"
                                            style="background: #ff4d4d; color: #fff; padding: 8px 12px; border-radius: 8px; text-decoration: none; font-size: 11px; font-weight: 800; text-transform: uppercase; transition: 0.3s; display: inline-block; text-align: center;">
                                            🗑️ Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile;
                    else: ?>
                        <tr>
                            <td colspan="6" style="text-align:center;">No orders yet. 🍿</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>