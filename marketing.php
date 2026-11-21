
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deals & Promotions | CampusCart Express</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar">
        <div class="logo">Campus<span>Cart</span> Express</div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="shop.php">Shop</a></li>
            <li><a href="marketing.php">Deals</a></li>
            <li><a href="support.php">Support</a></li>
            <li><a href="payment.php">Checkout</a></li>
        </ul>

        <div style="display: flex; align-items: center; gap: 15px;">

            <?php if (isset($_SESSION['user_id'])): ?>

                <span style="color: #333; font-weight: 500; font-size: 0.95rem;">
                    Hi, <?php echo htmlspecialchars($_SESSION['full_name']); ?>
                </span>

                <a href="logout.php" class="cart-btn" style="background: #ef4444;">Logout</a>

            <?php else: ?>

                <a href="login.php" class="cart-btn">Login</a>

            <?php endif; ?>

            <a href="payment.php" class="cart-btn">
                Cart <span id="cart-count">0</span>
            </a>

        </div>
    </nav>

    <!-- Hero Banner for Deals -->
    <section class="hero" style="padding: 3.5rem 2rem;">
        <h1>Campus Deals of the Week</h1>
        <p>Exclusive offers for students. Limited stock. Don’t miss out!</p>
    </section>

    <div class="container">
        <h2 class="section-title">Current Promotions</h2>

        <div class="products">

            <!-- Deal 1 -->
            <div class="product-card">
                <div class="product-img">
                    <img src="images/534450680762670822.jpg" alt="Business Law">
                </div>
                <div class="product-info">
                    <h3>Business Law</h3>
                    <p style="color: #ef4444; font-weight: 600;">20% OFF – Was KES 3,500</p>
                    <div class="price">KES 2,800</div>
                    <button class="add-to-cart" onclick="addToCart('Business Law', 2800)">Add to Cart</button>
                </div>
            </div>

            <!-- Deal 2 -->
            <div class="product-card">
                <div class="product-img">
                    <img src="images/🌸🎧 Petals & Playlists 🎧🤍 Where soft aesthetics meet everyday essentials_ A little floral charm.jpg" alt="Wireless Earbuds">
                </div>
                <div class="product-info">
                    <h3>Wireless Earbuds</h3>
                    <p style="color: #ef4444; font-weight: 600;">Buy 1 Get 15% OFF</p>
                    <div class="price">KES 500</div>
                    <button class="add-to-cart" onclick="addToCart('Wireless Earbuds', 500)">Add to Cart</button>
                </div>
            </div>

            <!-- Deal 3 -->
            <div class="product-card">
                <div class="product-img">
                    <img src="images/matériel de école.jpg" alt="Stationery Bundle">
                </div>
                <div class="product-info">
                    <h3>Stationery Bundle</h3>
                    <p style="color: #ef4444; font-weight: 600;">Student Special – Only this week</p>
                    <div class="price">KES 1,200</div>
                    <button class="add-to-cart" onclick="addToCart('Stationery Bundle', 1200)">Add to Cart</button>
                </div>
            </div>

            <!-- Deal 4 -->
            <div class="product-card">
                <div class="product-img">
                    <img src="images/NEW ARRIVALS 🥳 NEW ARRIVALS🥳🥳__We have new….jpg" alt="Dorm Essentials">
                </div>
                <div class="product-info">
                    <h3>Dorm Essentials Pack</h3>
                    <p style="color: #ef4444; font-weight: 600;">Free Delivery on Campus</p>
                    <div class="price">KES 4,500</div>
                    <button class="add-to-cart" onclick="addToCart('Dorm Essentials Pack', 4500)">Add to Cart</button>
                </div>
            </div>

        </div>

        <!-- Extra Marketing Section -->
        <div style="margin-top: 4rem; background: rgb(104, 153, 115); padding: 2.5rem; border-radius: 16px; text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.08);">
            <h2 style="color: var(--primary); margin-bottom: 1rem;">Join Our Student Loyalty Club</h2>
            <p style="max-width: 600px; margin: 0 auto 1.5rem; color: #83648b;">
                Get early access to deals, free delivery, and exclusive student discounts. Just use your university email.
            </p>
            <a href="support.php" class="btn">Join Free →</a>
        </div>
    </div>

    <footer>
        <p>© 2026 CampusCart Express</p>
        <p style="margin-top:0.5rem; font-size:0.85rem;">
            <a href="backoffice/procurement.php">Back Office</a> (Hidden Link)
        </p>
    </footer>

    <script src="js/cart.js"></script>
</body>
</html>
