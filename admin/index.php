<?php
session_start();
require 'connection.php';

// If already logged in
if (isset($_SESSION['admin_username'])) {
    header("Location: home.php");
    exit;
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM admins WHERE username=? LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $admin = $result->fetch_assoc();

        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin_username'] = $admin['username'];
            $_SESSION['last_activity'] = time();

            header("Location: home.php");
            exit;
        }
    }

    $error = "Invalid username or password";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <style>
    * {
        box-sizing: border-box;
        font-family: 'Segoe UI', Arial, sans-serif;
    }

    body {
        margin: 0;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: linear-gradient(135deg, #c3ec52, #0ba29d);
    }

    .box {
        background: #ffffff;
        padding: 30px 28px;
        width: 360px;
        border-radius: 10px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        animation: fadeIn 0.8s ease;
    }

    h2 {
        margin-bottom: 20px;
        text-align: center;
        color: #003366;
    }

    input {
        width: 100%;
        padding: 12px;
        margin-top: 12px;
        border-radius: 6px;
        border: 1px solid #ccc;
        font-size: 15px;
        transition: border 0.3s, box-shadow 0.3s;
    }

    input:focus {
        outline: none;
        border-color: #0ba29d;
        box-shadow: 0 0 0 3px rgba(11, 162, 157, 0.15);
    }

    button {
        width: 100%;
        margin-top: 18px;
        padding: 12px;
        border-radius: 6px;
        border: none;
        background: linear-gradient(135deg, #28a745, #218838);
        color: #fff;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    button:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    .error {
        background: #ffe5e5;
        color: #cc0000;
        padding: 8px;
        margin-bottom: 12px;
        border-radius: 5px;
        text-align: center;
        font-size: 14px;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(15px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 420px) {
        .box {
            width: 90%;
        }
    }
</style>

</head>
<body>

<div class="box">
    <h2>Admin Login</h2>
    <?php if($error): ?><div class="error"><?= $error ?></div><?php endif; ?>

    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>
