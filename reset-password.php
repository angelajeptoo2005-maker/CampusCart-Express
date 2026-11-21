<?php
session_start();
require_once 'database/connection.php';

$error = "";
$success = "";
$user = null;
$token = $_GET['token'] ?? '';

if (empty($token)) {
    $error = "Invalid or missing reset token.";
} else {
    // Check if token is valid and not expired
    $stmt = $conn->prepare("SELECT id, email FROM users WHERE reset_token = ? AND token_expiry > datetime('now')");
    $stmt->execute([$token]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        $error = "This reset link is invalid or has expired.";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $user) {
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($password) || empty($confirm_password)) {
        $error = "Please fill in both password fields.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters.";
    } else {
        $hashed = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL, token_expiry = NULL WHERE id = ?");
        if ($stmt->execute([$hashed, $user['id']])) {
            $success = "Password updated successfully! You can now <a href='login.php'>Login</a>.";
        } else {
            $error = "Something went wrong. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | CampusCart Express</title>
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
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="logo">Campus<span>Cart</span> Express</div>
    </nav>

    <div class="auth-container">
        <h2>Reset Password</h2>

        <?php if ($error): ?>
            <div class="error-msg"><?php echo $error; ?></div>
            <p style="text-align:center;"><a href="forgot-password.php">Request a new link</a></p>
        <?php elseif ($success): ?>
            <div class="success-msg"><?php echo $success; ?></div>
        <?php else: ?>

        <form method="POST" action="">
            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="password" required placeholder="At least 6 characters">
            </div>
            <div class="form-group">
                <label>Confirm New Password</label>
                <input type="password" name="confirm_password" required placeholder="Repeat new password">
            </div>
            <button type="submit" class="btn-auth">Update Password</button>
        </form>

        <?php endif; ?>
    </div>

</body>
</html>