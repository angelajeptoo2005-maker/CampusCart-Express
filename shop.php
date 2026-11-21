<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop | CampusCart Express</title>
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
</nav>


        <div style="display: flex; align-items: center; gap: 15px;">
            <?php if (isset($_SESSION['user_id'])): ?>
                <span style="color: #333; font-weight: 500; font-size: 0.95rem;">
                    Hi, <?php echo htmlspecialchars($_SESSION['full_name']); ?>
                </span>
                <a href="logout.php" class="cart-btn" style="background: #ef4444;">Logout</a>
            <?php else: ?>
                <a href="login.php" class="cart-btn">Login</a>
            <?php endif; ?>

            <a href="payment.html" class="cart-btn">Cart <span id="cart-count">0</span></a>
        </div>
    </nav>

    <div class="container">
        <h2 class="section-title">All Products</h2>

        <div class="products">

            <!-- Product 1 -->
            <div class="product-card">
                <div class="product-img">
                    <img src="images/Calculus _ Graphical, Numerical, Algebraic by Jane Montgomery Gibson (2019, Hardcover) for sale online _ eBay.jpg" alt="Introduction to Calculus">
                </div>
                <div class="product-info">
                    <h3>Introduction to Calculus</h3>
                    <p>Used Master mathematics with Introduction to Calculus! Perfect for university students.</p>
                    <div class="price">KES 2,800</div>
                    <button class="add-to-cart" onclick="addToCart('Introduction to Calculus', 2800)">Add to Cart</button>
                </div>
            </div>

            <!-- Product 2 -->
            <div class="product-card">
                <div class="product-img">
                    <img src="images/Cute Aesthetic Notebooks 💗 stationery finds.jpg" alt="Premium Notebook Pack">
                </div>
                <div class="product-info">
                    <h3>Premium Notebook Pack (5pcs)</h3>
                    <p>Keep your studies organized with five quality A5 ruled notebooks.</p>
                    <div class="price">KES 950</div>
                    <button class="add-to-cart" onclick="addToCart('Premium Notebook Pack', 950)">Add to Cart</button>
                </div>
            </div>

            <!-- Product 3 -->
            <div class="product-card">
                <div class="product-img">
                    <img src="images/Love this set_ Please send a dm to order or….jpg" alt="Dorm Bed Sheet Set">
                </div>
                <div class="product-info">
                    <h3>Dorm Bed Sheet Set</h3>
                    <p>Give your hostel room a fresh, cozy look with our soft cotton single-size bedsheet set.</p>
                    <div class="price">KES 1,000</div>
                    <button class="add-to-cart" onclick="addToCart('Dorm Bed Sheet Set', 1000)">Add to Cart</button>
                </div>
            </div>

            <!-- Product 4 -->
            <div class="product-card">
                <div class="product-img">
                    <img src="images/🌸🎧 Petals & Playlists 🎧🤍 Where soft aesthetics meet everyday essentials_ A little floral charm.jpg" alt="Wireless Earbuds">
                </div>
                <div class="product-info">
                    <h3>Wireless Earbuds</h3>
                    <p>Enjoy clear sound, noise cancellation, and long-lasting battery life.</p>
                    <div class="price">KES 1,500</div>
                    <button class="add-to-cart" onclick="addToCart('Wireless Earbuds', 1500)">Add to Cart</button>
                </div>
            </div>

            <!-- Product 5 -->
            <div class="product-card">
                <div class="product-img">
                    <img src="images/Chic & Functional Floor Lamps for Every Space.jpg" alt="Study Desk Lamp">
                </div>
                <div class="product-info">
                    <h3>Study Desk Lamp</h3>
                    <p>Light up your study space! Perfect for reading, revision, and late night assignments.</p>
                    <div class="price">KES 1,450</div>
                    <button class="add-to-cart" onclick="addToCart('Study Desk Lamp', 1450)">Add to Cart</button>
                </div>
            </div>

            <!-- Product 6 -->
            <div class="product-card">
                <div class="product-img">
                    <img src="images/Elegant Black 3D Bow Charger & Cable Protector Set, Aesthetic Tech Decor.jpg" alt="Fast Charger + Cable">
                </div>
                <div class="product-info">
                    <h3>Fast Charger + Cable</h3>
                    <p>Charge your devices quickly and safely. Perfect for everyday campus use!</p>
                    <div class="price">KES 1,100</div>
                    <button class="add-to-cart" onclick="addToCart('Fast Charger + Cable', 1100)">Add to Cart</button>
                </div>
            </div>

            <!-- Product 7 -->
            <div class="product-card">
                <div class="product-img">
                    <img src="images/New Trends_ How the Lg Washer Dryer Combo is Redefining Laundry.jpg" alt="Laundry Bag + Detergent">
                </div>
                <div class="product-info">
                    <h3>Laundry Bag + Detergent</h3>
                    <p>Keep your clothes organized, clean, and fresh. Perfect for hostel living!</p>
                    <div class="price">KES 650</div>
                    <button class="add-to-cart" onclick="addToCart('Laundry Bag + Detergent', 650)">Add to Cart</button>
                </div>
            </div>

        </div>
    </div>

    <footer>
        <p>© 2026 CampusCart Express</p>
        <p style="margin-top:0.5rem; font-size:0.85rem;">
            <a href="backoffice/procurement.html">Back Office</a> (Hidden Link)
        </p>
    </footer>

    <script src="js/cart.js"></script>
</body>
</html>