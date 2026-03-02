<?php
include 'includes/db_connect.php';
session_start();

if (isset($_POST['signup'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $pass = $conn->real_escape_string($_POST['pass']);

    // Organic Reach: Check if email already exists
    $checkEmail = $conn->query("SELECT id FROM users WHERE email='$email'");
    if ($checkEmail->num_rows > 0) {
        $error = "This email is already registered!";
    } else {
        $sql = "INSERT INTO users (full_name, email, phone, password) VALUES ('$name', '$email', '$phone', '$pass')";
        if ($conn->query($sql)) {
            echo "<script>alert('Welcome to the Club!'); window.location.href='login-user.php';</script>";
        } else {
            $error = "Registration failed. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join the Club | Makhana Munch Signup</title>
    <meta name="description" content="Join Makhana Munch today for the healthiest and crunchiest snacks in India.">
    <link rel="stylesheet" href="assets/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        .auth-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: radial-gradient(circle at center, #1a1a1a 0%, #000 100%);
            padding: 20px;
        }

        .auth-card {
            background: rgba(17, 17, 17, 0.9);
            padding: 40px;
            border-radius: 30px;
            border: 1px solid #333;
            width: 100%;
            max-width: 450px;
            text-align: center;
            backdrop-filter: blur(10px);
        }

        .auth-card h2 {
            font-family: 'Fredoka One';
            color: #fff;
            font-size: 2.2rem;
            margin-bottom: 10px;
        }

        .auth-card h2 span {
            color: #FFD700;
        }

        .auth-card p {
            color: #888;
            margin-bottom: 25px;
            font-size: 0.9rem;
        }

        .auth-form input {
            width: 100%;
            padding: 16px;
            margin-bottom: 15px;
            background: #1a1a1a;
            border: 1px solid #333;
            color: #fff;
            border-radius: 12px;
            font-family: 'Poppins';
            transition: 0.3s;
        }

        .auth-form input:focus {
            border-color: #FFD700;
            outline: none;
            background: #222;
        }

        .auth-btn {
            width: 100%;
            padding: 16px;
            background: #FFD700;
            color: #000;
            border: none;
            font-weight: 800;
            border-radius: 50px;
            cursor: pointer;
            transition: 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .auth-btn:hover {
            background: #fff;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(255, 215, 0, 0.2);
        }

        .auth-link {
            color: #666;
            margin-top: 25px;
            display: block;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .auth-link span {
            color: #FFD700;
            font-weight: 600;
        }

        @media (max-width: 480px) {
            .auth-card {
                padding: 30px 20px;
            }
        }
    </style>
</head>

<body>
    <?php include 'includes/header.php'; ?>
    <div class="auth-wrapper">
        <div class="auth-card" data-aos="fade-up">
            <h2>SIGN <span>UP</span></h2>
            <p>Start your healthy snacking journey.</p>
            <?php if (isset($error)): ?>
                <div style="background: rgba(255,0,0,0.1); color: #ff4d4d; padding: 10px; border-radius: 10px; margin-bottom: 20px; font-size: 0.85rem;">⚠️ <?php echo $error; ?></div>
            <?php endif; ?>
            <form method="POST" class="auth-form">
                <input type="text" name="name" placeholder="Full Name" required>
                <input type="email" name="email" placeholder="Email Address" required>
                <input type="tel" name="phone" placeholder="Phone Number" required>
                <input type="password" name="pass" placeholder="Create Password" required>
                <button type="submit" name="signup" class="auth-btn">CREATE ACCOUNT</button>
            </form>
            <a href="login-user.php" class="auth-link">Already a member? <span>Login here</span></a>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>