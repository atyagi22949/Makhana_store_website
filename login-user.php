<?php
include 'includes/db_connect.php';
session_start();

if (isset($_POST['login'])) {
    $email = $conn->real_escape_string($_POST['email']);
    $pass = $_POST['pass'];

    $result = $conn->query("SELECT * FROM users WHERE email='$email'");

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if ($pass == $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['full_name'];
            header("Location: index.php");
            exit();
        } else {
            $error = "Incorrect password. Please try again.";
        }
    } else {
        $error = "No account found with this email.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Welcome Back to Makhana Munch</title>
    <meta name="description" content="Login to your Makhana Munch account to track orders and explore new flavors.">
    <link rel="stylesheet" href="assets/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #000;
            padding: 20px;
        }

        .login-card {
            background: #111;
            padding: 50px 40px;
            border-radius: 30px;
            border: 1px solid #222;
            width: 100%;
            max-width: 420px;
            text-align: center;
            position: relative;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, #FFD700, transparent, #FFD700);
            border-radius: 32px;
            z-index: -1;
            opacity: 0.3;
        }

        .login-card h2 {
            font-family: 'Fredoka One';
            color: #fff;
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .login-card h2 span {
            color: #FFD700;
        }

        .login-card p {
            color: #666;
            margin-bottom: 35px;
            font-size: 0.95rem;
        }

        .input-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .input-group label {
            display: block;
            color: #aaa;
            margin-bottom: 8px;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
        }

        .input-group input {
            width: 100%;
            padding: 16px;
            background: #1a1a1a;
            border: 1px solid #333;
            border-radius: 12px;
            color: #fff;
            font-family: 'Poppins';
            transition: 0.3s;
        }

        .input-group input:focus {
            border-color: #FFD700;
            outline: none;
            background: #222;
            box-shadow: 0 0 15px rgba(255, 215, 0, 0.1);
        }

        .login-btn {
            width: 100%;
            padding: 18px;
            background: #FFD700;
            color: #000;
            border: none;
            border-radius: 50px;
            font-weight: 800;
            font-size: 1rem;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            transition: 0.4s;
        }

        .login-btn:hover {
            background: #fff;
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.4);
        }

        .error-msg {
            background: rgba(255, 77, 77, 0.1);
            color: #ff4d4d;
            padding: 14px;
            border-radius: 12px;
            margin-bottom: 25px;
            font-size: 0.85rem;
            border-left: 4px solid #ff4d4d;
        }

        .footer-links {
            margin-top: 30px;
            color: #555;
            font-size: 0.9rem;
        }

        .footer-links a {
            color: #FFD700;
            text-decoration: none;
            font-weight: 700;
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 40px 25px;
            }
        }
    </style>
</head>

<body>
    <?php include 'includes/header.php'; ?>
    <div class="login-wrapper">
        <div class="login-card" data-aos="zoom-in">
            <h2>LOG <span>IN</span></h2>
            <p>Enter your details to start munching.</p>

            <?php if (isset($error)): ?>
                <div class="error-msg">⚠️ <?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="input-group">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="input-group">
                    <label>Password</label>
                    <input type="password" name="pass" placeholder="••••••••" required>
                </div>
                <button type="submit" name="login" class="login-btn">LET'S CRUNCH</button>
            </form>

            <div class="footer-links">
                New to the club? <a href="signup.php">Join the Club</a>
            </div>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>

</html>