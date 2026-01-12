<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 🔒 Redirect to login if admin not authenticated
if (!isset($_SESSION['admin_username'])) {
    header("Location: index.php");
    exit();
}

// ⏳ Auto-logout after 5 minutes of inactivity
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 300)) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}

// Update last activity timestamp
$_SESSION['last_activity'] = time();

$loggedAdmin = $_SESSION['admin_username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="navbar">
    <span style="color:yellow;">
     Welcome : <strong><?= htmlspecialchars($loggedAdmin) ?></strong>
    </span>
    <a href="home.php">Home</a>
    <a href="about.php">About</a>
    <a href="events.php">Events</a>
    <a href="portfolio.php">Portfolio</a>
    <a href="contact_us.php">Contact Us</a>
    <a href="incubation.php">Incubation App</a>
    <a href="announcement.php">Announcements</a>
    <a href="team.php">Team Members</a>
    <a href="newsletter.php">Newsletter</a>
    <a href="create_admin.php">Manage Admin</a>
    
    <a href="logout.php" class="logout-btn">Logout</a>
</div>
