<?php
session_start();
if (isset($_POST['login'])) {
    $username = $_POST['user'];
    $password = $_POST['pass'];

    // Aap apna man-pasand username aur password yahan set karein
    if ($username == "admin" && $password == "munch123") {
        $_SESSION['admin_logged_in'] = true;
        header("Location: ../admin/admin.php");
    } else {
        $error = "Ghalat details! Dobara koshish karein.";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Admin Login | Makhana Munch</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        body {
            background: #000;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
            font-family: 'Poppins';
        }

        .login-box {
            background: #111;
            padding: 40px;
            border-radius: 20px;
            border: 1px solid #FFD700;
            width: 350px;
            text-align: center;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            background: #222;
            border: 1px solid #444;
            color: #fff;
            border-radius: 8px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #FFD700;
            border: none;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="login-box">
        <h2 style="font-family: 'Fredoka One'; color: #FFD700;">ADMIN <span>LOGIN</span></h2>
        <?php if (isset($error)) echo "<p style='color:red; font-size:0.8rem;'>$error</p>"; ?>
        <form method="POST">
            <input type="text" name="user" placeholder="Username" required>
            <input type="password" name="pass" placeholder="Password" required>
            <button type="submit" name="login">ENTER DASHBOARD</button>
        </form>
    </div>
</body>

</html>