<?php 
include 'includes/db_connect.php'; 
include 'includes/header.php'; 

// Basic Logic: Remove Item
if (isset($_GET['remove'])) {
    $id = intval($_GET['remove']);
    if (($key = array_search($id, $_SESSION['cart'])) !== false) {
        unset($_SESSION['cart'][$key]);
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
    echo "<script>window.location.href='cart.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Munch Bag | Makhana Munch</title>
    <meta name="description" content="Review your healthy snacks and checkout at Makhana Munch. Premium roasted fox nuts delivered fast.">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="cart-page">

<div class="checkout-master">
    <div class="checkout-container">
        <header class="checkout-header" data-aos="fade-down">
            <h1>Your <span>Munch Bag</span></h1>
            <p>Ready for a healthy crunch? Review your items and checkout.</p>
        </header>

        <?php if (!empty($_SESSION['cart'])): ?>
        <div class="checkout-grid">
            
            <div class="items-section" data-aos="fade-right">
                <div class="glass-box">
                    <h2 class="box-title">1. Review Your Flavors</h2>
                    <div class="cart-list">
                        <?php
                        $total = 0;
                        $cart_ids = array_map('intval', $_SESSION['cart']);
                        $ids = implode(',', $cart_ids);
                        $res = $conn->query("SELECT * FROM flavors WHERE id IN ($ids)");
                        while ($item = $res->fetch_assoc()):
                            $total += $item['price'];
                        ?>
                        <div class="munch-item">
                            <div class="munch-img" style="background: <?php echo $item['bg_color']; ?>22;">
                                <img src="images/<?php echo $item['image_url']; ?>" alt="<?php echo $item['name']; ?>" loading="lazy">
                            </div>
                            <div class="munch-details">
                                <h3><?php echo $item['name']; ?></h3>
                                <p>Roasted & Healthy</p>
                                <span class="munch-price">₹<?php echo $item['price']; ?></span>
                            </div>
                            <a href="cart.php?remove=<?php echo $item['id']; ?>" class="munch-remove" title="Remove Item">✕</a>
                        </div>
                        <?php endwhile; ?>
                    </div>
                </div>

                <div class="glass-box mt-30" data-aos="fade-up">
                    <h2 class="box-title">2. Delivery Address</h2>
                    <form id="munchForm" class="munch-form">
                        <div class="input-row">
                            <input type="text" id="name" placeholder="Full Name" required>
                            <input type="tel" id="phone" placeholder="Mobile Number" required>
                        </div>
                        <textarea id="address" placeholder="Full Address (House No, Area, Pincode)" rows="3" required></textarea>
                    </form>
                </div>
            </div>

            <div class="summary-section" data-aos="fade-left">
                <div class="summary-card sticky-box">
                    <h2 class="box-title">Order Summary</h2>
                    <div class="bill-line">
                        <span>Items Total</span>
                        <span>₹<?php echo $total; ?></span>
                    </div>
                    <div class="bill-line">
                        <span>Delivery Fee</span>
                        <span class="free-badge">FREE</span>
                    </div>
                    <div class="bill-total">
                        <span>Grand Total</span>
                        <span>₹<?php echo $total; ?></span>
                    </div>
                    
                    <button type="button" class="checkout-final-btn" onclick="processOrder(<?php echo $total; ?>)">
                        PLACE ORDER NOW
                    </button>

                    <div class="trust-footer">
                        <p>✅ 100% Organic Quality</p>
                        <p>🚀 Super Fast Delivery</p>
                    </div>
                </div>
            </div>

        </div>
        <?php else: ?>
        <div class="empty-bag" style="text-align:center; padding: 100px 20px;" data-aos="zoom-in">
            <div style="font-size: 5rem; margin-bottom: 20px;">🍿</div>
            <h2 style="font-family: 'Fredoka One';">Your bag is empty!</h2>
            <p style="color: #666; margin-bottom: 30px;">Add some delicious flavors to get started.</p>
            <a href="index.php" class="btn-primary" style="text-decoration: none;">BROWSE FLAVORS</a>
        </div>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
<script src="assets/script.js"></script>
<?php include 'includes/footer.php'; ?>
</body>
</html>