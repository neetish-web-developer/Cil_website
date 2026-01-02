<?php
require 'admin/connection.php';
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = mysqli_query($conn, "SELECT * FROM notice WHERE id = $id");
    $announcement = mysqli_fetch_assoc($result);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcement Details</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <!-- Add your header content here -->
    </header>
    <main>
        <div class="announcement-container">
            <?php if ($announcement) : ?>
                <h1><?php echo $announcement['title']; ?></h1>
                <p><?php echo $announcement['details']; ?></p>
            <?php else : ?>
                <p>Announcement not found.</p>
            <?php endif; ?>
        </div>
    </main>
    <footer>
        <!-- Add your footer content here -->
    </footer>
</body>
</html>
