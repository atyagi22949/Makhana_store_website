<?php
include 'includes/db_connect.php';
include 'includes/header.php';

// Agar user login nahi hai, toh login page par bhej do
if (!isset($_SESSION['user_id'])) {
    header("Location: login-user.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$user_email = $_SESSION['user_email'] ?? ''; // Agar aapne email save kiya ho login ke waqt
$user_phone = $_SESSION['user_phone'] ?? ''; // User table se phone fetch karna best hai

// User ke phone number ya email ke basis par orders fetch karein
// Note: Humne orders table mein phone column rakha tha
$orders_res = $conn->query("SELECT * FROM orders WHERE phone = (SELECT phone FROM users WHERE id = $user_id) ORDER BY order_date DESC");
?>
<link rel="stylesheet" href="assets/style.css">
<div class="orders-history-wrapper">
    <div class="container">
        <h2 class="section-title" data-aos="fade-down">MY <span>ORDER HISTORY</span> 📦</h2>

        <?php if ($orders_res->num_rows > 0): ?>
            <div class="orders-list">
                <?php while ($order = $orders_res->fetch_assoc()): ?>
                    <div class="order-strip" data-aos="fade-up">
                        <div class="order-main-info">
                            <span class="order-id">Order #<?php echo $order['id']; ?></span>
                            <span class="order-date"><?php echo date('d M, Y', strtotime($order['order_date'])); ?></span>
                        </div>

                        <div class="order-details">
                            <p class="order-addr">📍 <?php echo $order['address']; ?></p>
                            <h3 class="order-total">₹<?php echo $order['total_amount']; ?></h3>
                        </div>

                        <div class="order-status-box">
                            <span class="status-pill <?php echo strtolower($order['status']); ?>">
                                <?php echo $order['status']; ?>
                            </span>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <p>Aapne abhi tak koi order nahi kiya hai. Pehla crunch aaj hi mangwayein!</p>
                <a href="index.php" class="btn-primary">Browse Flavors</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>