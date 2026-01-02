<?php
session_start();

// Connect to the database
$pdo = new PDO('mysql:host=localhost;dbname=cii_centre', 'root', '');

// Get the form data
$username = $_POST['username'];
$password = $_POST['password'];

// Check the database for the user
$sql = "SELECT * FROM admins WHERE username = :username";
$stmt = $pdo->prepare($sql);
$stmt->execute(['username' => $username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['last_activity'] = time(); // Set the last activity time
    header("Location: home.php");
    exit();
} else {
    echo "Invalid username or password.";
}
?>

