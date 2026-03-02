// 1. Theme Switcher with Speed Optimization
function updateTheme(name, tagline, price, img, color, id) {
    const heroSection = document.getElementById('hero-bg');
    const mainImg = document.getElementById('main-packet');

    // Performance check: Sirf tabhi change karo agar color badal raha ho
    if (heroSection) {
        heroSection.style.background = `radial-gradient(circle at 70% 50%, ${color}22 0%, #0a0a0a 100%)`;
    }

    // Text update (SEO Friendly)
    if (document.getElementById('flavor-name')) {
        document.getElementById('flavor-name').innerHTML = name.split(' ').join('<br><span>') + '</span>';
        document.getElementById('flavor-tagline').innerText = tagline;
        document.getElementById('flavor-price').innerText = price;
        document.getElementById('prod-id').value = id;
    }

    // Smooth Image Swap
    if (mainImg) {
        mainImg.style.transition = "opacity 0.3s ease-in-out, transform 0.5s ease";
        mainImg.style.opacity = '0';
        mainImg.style.transform = 'scale(0.9) rotate(-5deg)';

        setTimeout(() => {
            mainImg.src = img;
            mainImg.style.opacity = '1';
            mainImg.style.transform = 'scale(1) rotate(0deg)';
        }, 250);
    }
}

// 2. Optimized Order Processing
function processOrder(totalAmount) {
    const name = document.getElementById('name').value.trim();
    const phone = document.getElementById('phone').value.trim();
    const address = document.getElementById('address').value.trim();

    if (!name || !phone || !address) {
        alert("⚠️ Please fill all delivery details!");
        return;
    }

    // WhatsApp logic with URL encoding optimization
    const message = encodeURIComponent(
        `*NEW ORDER - MAKHANA MUNCH*\n` +
        `--------------------------\n` +
        `👤 Name: ${name}\n` +
        `📞 Phone: ${phone}\n` +
        `📍 Address: ${address}\n` +
        `💰 Total: ₹${totalAmount}\n` +
        `--------------------------\n` +
        `Please confirm my order! 🍿`
    );

    const whatsappURL = `https://wa.me/919599448100?text=${message}`;

    // DB Save logic
    const formData = new FormData();
    formData.append('name', name);
    formData.append('phone', phone);
    formData.append('address', address);
    formData.append('total', totalAmount);

    // Button loading state (Premium Feel)
    const btn = document.querySelector('.checkout-final-btn');
    btn.innerHTML = "PROCESSING...";
    btn.disabled = true;

    fetch('save_order.php', {
        method: 'POST',
        body: formData
    })
        .finally(() => {
            // Confetti Celebration
            if (typeof confetti === 'function') {
                confetti({ particleCount: 150, spread: 70, origin: { y: 0.6 } });
            }

            // Fast redirect
            setTimeout(() => {
                window.location.href = whatsappURL;
            }, 800);
        });
}
// second section 

var spotlightSwiper = new Swiper(".spotlightSwiper", {
    direction: "vertical", // One comes up, one goes down
    mousewheel: true,      // Scroll karne par bhi move hoga
    speed: 1000,           // Transition speed
    loop: true,
    grabCursor: true,
    effect: "creative",
    creativeEffect: {
        prev: {
            shadow: true,
            translate: [0, "-120%", -500], // Purana packet upar jayega
        },
        next: {
            translate: [0, "120%", -500],  // Naya packet niche se aayega
        },
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    on: {
        slideChange: function () {
            // Background color transition based on active slide
            let activeSlide = this.slides[this.activeIndex];
            let bgColor = activeSlide.getAttribute('data-color');
            document.querySelector('.spotlight-section').style.backgroundColor = bgColor;

            // GSAP pulse effect for the incoming packet (if GSAP is included)
            if (window.gsap) {
                gsap.from(".swiper-slide-active .stack-packet", {
                    scale: 0.5,
                    opacity: 0,
                    duration: 1,
                    ease: "back.out(1.7)"
                });
            }
        }
    }
});

// eye script
AOS.init({
    duration: 800,
    once: true
});

function openQuickView(productId) {
    document.getElementById("quickViewModal").style.display = "flex";
    fetch('get_product_details.php?id=' + productId)
        .then(r => r.text())
        .then(d => {
            document.getElementById("qv-data-container").innerHTML = d;
        });
}

function closeModal() {
    document.getElementById("quickViewModal").style.display = "none";
}
window.onclick = function (e) {
    if (e.target.id == "quickViewModal") closeModal();
}

// swiper script
AOS.init({
    duration: 800,
    offset: 150,
    once: true
});

// Swiper Carousel Logic
document.addEventListener('DOMContentLoaded', function () {
    const slides = document.querySelectorAll('.flavor-strip');
    const totalSlides = slides.length;

    const swiper = new Swiper('.flavorCarousel', {
        // Unlimited logic: Sirf tabhi loop karein jab slides 4 se zyada hon
        loop: totalSlides > 1,
        slidesPerView: 1,
        spaceBetween: 0,
        grabCursor: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            768: {
                slidesPerView: 2
            },
            1024: {
                slidesPerView: totalSlides < 4 ? totalSlides : 4
            }
        }
    });
});