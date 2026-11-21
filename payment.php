
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | CampusCart Express</title>
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
        <h2 class="section-title">Checkout & Payment</h2>

        <div class="form-container">
            <h3 style="margin-bottom: 1.5rem; color: var(--primary);">Your Order Summary</h3>
            
            <div id="cart-items" style="margin-bottom: 1.5rem; padding: 1rem; background: #f8fafc; border-radius: 8px;">
                <p style="color: #64748b;">Your cart is currently empty. Go to the Shop and add some items.</p>
            </div>

            <div style="display: flex; justify-content: space-between; font-size: 1.2rem; font-weight: 700; margin-bottom: 2rem;">
                <span>Total:</span>
                <span id="cart-total">KES 0</span>
            </div>

            <hr style="margin-bottom: 2rem; border: none; border-top: 1px solid #e2e8f0;">

            <h3 style="margin-bottom: 1.5rem; color: var(--primary);">Payment Details</h3>

            <form onsubmit="event.preventDefault(); alert('Thank you! This is a prototype. In a real system this would process payment via M-Pesa / Card.');">
                
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" placeholder="Angela Jeptoo" required>
                </div>

                <div class="form-group">
                    <label>Phone Number (M-Pesa)</label>
                    <input type="tel" placeholder="07XX XXX XXX" required>
                </div>

                <div class="form-group">
                    <label>Delivery Location (Campus / Hostel)</label>
                    <input type="text" placeholder="e.g. Hall 3, Room 12 or Gate A" required>
                </div>

                <div class="form-group">
                    <label>Payment Method</label>
                    <select required>
                        <option value="">Select payment method</option>
                        <option value="mpesa">M-Pesa</option>
                        <option value="card">Credit / Debit Card</option>
                        <option value="cash">Cash on Delivery</option>
                    </select>
                </div>

                <button type="submit" class="btn" style="width: 100%; text-align: center; border: none; cursor: pointer;">
                    Complete Order
                </button>
            </form>
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
