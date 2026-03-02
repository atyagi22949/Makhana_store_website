<?php
// 1. DATABASE & SESSION LOGIC
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Story | Juss Makhana - The Future of Snacking</title>

    <link rel="stylesheet" href="assets/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <style>
        :root {
            --juss-yellow: #ffc107;
            --soft-white: #f8f9fa;
            --deep-black: #0a0a0a;
        }

        body {
            background-color: var(--soft-white);
            color: var(--deep-black);
            font-family: 'Poppins', sans-serif;
        }

        /* Dribbble Style: Clean & Spaced Section */
        .about-hero-section {
            padding: 120px 0 80px;
            overflow: hidden;
        }

        .hero-layout {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 60px;
            align-items: center;
        }

        .hero-tag {
            display: inline-block;
            background: rgba(255, 193, 7, 0.1);
            color: var(--juss-yellow);
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.9rem;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        .main-title {
            font-family: 'Fredoka One', cursive;
            font-size: clamp(3rem, 6vw, 4.5rem);
            line-height: 1.1;
            margin-bottom: 30px;
            color: var(--deep-black);
        }

        .main-title span {
            color: var(--juss-yellow);
        }

        .story-p {
            font-size: 1.2rem;
            line-height: 1.8;
            color: #555;
            max-width: 600px;
            margin-bottom: 40px;
        }

        /* Modern Asymmetric Image Gallery */
        .image-showcase {
            position: relative;
        }

        .main-img-box {
            background: var(--juss-yellow);
            border-radius: 40px;
            padding: 40px;
            transform: rotate(-3deg);
            transition: 0.5s ease;
        }

        .main-img-box:hover {
            transform: rotate(0deg) scale(1.02);
        }

        .main-img-box img {
            width: 100%;
            filter: drop-shadow(0 30px 50px rgba(0, 0, 0, 0.2));
        }

        /* Benefits Grid: Clean & Minimal */
        .benefits-v2 {
            padding: 80px 0;
            background: #fff;
            border-radius: 60px 60px 0 0;
            margin-top: -40px;
            position: relative;
            z-index: 10;
        }

        .benefit-card {
            padding: 40px;
            border-radius: 30px;
            background: var(--soft-white);
            border: 1px solid transparent;
            transition: 0.3s;
            height: 100%;
        }

        .benefit-card:hover {
            background: #fff;
            border-color: var(--juss-yellow);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
            transform: translateY(-10px);
        }

        .b-icon {
            width: 60px;
            height: 60px;
            background: #fff;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin-bottom: 25px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        }

        .b-title {
            font-family: 'Fredoka One', cursive;
            font-size: 1.5rem;
            margin-bottom: 15px;
        }

        .b-desc {
            color: #888;
            font-size: 1rem;
            line-height: 1.6;
        }

        .cta-btn-modern {
            background: var(--deep-black);
            color: #fff;
            padding: 18px 45px;
            border-radius: 50px;
            font-weight: 700;
            border: none;
            cursor: pointer;
            transition: 0.3s;
            font-family: 'Poppins';
            text-decoration: none;
            display: inline-block;
        }

        .cta-btn-modern:hover {
            background: var(--juss-yellow);
            color: var(--deep-black);
            transform: translateY(-5px);
        }

        @media (max-width: 991px) {
            .hero-layout {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .story-p {
                margin: 0 auto 40px;
            }

            .main-img-box {
                transform: rotate(0deg);
                max-width: 400px;
                margin: 0 auto;
            }
        }
    </style>
</head>

<body>

    <?php include 'includes/header.php'; ?>

    <main>
        <section class="about-hero-section">
            <div class="container">
                <div class="hero-layout">
                    <div class="hero-text" data-aos="fade-right">
                        <span class="hero-tag">Since 2026</span>
                        <h1 class="main-title">Crafting the Purest <span>Crunch</span> for You.</h1>
                        <p class="story-p">
                            At <strong>Juss Makhana</strong>, we believe snacking shouldn't be a compromise.
                            Our journey began in the pristine ponds of Bihar, where nature grows its finest
                            superfood. We handpick, slow-roast, and season every fox nut to deliver an
                            authentic Indian experience with a global standard of quality.
                        </p>
                        <a href="flavors.php" class="cta-btn-modern">Explore Flavors</a>
                    </div>

                    <div class="image-showcase" data-aos="fade-left">
                        <div class="main-img-box">
                            <img src="images/makhana-bowl.png" alt="Premium Juss Makhana Bowl">
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- third section -->
        <section style="padding: 80px 0; background: #f9e199; border-top: 1px solid #eee;">
            <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">

                <div style="
            display: flex; 
            flex-direction: row; 
            justify-content: space-between; 
            align-items: flex-start; 
            gap: 20px; 
            flex-wrap: wrap; /* Desktop par ek line, Mobile par auto-adjust */
        ">

                    <div style="flex: 1; min-width: 200px; text-align: center;" data-aos="fade-up">
                        <h2 style="font-family: 'Fredoka One'; font-size: clamp(2.5rem, 4vw, 3.5rem); color: #1a1a1a; margin-bottom: 5px;">500+</h2>
                        <span style="color: #ffc107; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; font-size: 0.85rem; display: block;">Bihar Farmers</span>
                        <p style="color: #333; font-size: 0.85rem; margin-top: 10px; line-height: 1.5;">Supporting local cultivation directly from the source.</p>
                    </div>

                    <div style="flex: 1; min-width: 200px; text-align: center;" data-aos="fade-up" data-aos-delay="100">
                        <h2 style="font-family: 'Fredoka One'; font-size: clamp(2.5rem, 4vw, 3.5rem); color: #1a1a1a; margin-bottom: 5px;">25k+</h2>
                        <span style="color: #ffc107; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; font-size: 0.85rem; display: block;">Happy Munchers</span>
                        <p style="color: #333; font-size: 0.85rem; margin-top: 10px; line-height: 1.5;">Delivering zero-guilt snacks across the nation.</p>
                    </div>

                    <div style="flex: 1; min-width: 200px; text-align: center;" data-aos="fade-up" data-aos-delay="200">
                        <h2 style="font-family: 'Fredoka One'; font-size: clamp(2.5rem, 4vw, 3.5rem); color: #1a1a1a; margin-bottom: 5px;">12+</h2>
                        <span style="color: #ffc107; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; font-size: 0.85rem; display: block;">Juss Flavors</span>
                        <p style="color: #333; font-size: 0.85rem; margin-top: 10px; line-height: 1.5;">Crafted with authentic Indian spices and love.</p>
                    </div>

                    <div style="flex: 1; min-width: 200px; text-align: center;" data-aos="fade-up" data-aos-delay="300">
                        <h2 style="font-family: 'Fredoka One'; font-size: clamp(2.5rem, 4vw, 3.5rem); color: #1a1a1a; margin-bottom: 5px;">0%</h2>
                        <span style="color: #ffc107; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; font-size: 0.85rem; display: block;">Palm Oil</span>
                        <p style="color: #333; font-size: 0.85rem; margin-top: 10px; line-height: 1.5;">Pure roasting, zero frying. That's our promise.</p>
                    </div>

                </div>
            </div>
        </section>
        <section class="benefits-v2">
            <div style="text-align: center; margin-bottom: 60px;">
                <h2 style="font-family: 'Fredoka One'; font-size: 2.5rem;">Why Juss is <span style="color:var(--juss-yellow)">Better</span></h2>
            </div>
            <div class="container">

                <div class="benefits-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px;">

                    <div class="benefit-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="b-icon">💪</div>
                        <h3 class="b-title">Protein Rich</h3>
                        <p class="b-desc">Packed with plant-based protein to keep your energy levels soaring throughout the day.</p>
                    </div>

                    <div class="benefit-card" data-aos="fade-up" data-aos-delay="200">
                        <div class="b-icon">🔥</div>
                        <h3 class="b-title">Never Fried</h3>
                        <p class="b-desc">Slow-roasted in small batches without a single drop of palm oil. Purely healthy.</p>
                    </div>

                    <div class="benefit-card" data-aos="fade-up" data-aos-delay="300">
                        <div class="b-icon">🌿</div>
                        <h3 class="b-title">100% Natural</h3>
                        <p class="b-desc">No MSG, no artificial preservatives. Just hand-picked makhana and real spices.</p>
                    </div>

                </div>
            </div>
        </section>
        <section style="padding: 100px 0; background-color: #fff; font-family: 'Poppins', sans-serif;">
            <div class="container" style="max-width: 1100px; margin: 0 auto; padding: 0 20px;">

                <div style="text-align: center; justify-content:center;" data-aos="fade-down">
                    <h2 style="font-family: 'Fredoka One'; font-size: 2.5rem; color: #1a1a1a;  justify-content:center; align-items:center;">Why <span style="color: #ffc107;">Juss</span> is the Winner</h2>
                    <p style="color: #333;">A quick look at why we lead the snacking revolution.</p>
                </div>

                <div style="overflow-x: auto; border-radius: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.05);">
                    <table style="width: 100%; border-collapse: collapse; background: #fff; min-width: 600px; text-align: left;">
                        <thead>
                            <tr style="background: #333; color: #fff;">
                                <th style="padding: 25px; font-size: 1.1rem; border-top-left-radius: 20px;">Feature</th>
                                <th style="padding: 25px; font-size: 1.1rem; text-align: center; background: #ffc107; color: #1a1a1a;">Juss Makhana</th>
                                <th style="padding: 25px; font-size: 1.1rem; text-align: center; border-top-right-radius: 20px;">Ordinary Snacks</th>
                            </tr>
                        </thead>
                        <tbody style="font-weight: 600; color: #333;">
                            <tr style="border-bottom: 1px solid #eee;">
                                <td style="padding: 20px 25px;">Cooking Method</td>
                                <td style="padding: 20px 25px; text-align: center; color: #28a745;">Slow Roasted (No Oil)</td>
                                <td style="padding: 20px 25px; text-align: center; color: #dc3545;">Deep Fried</td>
                            </tr>
                            <tr style="border-bottom: 1px solid #eee; background: #fcfcfc;">
                                <td style="padding: 20px 25px;">Palm Oil Content</td>
                                <td style="padding: 20px 25px; text-align: center; color: #28a745;">0% Pure</td>
                                <td style="padding: 20px 25px; text-align: center; color: #dc3545;">High (Unhealthy)</td>
                            </tr>
                            <tr style="border-bottom: 1px solid #eee;">
                                <td style="padding: 20px 25px;">Protein Content</td>
                                <td style="padding: 20px 25px; text-align: center; color: #28a745;">High Plant Protein</td>
                                <td style="padding: 20px 25px; text-align: center; color: #dc3545;">Empty Calories</td>
                            </tr>
                            <tr style="border-bottom: 1px solid #eee; background: #fcfcfc;">
                                <td style="padding: 20px 25px;">Preservatives</td>
                                <td style="padding: 20px 25px; text-align: center; color: #28a745;">None (All Natural)</td>
                                <td style="padding: 20px 25px; text-align: center; color: #dc3545;">High MSG & Lead</td>
                            </tr>
                            <tr>
                                <td style="padding: 25px; border-bottom-left-radius: 20px;">Guilt Level</td>
                                <td style="padding: 25px; text-align: center; background: rgba(255, 193, 7, 0.1); color: #1a1a1a;">Zero Guilt</td>
                                <td style="padding: 25px; text-align: center; border-bottom-right-radius: 20px;">Maximum Regret</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <section style="padding: 100px 0; background-color: #f9f9f9; font-family: 'Poppins', sans-serif; ">
            <div style="text-align: center; margin-bottom: 50px;" data-aos="fade-up">
                <h2 style="font-family: 'Fredoka One'; font-size: 2.8rem; color: #1a1a1a;">Common <span style="color: #ffc107;">Questions</span></h2>
                <p style="color: #777;">Everything you need to know about your favorite healthy snack.</p>
            </div>

            <div class="container" style="max-width: 900px; margin: 0 auto; padding: 0 20px;">



                <div style="display: flex; flex-direction: column; gap: 15px;">

                    <div style="background: #fff; border-radius: 15px; border: 1px solid #eee; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.02);">
                        <button onclick="toggleFaq(this)" style="width: 100%; padding: 25px; border: none; background: none; text-align: left; display: flex; justify-content: space-between; align-items: center; cursor: pointer; outline: none;">
                            <span style="font-weight: 700; font-size: 1.1rem; color: #1a1a1a;">Is Juss Makhana really oil-free?</span>
                            <i class="fas fa-chevron-down" style="color: #ffc107; transition: 0.3s;"></i>
                        </button>
                        <div style="max-height: 0; overflow: hidden; transition: 0.3s ease-out; background: #fff;">
                            <p style="padding: 0 25px 25px; color: #666; line-height: 1.6;">
                                Yes! We use a specialized slow-roasting process that uses zero palm oil or trans-fats. It's 100% roasted to maintain maximum health benefits.
                            </p>
                        </div>
                    </div>

                    <div style="background: #fff; border-radius: 15px; border: 1px solid #eee; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.02);">
                        <button onclick="toggleFaq(this)" style="width: 100%; padding: 25px; border: none; background: none; text-align: left; display: flex; justify-content: space-between; align-items: center; cursor: pointer; outline: none;">
                            <span style="font-weight: 700; font-size: 1.1rem; color: #1a1a1a;">What is the shelf life of the packets?</span>
                            <i class="fas fa-chevron-down" style="color: #ffc107; transition: 0.3s;"></i>
                        </button>
                        <div style="max-height: 0; overflow: hidden; transition: 0.3s ease-out; background: #fff;">
                            <p style="padding: 0 25px 25px; color: #666; line-height: 1.6;">
                                Our Makhana stays fresh and crunchy for up to 6 months. We use premium multilayer packaging to ensure the crunch stays intact from Bihar to your home.
                            </p>
                        </div>
                    </div>

                    <div style="background: #fff; border-radius: 15px; border: 1px solid #eee; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.02);">
                        <button onclick="toggleFaq(this)" style="width: 100%; padding: 25px; border: none; background: none; text-align: left; display: flex; justify-content: space-between; align-items: center; cursor: pointer; outline: none;">
                            <span style="font-weight: 700; font-size: 1.1rem; color: #1a1a1a;">Are there any artificial preservatives?</span>
                            <i class="fas fa-chevron-down" style="color: #ffc107; transition: 0.3s;"></i>
                        </button>
                        <div style="max-height: 0; overflow: hidden; transition: 0.3s ease-out; background: #fff;">
                            <p style="padding: 0 25px 25px; color: #666; line-height: 1.6;">
                                Absolutely not. We pride ourselves on our "Zero Junk Policy." No MSG, no artificial colors, and no lead—just pure spices and handpicked fox nuts.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <script>
            function toggleFaq(btn) {
                const content = btn.nextElementSibling;
                const icon = btn.querySelector('i');

                // Close other FAQs (Optional - for a cleaner feel)
                const allContents = document.querySelectorAll('.qv-modal-content p'); // Logic adjustment

                if (content.style.maxHeight && content.style.maxHeight !== "0px") {
                    content.style.maxHeight = "0px";
                    icon.style.transform = "rotate(0deg)";
                } else {
                    // Close others if needed
                    document.querySelectorAll('div[style*="max-height"]').forEach(el => el.style.maxHeight = "0px");
                    document.querySelectorAll('.fa-chevron-down').forEach(el => el.style.transform = "rotate(0deg)");

                    content.style.maxHeight = content.scrollHeight + "px";
                    icon.style.transform = "rotate(180deg)";
                }
            }
        </script>
    </main>

    <?php include 'includes/footer.php'; ?>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });
    </script>
</body>

</html>