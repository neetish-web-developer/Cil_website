<?php
require 'admin/connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CIL Innovation & Incubation Centre | Dhanbad</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/contact_style.css">
    <link rel="stylesheet" href="css/events_card.css">
    <link rel="stylesheet" href="stylenav.css">
    <script src="script.js" defer></script>
</head>

<body>
    <header>
        <a href="index.php" class="logo">
            <i class="ri-home-heart-fill"></i>
            <span><img src="Logo.jpeg" alt="CIL Innovation & Incubation Centre"></span>
        </a>
        <div class="menu-toggle" id="menu-icon">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
        <nav class="navbar">
            <ul>
                <li><a href="index.php" >Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="incubation.php">Incubation Programs</a></li>
                <li><a href="events.php" class="active">Events</a></li>
                <li><a href="portfolio.php">Portfolio</a></li>
                <li><a href="team.php">Our Team</a></li>
                <li><a href="newsletter.php">Newsletters</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>

    <div align="center">
        <div class="event_body">
            <?php
            // Updated SQL query to order by ID descending (Latest first)
            // If you have a 'created_at' column, you can use: ORDER BY created_at DESC
            $sql = "SELECT title, description, image FROM events ORDER BY id DESC";
            $result = mysqli_query($conn, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="event_card">';
                    echo '<img src="admin/img/events/' . $row['image'] . '" class="event_card-img" alt="">';
                    echo '<div class="event_card_body">';
                    echo '<h1 class="event_card_title">' . $row['title'] . '</h1>';
                    echo '<p class="event_card_info">' . $row['description'] . '</p>';
                    echo '<button onclick="openImage(\'' . $row['image'] . '\')" class="event_card_btn">Open Image</button>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "No events found";
            }

            mysqli_close($conn);
            ?>
        </div>
    </div>

    <script>
        function openImage(imageUrl) {
            window.open('admin/img/events/' + imageUrl, '_blank');
        }
    </script>
    <footer class="footer">
        <div class="container">
            <div class="footer-columns">
                <div class="footer-column">
                    <h3>About Us</h3>
                    <p>Indian Institute of Technology (Indian School of Mines) Dhanbad establishes Coal India Innovation
                        Centre (CII), providing an enabling environment for young innovators to shape their ideas. It
                        contributes to youth development and societal growth.</p>
                </div>
                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <ul class="quick-links">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about.php">About</a></li>
                        <li><a href="incubation.php">Incubation Programs</a></li>
                        <li><a href="portfolio.php">Portfolio</a></li>
                        <li><a href="team.php">Our Team</a></li>
                        <li><a href="newsletter.php">Newsletters</a></li>
                        <li><a href="contact.php" class="active">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Contact Us</h3>
                    <ul class="contact-info">
                        <li><i class="fas fa-map-marker-alt"></i>4<sup>th </sup>Floor, i2h Building, IIT (ISM),</li>
                        <li> Dhanbad, Jharkhand ,India</li>
                        <li><i class="fas fa-envelope"></i> cii@iitism.ac.in</li>
                        <li><i class="fas fa-phone"></i> +91 6299255860</li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script src="scriptnav.js"></script>
</body>
</html>