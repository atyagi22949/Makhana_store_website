<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<footer class="footer">
    <div class="footer-container">
        <div class="footer-section about">
            <div class="logo">
                <a href="index.php">
                    <img src="images/logo1.png" alt="Makhana Munch Logo" class="logo-img" loading="eager">
                </a>
            </div>
            <p>We bring you the crunchiest, healthiest, and most flavorful roasted Makhanas. Handpicked for your snack time.</p>
            <div class="socials">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
            </div>
        </div>

        <div class="footer-section links">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#flavors">Our Flavors</a></li>
                <li><a href="#">Shipping Policy</a></li>
                <li><a href="#">Terms & Conditions</a></li>
            </ul>
        </div>

        <div class="footer-section contact-info">
            <h3>Contact Us</h3>
            <p>📍 Gurugram, Haryana, India</p>
            <p>📧 support@makhanamunch.com</p>
            <p>📞 +91 98765 43210</p>
        </div>
    </div>

    <div class="footer-bottom">
        &copy; <?php echo date("Y"); ?> Makhana Munch | Designed with ❤️ for Healthy Crunchers
    </div>
</footer>

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        once: true
    });

    // Mobile Menu Toggle Logic
    const hamburger = document.querySelector('#mobile-menu');
    const navMenu = document.querySelector('.nav-menu');

    hamburger.addEventListener('click', () => {
        navMenu.classList.toggle('active');
        hamburger.classList.toggle('is-active');
    });
</script>
</body>

</html>