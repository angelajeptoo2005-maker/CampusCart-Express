<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusCart Express | Student Essentials Marketplace</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

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

            <a href="logout.php" class="cart-btn" style="background: #ef4444;">
                Logout
            </a>

        <?php else: ?>

            <a href="login.php" class="cart-btn">Login</a>

        <?php endif; ?>

        <a href="payment.php" class="cart-btn">
            Cart <span id="cart-count">0</span>
        </a>

    </div>
</nav>    
    <!-- Hero Section -->
    <section class="hero">
        <h1>Everything a Student Needs</h1>
        <p>Affordable textbooks, stationery, dorm essentials & tech accessories delivered straight to your campus hostel or lecture hall.</p>
        <a href="shop.php" class="btn">Start Shopping →</a>
    </section>

    <!-- Categories Section -->
    <div class="container">
        <h2 class="section-title">Shop by Category</h2>
        <p class="section-subtitle">Carefully selected products for university life</p>

        <div class="products">
            <div class="product-card">
                <div class="product-img">
    <img src="images/Big Fat Notebook series ✨.jpg" alt="Textbooks and Notes">
</div>
                <div class="product-info">
                    <h3>Textbooks & Notes</h3>
                    <p>Find affordable textbooks, revision notes
and study materials to support your academic journey throughout the semester without strething your budget.</p>
                    <a href="shop.php" class="btn" style="margin-top: 1rem; display: inline-block; font-size: 0.9rem; padding: 0.7rem 1.5rem;">Browse Books</a>
                </div>
            </div>

            <div class="product-card">
                <div class="product-img">
                    <img src="images/KissMark__ Jaeyong ⚠️🔞.jpg" alt="Stationery Packs">
                </div>
                <div class="product-info">
                    <h3>Stationery Packs</h3>
                    <p>Stay organized for every class with our affordable stationery packs. From pens and pencils to other essential learning materials, avilable for lectures. </p>
                    <a href="shop.php" class="btn" style="margin-top: 1rem; display: inline-block; font-size: 0.9rem; padding: 0.7rem 1.5rem;">Browse Stationery</a>
                </div>
            </div>

            <div class="product-card">
                <div class="product-img">
                    <img src="images/840836192978445327.jpg" alt="Dorm Essentials">
                </div>
                <div class="product-info">
                    <h3>Dorm Essentials</h3>
                    <p>Everything you need to make your hostel feel like home, from storage organizers to detergents and everyday cleaning supplies!</p>
                    <a href="shop.php" class="btn" style="margin-top: 1rem; display: inline-block; font-size: 0.9rem; padding: 0.7rem 1.5rem;">Browse Dorm</a>
                </div>
            </div>

            <div class="product-card">
                <div class="product-img">
                  <img src="images/927882329513925270.jpg" alt="Tech Accessories">
                  <img src="images/Table Lamp.jpg" alt="lamps">
                </div>
                <div class="product-info">
                    <h3>Tech Accessories</h3>
                    <p>Stay connected and productive with our range of essential campus gadgets.Quality earphones to stylish study lamps and everyday tech accessories.</p>
                    <a href="shop.php" class="btn" style="margin-top: 1rem; display: inline-block; font-size: 0.9rem; padding: 0.7rem 1.5rem;">Browse Tech</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Why Choose Us -->
<div style="background: rgb(165, 26, 146); padding: 4rem 5%;">
    <div class="container" style="padding: 0;">
        <h2 class="section-title">Why Students Choose Us</h2>
        <div class="products" style="margin-top: 2.5rem;">

            <div style="text-align: center; padding: 1.5rem;">
                <img src="images/667166132347097740.jpg" alt="Fast Campus Delivery"
                     style="width: 100%; max-width: 250px; height: 180px; object-fit: cover; border-radius: 12px; margin-bottom: 1rem;">
                <h3 style="margin-bottom: 0.5rem;">Fast Campus Delivery</h3>
                <p style="color: #64748b;">Same-day or next-day delivery to your hostel or lecture hall.</p>
            </div>

            <div style="text-align: center; padding: 1.5rem;">
                <img src="images/download.jpg" alt="Affordable Student Prices"
                     style="width: 100%; max-width: 250px; height: 180px; object-fit: cover; border-radius: 12px; margin-bottom: 1rem;">
                <h3 style="margin-bottom: 0.5rem;">Student Prices</h3>
                <p style="color: #64748b;">Affordable pricing designed specifically for university students.</p>
            </div>

            <div style="text-align: center; padding: 1.5rem;">
                <img src="images/Simplify Payments for Your Customers_M-Pesa….jpg" alt="Secure Payments"
                     style="width: 100%; max-width: 250px; height: 180px; object-fit: cover; border-radius: 12px; margin-bottom: 1rem;">
                <h3 style="margin-bottom: 0.5rem;">Secure Payments</h3>
                <p style="color: #64808b;">Pay easily with M-Pesa, card, or cash on delivery.</p>
            </div>

        </div>
    </div>
</div>