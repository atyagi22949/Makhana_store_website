<?php
include 'includes/db_connect.php';
$id = $_GET['id'];
$res = $conn->query("SELECT * FROM flavors WHERE id = $id");
$row = $res->fetch_assoc();

if ($row):
?>
    <div class="qv-flex">
        <div class="qv-img">
            <img src="images/<?php echo $row['image_url']; ?>" width="100%">
        </div>
        <div class="qv-details">
            <h2 style="font-family: 'Fredoka One';"><?php echo $row['name']; ?></h2>
            <p class="qv-tagline" style="color:#ffc107; font-weight:700;"><?php echo $row['tagline']; ?></p>
            <div class="qv-price" style="font-size: 2rem; font-weight: 800; margin: 15px 0;">₹<?php echo $row['price']; ?></div>
            <p style="color:#666; line-height: 1.6;"><?php echo $row['description'] ?? 'Bihar\'s finest roasted fox nuts with a Juss crunch.'; ?></p>

            <form method="POST" action="flavors.php" style="margin-top: 20px;">
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
<?php endif; ?>
<style>
    .qv-modal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.8);
        backdrop-filter: blur(5px);
        align-items: center;
        justify-content: center;
    }

    .qv-modal-content {
        background-color: #fff;
        padding: 40px;
        border-radius: 25px;
        width: 90%;
        max-width: 800px;
        position: relative;
        animation: zoomIn 0.3s ease;
    }

    .qv-close {
        position: absolute;
        right: 20px;
        top: 15px;
        font-size: 2rem;
        cursor: pointer;
        color: #333;
    }

    .qv-flex {
        display: flex;
        gap: 40px;
        align-items: center;
    }

    .qv-img {
        flex: 1;
        background: #f9f9f9;
        border-radius: 20px;
        padding: 20px;
    }

    .qv-details {
        flex: 1.2;
    }

    @keyframes zoomIn {
        from {
            transform: scale(0.8);
            opacity: 0;
        }

        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    @media (max-width: 768px) {
        .qv-flex {
            flex-direction: column;
        }

        .qv-modal-content {
            padding: 20px;
            height: 90vh;
            overflow-y: auto;
        }
    }
</style>

<script>
    function openQuickView(productId) {
        const modal = document.getElementById("quickViewModal");
        const container = document.getElementById("qv-data-container");

        modal.style.display = "flex";

        // Fetch product details using AJAX
        fetch('get_product_details.php?id=' + productId)
            .then(response => response.text())
            .then(data => {
                container.innerHTML = data;
            })
            .catch(error => {
                container.innerHTML = "Error loading details.";
            });
    }

    function closeModal() {
        document.getElementById("quickViewModal").style.display = "none";
    }

    // Modal ke bahar click karne par close ho jaye
    window.onclick = function(event) {
        let modal = document.getElementById("quickViewModal");
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>