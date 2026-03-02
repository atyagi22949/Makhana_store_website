<?php
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
        echo "<script>alert('Makhana added to cart!'); window.location.href='index.php';</script>";
        exit();
    } else {
        echo "<script>alert('Already in cart!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Makhana Munch | Healthy & Crunchy Roasted Fox Nuts</title>

    <meta name="description" content="Premium roasted Makhana in exciting flavors. Shop healthy snacks at Makhana Munch.">
    <meta name="author" content="Makhana Munch">
    <meta property="og:title" content="Makhana Munch | Premium Snacks">
    <meta property="og:image" content="images/main hero image.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>

<body>

    <?php include 'includes/header.php'; ?>

    <main>
        <section class="hero-clean">
            <div class="hero-bg-lock"></div>
            <a href="#flavor-strips" class="scroll-indicator">
                <div class="mouse">
                    <div class="wheel"></div>
                </div>
            </a>
        </section>

        <section id="product-spotlight" class="spotlight-section">
            <div class="parallax-sunburst"></div>

            <div class="swiper spotlightSwiper">
                <div class="swiper-wrapper">
                    <?php
                    $res = $conn->query("SELECT * FROM flavors");
                    while ($row = $res->fetch_assoc()):
                    ?>
                        <div class="swiper-slide" data-color="<?php echo $row['bg_color']; ?>">
                            <div class="spotlight-container container">
                                <div class="spotlight-visual">
                                    <img src="images/<?php echo $row['image_url']; ?>" class="stack-packet" alt="Makhana">
                                </div>
                                <div class="spotlight-details">
                                    <h2 class="spotlight-title"><?php echo $row['name']; ?></h2>
                                    <p class="spotlight-desc"><?php echo $row['tagline']; ?></p>
                                    <button class="discover-btn">DISCOVER MORE</button>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
                <div class="swiper-button-next spotlight-nav"></div>
                <div class="swiper-button-prev spotlight-nav"></div>
            </div>
        </section>



        <section id="flavor-strips" class="strips-section">
            <div class="swiper flavorCarousel">
                <div class="swiper-wrapper">
                    <?php
                    $res = $conn->query("SELECT * FROM flavors");
                    $slideCount = $res->num_rows; // Logic ke liye count chahiye
                    while ($row = $res->fetch_assoc()):
                    ?>
                        <div class="swiper-slide flavor-strip" style="background-color: <?php echo $row['bg_color']; ?>;">
                            <div class="strip-inner-content">
                                <div class="packet-box">
                                    <img src="images/<?php echo $row['image_url']; ?>" class="tilt-packet" alt="<?php echo $row['name']; ?>">
                                </div>
                                <div class="flavor-meta">
                                    <h3><?php echo $row['name']; ?></h3>
                                    <p><?php echo $row['tagline']; ?></p>
                                    <form method="POST">
                                        <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                                        <button type="submit"
                                            name="add_to_cart"
                                            style="
            width: 50%; 
            background-color: #ffc107; 
            color: #1a1a1a; 
            border: none; 
            padding: 14px ; 
            border-radius: 12px; 
            cursor: pointer; 
            font-family: 'Poppins', 'Fredoka One', sans-serif; 
            font-size: 18px; 
            font-weight: 800; 
            text-transform: uppercase; 
            letter-spacing: 1px; 
            align-items: center; 
            justify-content: center; 
            gap: 12px; 
            box-shadow: 0 5px 15px rgba(255, 193, 7, 0.3); 
            transition: 0.3s ease;
        "
                                            onmouseover="this.style.backgroundColor='#000'; this.style.color='#ffc107'; this.style.transform='translateY(-3px)';"
                                            onmouseout="this.style.backgroundColor='#ffc107'; this.style.color='#1a1a1a'; this.style.transform='translateY(0)';">
                                            <i class="fas fa-shopping-basket"></i> ADD ₹<?php echo $row['price']; ?>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </section>

        <section class="trust-signals-section">
            <div class="container">
                <div class="signals-grid">

                    <div class="signal-card" data-aos="fade-up">
                        <div class="signal-icon-wrapper">
                            <div class="icon-bg">
                                <img src="images/shipping-icon.png" alt="Free Shipping">
                            </div>
                        </div>
                        <div class="signal-text">
                            <h4>Free Shipping</h4>
                            <p>On orders above ₹299</p>
                        </div>
                    </div>

                    <div class="signal-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="signal-icon-wrapper">
                            <div class="icon-bg">
                                <img src="images/secure-icon.png" alt="Premium Quality">
                            </div>
                        </div>
                        <div class="signal-text">
                            <h4>Premium Quality</h4>
                            <p>100% Natural & Fresh</p>
                        </div>
                    </div>

                    <div class="signal-card" data-aos="fade-up" data-aos-delay="200">
                        <div class="signal-icon-wrapper">
                            <div class="icon-bg">
                                <img src="images/support-icon.png" alt="24/7 Support">
                            </div>
                        </div>
                        <div class="signal-text">
                            <h4>24/7 Support</h4>
                            <p>Customer Care Service</p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- cards section  -->
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
                                        style="
            width: 100%; 
            background-color: #ffc107; 
            color: #1a1a1a; 
            border: none; 
            padding: 14px 20px; 
            border-radius: 12px; 
            cursor: pointer; 
            font-family: 'Poppins', 'Fredoka One', sans-serif; 
            font-size: 18px; 
            font-weight: 800; 
            text-transform: uppercase; 
            letter-spacing: 1px; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            gap: 12px; 
            box-shadow: 0 5px 15px rgba(255, 193, 7, 0.3); 
            transition: 0.3s ease;
        "
                                        onmouseover="this.style.backgroundColor='#000'; this.style.color='#ffc107'; this.style.transform='translateY(-3px)';"
                                        onmouseout="this.style.backgroundColor='#ffc107'; this.style.color='#1a1a1a'; this.style.transform='translateY(0)';">
                                        <i class="fas fa-shopping-basket"></i> ADD TO CART
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

            </div>
        </div>
        <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
        <!-- fourth section  -->
        <section class="process-section" id="process">
            <div class="container">
                <div class="process-header" data-aos="fade-up">
                    <h2>CRAFTED WITH <span>CARE</span></h2>
                    <p>Seedha khet se aapke hath tak, bina kisi compromise ke.</p>
                </div>

                <div class="process-grid">
                    <div class="process-item" data-aos="fade-up" data-aos-delay="100">
                        <div class="icon-circle">
                            <img src="images/icon-farm.png" alt="Handpicked">
                        </div>
                        <h4>Handpicked Quality</h4>
                        <p>Only the largest and brightest fox nuts are selected for roasting.</p>
                    </div>

                    <div class="process-item" data-aos="fade-up" data-aos-delay="200">
                        <div class="icon-circle">
                            <img src="images/icon-roast.png" alt="Slow Roasted">
                        </div>
                        <h4>Never Fried</h4>
                        <p>Slow-roasted in small batches to preserve nutrition and maximum crunch.</p>
                    </div>

                    <div class="process-item" data-aos="fade-up" data-aos-delay="300">
                        <div class="icon-circle">
                            <img src="images/icon-spice.png" alt="Natural Spices">
                        </div>
                        <h4>Zero Artificials</h4>
                        <p>Seasoned with authentic Indian spices. No MSG, no added preservatives.</p>
                    </div>
                </div>
            </div>
        </section>
        <!--  end of seection  -->

        <!-- fifth section  -->
        <section id="reviews" style="padding: 100px 0; background-color: #fdfdfd; font-family: 'Poppins', sans-serif; overflow: hidden;">
            <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">

                <div style="text-align: center; margin-bottom: 60px;">
                    <span style="color: #ffc107; font-weight: 800; letter-spacing: 2px; font-size: 22px; text-transform: uppercase;">Real Experiences</span>
                    <h2 style="font-family: 'Fredoka One', cursive; font-size: 3rem; color: #1a1a1a; margin-top: 10px;">What Our <span style="color: #ffc107;">Munchers</span> Say</h2>
                    <div style="width: 60px; height: 5px; background: #ffc107; margin: 20px auto; border-radius: 10px;"></div>
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">

                    <div style="background: #fff; padding: 40px 30px; border-radius: 30px; border: 1px solid #eee; box-shadow: 0 15px 35px rgba(0,0,0,0.03); transition: 0.3s; position: relative;"
                        onmouseover="this.style.transform='translateY(-10px)'; this.style.borderColor='#ffc107';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.borderColor='#eee';">

                        <div style="color: #ffc107; font-size: 3rem; font-family: serif; position: absolute; top: 20px; right: 30px; opacity: 0.2;">&ldquo;</div>
                        <div style="margin-bottom: 15px; color: #ffc107; font-size: 18px;">⭐⭐⭐⭐⭐</div>

                        <p style="font-size: 1.1rem; color: #444; line-height: 1.8; font-style: italic; margin-bottom: 30px;">
                            "Best snack for my office hunger! juss makhana Masala is literally magic. Highly recommended for daily crunching."
                        </p>

                        <div style="display: flex; align-items: center; gap: 15px; border-top: 1px solid #f1f1f1; padding-top: 20px;">
                            <div style="width: 50px; height: 50px; background: #ffc107; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 800; color: #fff; font-size: 1.2rem;">A</div>
                            <div>
                                <h4 style="margin: 0; color: #1a1a1a; font-size: 1.1rem;">Anjali Sharma</h4>
                                <span style="color: #888; font-size: 0.9rem;">Verified Buyer</span>
                            </div>
                        </div>
                    </div>

                    <div style="background: #fff; padding: 40px 30px; border-radius: 30px; border: 1px solid #eee; box-shadow: 0 15px 35px rgba(0,0,0,0.03); transition: 0.3s; position: relative;"
                        onmouseover="this.style.transform='translateY(-10px)'; this.style.borderColor='#ffc107';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.borderColor='#eee';">

                        <div style="color: #ffc107; font-size: 3rem; font-family: serif; position: absolute; top: 20px; right: 30px; opacity: 0.2;">&ldquo;</div>
                        <div style="margin-bottom: 15px; color: #ffc107; font-size: 18px;">⭐⭐⭐⭐⭐</div>

                        <p style="font-size: 1.1rem; color: #444; line-height: 1.8; font-style: italic; margin-bottom: 30px;">
                            "Finally a healthy snack juss makhana that doesn't taste like cardboard. The crunch is real! Perfect for post-workout."
                        </p>

                        <div style="display: flex; align-items: center; gap: 15px; border-top: 1px solid #f1f1f1; padding-top: 20px;">
                            <div style="width: 50px; height: 50px; background: #1a1a1a; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 800; color: #ffc107; font-size: 1.2rem; border: 2px solid #ffc107;">R</div>
                            <div>
                                <h4 style="margin: 0; color: #1a1a1a; font-size: 1.1rem;">Rahul Verma</h4>
                                <span style="color: #888; font-size: 0.9rem;">Fitness Pro</span>
                            </div>
                        </div>
                    </div>

                    <div style="background: #fff; padding: 40px 30px; border-radius: 30px; border: 1px solid #eee; box-shadow: 0 15px 35px rgba(0,0,0,0.03); transition: 0.3s; position: relative;"
                        onmouseover="this.style.transform='translateY(-10px)'; this.style.borderColor='#ffc107';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.borderColor='#eee';">

                        <div style="color: #ffc107; font-size: 3rem; font-family: serif; position: absolute; top: 20px; right: 30px; opacity: 0.2;">&ldquo;</div>
                        <div style="margin-bottom: 15px; color: #ffc107; font-size: 18px;">⭐⭐⭐⭐⭐</div>

                        <p style="font-size: 1.1rem; color: #444; line-height: 1.8; font-style: italic; margin-bottom: 30px;">
                            "The packaging is so premium, and the taste is even better. Classic Salted juss makahana is my absolute favorite go-to."
                        </p>

                        <div style="display: flex; align-items: center; gap: 15px; border-top: 1px solid #f1f1f1; padding-top: 20px;">
                            <div style="width: 50px; height: 50px; background: #ffc107; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 800; color: #fff; font-size: 1.2rem;">S</div>
                            <div>
                                <h4 style="margin: 0; color: #1a1a1a; font-size: 1.1rem;">Sneha Kapoor</h4>
                                <span style="color: #888; font-size: 0.9rem;">Daily Muncher</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- end of the section  -->

        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

        <script src="assets/script.js"></script>
        <?php include 'includes/footer.php'; ?>

</body>

</html>