<?php
// 1. DATABASE & SESSION LOGIC
include 'includes/db_connect.php';
session_start();

// Add to Cart Logic
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    if (!in_array($product_id, $_SESSION['cart'])) {
        array_push($_SESSION['cart'], $product_id);
        echo "<script>alert('Flavor added to cart!'); window.location.href='flavors.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Flavors | Juss Makhana</title>

    <link rel="stylesheet" href="assets/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />


</head>

<body>

    <?php include 'includes/header.php'; ?>

    <section class="shop-products">
        <div class="product-header-row" data-aos="fade-up">
            <span class="munch-badge">HEALTHY & CRUNCHY</span>
            <h2 class="title-main">CHOOSE YOUR <span>FAVORITE MUNCH</span></h2>
            <div class="olive-separator"></div>
        </div>

        <div class="container">
            <div class="product-grid-final">
                <?php
                $res = $conn->query("SELECT * FROM flavors");
                while ($row = $res->fetch_assoc()):
                    $original_price = round($row['price'] * 1.4);
                ?>
                    <div class="makhana-card" data-aos="fade-up">
                        <div class="makhana-img-box">
                            <img src="images/<?php echo $row['image_url']; ?>" alt="Flavor">

                            <div class="card-overlay">
                                <div class="overlay-icons">
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="add_to_cart" class="icon-btn" title="Like & Add">
                                            <i class="fas fa-heart" style="color:#e31b23;"></i>
                                        </button>
                                    </form>
                                    <button type="button" class="icon-btn" onclick="openQuickView(<?php echo $row['id']; ?>)">
                                        <i class="far fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="makhana-details" style="padding-top:15px;">
                            <h3 class="makhana-name"><?php echo $row['name']; ?></h3>
                            <div class="makhana-pricing" style="margin: 10px 0;">
                                <span style="font-size:1.5rem; font-weight:800; color: #ffc107;">₹<?php echo $row['price']; ?></span>
                                <span style="text-decoration:line-through; color:#aaa; margin-left:10px;">₹<?php echo $original_price; ?></span>
                            </div>
                            <form method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                                <button type="submit"
                                        name="add_to_cart"
                                        style=" width: 100%;  background-color: #ffc107; color: #1a1a1a; border: none; padding: 14px 20px; border-radius: 12px; cursor: pointer;  font-family: 'Poppins', 'Fredoka One', sans-serif;  font-size: 18px; font-weight: 800;  text-transform: uppercase; letter-spacing: 1px;  display: flex;  align-items: center;  justify-content: center;  gap: 12px; box-shadow: 0 5px 15px rgba(255, 193, 7, 0.3); transition: 0.3s ease;"
                                        onmouseover="this.style.backgroundColor='#000'; this.style.color='#ffc107'; this.style.transform='translateY(-3px)';"
                                        onmouseout="this.style.backgroundColor='#ffc107'; this.style.color='#1a1a1a'; this.style.transform='translateY(0)';"><i class="fas fa-shopping-basket"></i> ADD TO CART
                                    </button>
                            </form>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>

    <div id="quickViewModal" class="qv-modal">
        <div class="qv-modal-content">
            <span class="qv-close" onclick="closeModal()">&times;</span>
            <div id="qv-data-container">
                <p style="text-align:center;">Fetching Juss flavors...</p>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="assets/script.js"></script>
</body>

</html>
