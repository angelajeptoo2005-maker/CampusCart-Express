
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Support | CampusCart Express</title>
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

        <div>
            <?php if (isset($_SESSION['user_id'])): ?>
                <span>Hi, <?php echo htmlspecialchars($_SESSION['full_name']); ?></span>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
            <?php endif; ?>

            <a href="payment.php" class="cart-btn">
                Cart <span id="cart-count">0</span>
            </a>
        </div>
    </nav>

    <div class="container">
        <h2 class="section-title">Customer Support</h2>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; max-width: 1000px; margin: 0 auto;">

            <!-- Contact Form -->
            <div class="form-container">
                <h3 style="margin-bottom: 1.5rem; color: var(--primary);">Send us a Message</h3>

                <form onsubmit="event.preventDefault(); alert('Thank you! Your message has been received. (This is a prototype)');">
                    <div class="form-group">
                        <label>Your Name</label>
                        <input type="text" placeholder="Full name" required>
                    </div>

                    <div class="form-group">
                        <label>University Email</label>
                        <input type="email" placeholder="you@university.ac.ke" required>
                    </div>

                    <div class="form-group">
                        <label>Subject</label>
                        <select required>
                            <option value="">Select a topic</option>
                            <option>Order Status</option>
                            <option>Payment Issue</option>
                            <option>Delivery Problem</option>
                            <option>Product Inquiry</option>
                            <option>Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Message</label>
                        <textarea rows="5" placeholder="How can we help you?" required></textarea>
                    </div>

                    <button type="submit" class="btn" style="width: 100%; text-align: center; border: none; cursor: pointer;">
                        Send Message
                    </button>
                </form>
            </div>

            <!-- Support Info -->
            <div style="background: white; padding: 2.5rem; border-radius: 16px; box-shadow: 0 4px 15px rgba(0,0,0,0.08);">
                <h3 style="margin-bottom: 1.5rem; color: var(--primary);">How to Reach Us</h3>

                <p style="margin-bottom: 1.2rem;"><strong>📧 Email:</strong><br>support@campuscartexpress.com</p>
                <p style="margin-bottom: 1.2rem;"><strong>📱 WhatsApp / Call:</strong><br>+254727917401</p>
                <p style="margin-bottom: 1.2rem;"><strong>🕒 Working Hours:</strong><br>Mon – Sat: 8:00 AM – 8:00 PM</p>
                <p style="margin-bottom: 2rem;"><strong>📍 Pickup Point:</strong><br>Main Campus Gate / Student Centre</p>

                <h4 style="margin-bottom: 1rem; color: var(--primary);">Frequently Asked Questions</h4>
                <ul style="padding-left: 1.2rem; color: #64748b; line-height: 1.8;">
                    <li>How long does campus delivery take?</li>
                    <li>Can I return a product?</li>
                    <li>Do you accept M-Pesa?</li>
                    <li>How do I track my order?</li>
                </ul>
            </div>

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
