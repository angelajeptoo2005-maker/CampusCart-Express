
<?php
session_start();
require_once 'database/connection.php';

$error = "";

// If already logged in, go to homepage
if (isset($_SESSION['user_id'])) {
    header("Location: home.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $error = "Please enter both email and password.";
    } else {

        $stmt = $conn->prepare(
            "SELECT id, full_name, email, password FROM users WHERE email = ?"
        );

        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['email'] = $user['email'];

            header("Location: home.php");
            exit();

        } else {
            $error = "Invalid email or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login | CampusCart Express</title>

<link rel="stylesheet" href="css/style.css">

<!-- Font Awesome Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    min-height: 100vh;
    background:
        linear-gradient(rgba(20, 10, 15, 0.30),
                        rgba(20, 10, 15, 0.45)),
       url('images/Campus Shopping Cart Essentials.png');

    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    color: #fff;
}

.login-page {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    padding: 35px 6%;
}

.top-section {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 35px;
}

.brand {
    color: #850d32;
    font-size: 38px;
    font-weight: 800;
    text-shadow: 0 2px 5px rgba(255,255,255,0.4);
}

.brand span {
    font-style: italic;
    font-family: Georgia, serif;
}

.store-label {
    background: #850d32;
    padding: 14px 28px;
    border-radius: 30px;
    font-weight: bold;
}

.main-content {
    flex: 1;
    display: grid;
    grid-template-columns: 1fr 1fr;
    align-items: center;
    gap: 45px;
}

.welcome-section {
    max-width: 550px;
}

.welcome-section h1 {
    font-size: 45px;
    margin-bottom: 18px;
}

.welcome-section p {
    font-size: 23px;
    line-height: 1.5;
    margin-bottom: 35px;
}

/* Updated Benefits Section */

.benefits {
    display: grid;
    gap: 22px;
}

.benefit {
    display: flex;
    align-items: center;
    gap: 16px;
    font-size: 18px;
    font-weight: bold;
}

.benefit-icon {
    font-size: 22px;
    color: #ffffff;
    width: 42px;
    height: 42px;
    background: #850d32;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.benefit-text {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.benefit-text strong {
    font-size: 17px;
}

.benefit-text small {
    font-size: 13px;
    font-weight: normal;
    color: rgba(255,255,255,0.9);
}

/* Login Form */

.auth-container {
    width: 100%;
    max-width: 530px;
    margin: auto;
    padding: 40px;
    background: rgba(255,255,255,0.82);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    border: 1px solid rgba(255,255,255,0.7);
    border-radius: 25px;
    box-shadow: 0 10px 35px rgba(0,0,0,0.2);
    color: #263244;
}

.auth-container h2 {
    text-align: center;
    font-size: 48px;
    color: #850d32;
    margin-bottom: 8px;
}

.subtitle {
    text-align: center;
    font-size: 18px;
    margin-bottom: 28px;
}

.title-line {
    width: 95px;
    height: 3px;
    background: #850d32;
    margin: 0 auto 30px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group input {
    width: 100%;
    padding: 18px;
    border: 1px solid #d1d5db;
    border-radius: 15px;
    background: rgba(255,255,255,0.95);
    font-size: 17px;
    color: #263244;
}

.form-group input:focus {
    outline: none;
    border-color: #850d32;
    box-shadow: 0 0 0 3px rgba(133,13,50,0.12);
}

.form-options {
    display: flex;
    justify-content: flex-end;
    margin: 12px 0 25px;
}

.forgot-link {
    color: #850d32;
    font-weight: bold;
    text-decoration: underline;
}

.btn-auth {
    width: 100%;
    padding: 17px;
    background: #850d32;
    color: white;
    border: none;
    border-radius: 12px;
    font-size: 19px;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
}

.btn-auth:hover {
    background: #600a26;
}

.error-msg {
    background: #fee2e2;
    color: #b91c1c;
    padding: 13px;
    border-radius: 10px;
    text-align: center;
    margin-bottom: 20px;
}

.auth-footer {
    text-align: center;
    margin-top: 28px;
    font-size: 15px;
}

.auth-footer a {
    color: #850d32;
    font-weight: bold;
    margin-left: 8px;
}

.footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 35px;
    padding: 20px 25px;
    border-radius: 50px 50px 0 0;
    background: #850d32;
}

.footer strong {
    font-family: Georgia, serif;
    font-size: 23px;
    font-style: italic;
}

.footer p {
    margin-top: 8px;
}

@media(max-width: 850px) {

    .login-page {
        padding: 25px 5%;
    }

    .main-content {
        grid-template-columns: 1fr;
        gap: 30px;
    }

    .welcome-section {
        text-align: center;
        margin: auto;
    }

    .welcome-section h1 {
        font-size: 32px;
    }

    .welcome-section p {
        font-size: 18px;
    }

    .benefits {
        display: none;
    }

    .auth-container {
        max-width: 500px;
        padding: 30px 22px;
    }

    .brand {
        font-size: 25px;
    }

    .store-label {
        display: none;
    }

    .footer {
        border-radius: 20px;
        text-align: center;
        justify-content: center;
    }
}

</style>
</head>

<body>

<div class="login-page">

    <div class="top-section">

        <div class="brand">
            CampusCart <span>Express</span>
        </div>

        <div class="store-label">
            Your One-Stop Campus Store
        </div>

    </div>

    <div class="main-content">

        <div class="welcome-section">

            <h1>Welcome Back!</h1>

            <p>
                Login to continue shopping
                and accessing your account.
            </p>

            <div class="benefits">

                <div class="benefit">
                    <span class="benefit-icon">
                        <i class="fas fa-truck-fast"></i>
                    </span>
                    <div class="benefit-text">
                        <strong>Fast Campus Delivery</strong>
                        <small>Your essentials delivered right to campus.</small>
                    </div>
                </div>

                <div class="benefit">
                    <span class="benefit-icon">
                        <i class="fas fa-tags"></i>
                    </span>
                    <div class="benefit-text">
                        <strong>Affordable Student Prices</strong>
                        <small>Everyday essentials at student-friendly prices.</small>
                    </div>
                </div>

                <div class="benefit">
                    <span class="benefit-icon">
                        <i class="fas fa-lock"></i>
                    </span>
                    <div class="benefit-text">
                        <strong>Secure Shopping</strong>
                        <small>Shop with confidence and peace of mind.</small>
                    </div>
                </div>

            </div>

        </div>

        <div class="auth-container">

            <h2>Login</h2>

            <p class="subtitle">Access your account</p>

            <div class="title-line"></div>

            <?php if ($error): ?>
                <div class="error-msg">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="">

                <div class="form-group">
                    <input
                        type="email"
                        name="email"
                        placeholder="Email Address"
                        required
                    >
                </div>

                <div class="form-group">
                    <input
                        type="password"
                        name="password"
                        placeholder="Password"
                        required
                    >
                </div>

                <div class="form-options">
                    <a href="forgot-password.php" class="forgot-link">
                        Forgot Password?
                    </a>
                </div>

                <button type="submit" class="btn-auth">
                    Login &nbsp; →
                </button>

            </form>

            <div class="auth-footer">
                Don't have an account?

                <a href="register.php">
                    Register Here
                </a>
            </div>

        </div>

    </div>

    <div class="footer">

        <div>
            <strong>CampusCart Express</strong>
            <p>Smart Shopping, Smarter Living!</p>
        </div>

    </div>

</div>

</body>
</html>
