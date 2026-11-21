<?php
session_start();
require_once 'database/connection.php';

$message = "";
$error = "";
$reset_link = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);

    if (empty($email)) {
        $error = "Please enter your email address.";
    } else {
        $stmt = $conn->prepare("SELECT id, full_name FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Generate secure token
            $token = bin2hex(random_bytes(32));
            $expiry = date("Y-m-d H:i:s", strtotime("+1 hour"));

            // Save token
            $stmt = $conn->prepare("UPDATE users SET reset_token = ?, token_expiry = ? WHERE email = ?");
            $stmt->execute([$token, $expiry, $email]);

            // Create reset link (for local testing we show it)
            $reset_link = "http://localhost/CampusCart-Express/reset-password.php?token=" . $token;

            $message = "A password reset link has been generated. (In a real system this would be sent to your email)";
        } else {
            $error = "No account found with that email address.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | CampusCart Express</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .auth-container {
            max-width: 450px;
            margin: 70px auto;
            padding: 35px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }
        .auth-container h2 {
            text-align: center;
            margin-bottom: 8px;
        }
        .auth-container p.subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 25px;
        }
        .form-group {
            margin-bottom: 18px;
        }
        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: 500;
        }
        .form-group input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
        }
        .btn-auth {
            width: 100%;
            padding: 13px;
            background: #4f46e5;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
        }
        .btn-auth:hover {
            background: #4338ca;
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
        .reset-link-box {
            background: #f0f9ff;
            border: 1px solid #bae6fd;
            padding: 15px;
            border-radius: 8px;
            margin-top: 15px;
            word-break: break-all;
            font-size: 0.9rem;
        }
        .auth-footer {
            text-align: center;
            margin-top: 22px;
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
    <li><a href="login.php">Login</a></li>
</ul>
    </nav>

    <div class="auth-container">
        <h2>Forgot Password</h2>
        <p class="subtitle">Enter your email to reset your password</p>

        <?php if ($error): ?>
            <div class="error-msg"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if ($message): ?>
            <div class="success-msg"><?php echo $message; ?></div>
            <?php if ($reset_link): ?>
                <div class="reset-link-box">
                    <strong>Reset Link (for testing):</strong><br>
                    <a href="<?php echo $reset_link; ?>"><?php echo $reset_link; ?></a>
                </div>
            <?php endif; ?>
        <?php else: ?>

        <form method="POST" action="">
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" required placeholder="Enter your registered email">
            </div>
            <button type="submit" class="btn-auth">Generate Reset Link</button>
        </form>

        <?php endif; ?>

        <div class="auth-footer">
            <a href="login.php">← Back to Login</a>
        </div>
    </div>

</body>
</html>