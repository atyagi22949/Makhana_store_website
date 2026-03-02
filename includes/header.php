<?php
// Session start check taaki cart count sahi dikhe
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Makhana Munch - India's premium roasted fox nuts. Healthy, crunchy, and delicious snacks delivered to your door.">
    <meta name="keywords" content="Makhana, Roasted Fox Nuts, Healthy Snacks, Makhana Munch, Buy Makhana Online">

    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header class="main-header">
        <div class="container header-flex">

            <div class="logo">
                <a href="index.php">
                    <img src="images/logo1.png" alt="Makhana Munch Logo" class="logo-img" loading="eager">
                </a>
            </div>

            <div class="mobile-menu-btn" id="mobile-toggle">
                <span></span>
                <span></span>
                <span></span>
            </div>

            <nav class="navbar" id="main-nav">
                <ul class="nav-menu">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="aboutus.php">Aboutus</a></li>
                    <li><a href="flavors.php">Flavors</a></li>

                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li class="dropdown">
                            <a href="javascript:void(0)" class="user-pill">
                                👋 Hi, <?php echo htmlspecialchars(explode(' ', $_SESSION['user_name'])[0]); ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="my-orders.php">My Orders</a></li>
                                <li><a href="logout-user.php" class="logout-link">Logout</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li><a href="signup.php" class="signup-btn">Join Club</a></li>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true): ?>
                        <li><a href="admin/admin.php" style="color: #FFD700; font-weight: bold;">Admin</a></li>
                    <?php endif; ?>
                </ul>
            </nav>

            <div class="header-actions">
                <a href="cart.php" class="cart-icon" aria-label="View Cart">
                    🛒 <span class="badge" id="cart-count">
                        <?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>
                    </span>
                </a>
            </div>

        </div>
    </header>

    <style>
        @media (max-width: 768px) {
            .mobile-menu-btn {
                display: flex;
                flex-direction: column;
                gap: 5px;
                cursor: pointer;
                z-index: 1001;
            }

            .mobile-menu-btn span {
                width: 25px;
                height: 3px;
                background: var(--yellow);
                border-radius: 5px;
                transition: 0.3s;
            }

            .navbar {
                position: fixed;
                top: 0;
                right: -100%;
                width: 70%;
                height: 100vh;
                background: var(--black);
                padding: 100px 30px;
                transition: 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                box-shadow: -10px 0 30px rgba(0, 0, 0, 0.5);
            }

            .navbar.active {
                right: 0;
            }

            .nav-menu {
                flex-direction: column;
                gap: 30px;
                text-align: left;
            }
        }

        @media (min-width: 769px) {
            .mobile-menu-btn {
                display: none;
            }
        }
    </style>

    <script>
        document.getElementById('mobile-toggle').addEventListener('click', function() {
            document.getElementById('main-nav').classList.toggle('active');
            this.classList.toggle('open');
        });
    </script>