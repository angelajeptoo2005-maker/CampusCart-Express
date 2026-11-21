<?php
session_start();
require_once 'database/connection.php';

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validation
    if (empty($full_name) || empty($email) || empty($password) || empty($confirm_password)) {
        $error = "Please fill in all required fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters.";
    } else {
        // Check if email already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->fetch()) {
            $error = "This email is already registered.";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert new user
            $stmt = $conn->prepare("INSERT INTO users (full_name, email, phone, password) VALUES (?, ?, ?, ?)");
            
            if ($stmt->execute([$full_name, $email, $phone, $hashed_password])) {
                $success = "Registration successful! You can now <a href='login.php'>Login</a>.";
            } else {
                $error = "Something went wrong. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | CampusCart Express</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .auth-container {
            max-width: 450px;
            margin: 60px auto;
            padding: 30px;
            background: #550942;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }
        .auth-container h2 {
            text-align: center;
            margin-bottom: 10px;
            color: #1a1a1a;
        }
        .auth-container p.subtitle {
            text-align: center;
            color: #20bb1a;
            margin-bottom: 25px;
            font-size: 0.95rem;
        }
        .form-group {
            margin-bottom: 18px;
        }
        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: 500;
            color: #19256d;
        }
        .form-group input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: border 0.2s;
        }
        .form-group input:focus {
            outline: none;
            border-color: #4f46e5;
        }
        .btn-auth {
            width: 100%;
            padding: 13px;
            background: #0f8815;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
        }
        .btn-auth:hover {
            background: #5c0d4f;
        }
        .error-msg {
            background: #fee2e2;
            color: #b91c1c;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }
        .success-msg {
            background: #dcfce7;
            color: #166534;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }
        .auth-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.95rem;
        }
        .auth-footer a {
            color: #4f46e5;
            text-decoration: none;
            font-weight: 500;
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="logo">Campus<span>Cart</span> Express</div>
        <ul class="nav-links">
    <li><a href="index.php">Home</a></li>
    <li><a href="shop.php">Shop</a></li>
    <li><a href="marketing.php">Deals</a></li>
    <li><a href="support.php">Support</a></li>
</ul>
        <a href="login.php" class="cart-btn">Login</a>
    </nav>

    <div class="auth-container">
        <h2>Create Account</h2>
        <p class="subtitle">Join CampusCart Express – Student essentials delivered fast</p>

        <?php if ($error): ?>
            <div class="error-msg"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="success-msg"><?php echo $success; ?></div>
        <?php else: ?>

        <form method="POST" action="">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="full_name" required placeholder="e.g. Angela Jeptoo">
            </div>

            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" required placeholder="e.g. angelajeptoo@kabarak.ac.ke">
            </div>

            <div class="form-group">
                <label>Phone Number (Optional)</label>
                <input type="text" name="phone" placeholder="e.g. 0727917401">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required placeholder="At least 6 characters">
            </div>

            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" required placeholder="Repeat password">
            </div>

            <button type="submit" class="btn-auth">Register</button>
        </form>

        <?php endif; ?>

        <div class="auth-footer">
            Already have an account? <a href="login.php">Login here</a>
        </div>
    </div>

    <footer>
        <p>© 2026 CampusCart Express</p>
    </footer>

</body>
</html>