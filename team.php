<?php
require 'admin/connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Team | CIL Innovation & Incubation Centre</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="stylenav.css">
    <link rel="stylesheet" href="css/card_style.css">
    <link rel="stylesheet" href="css/team_style.css"> <!-- New team CSS -->
    <script src="js/scriptnav.js" defer></script>
</head>
<body>
    <style>
  /* team_style.css */

/* ===== TEAM SECTION ===== */
.team-section {
    padding: 50px 20px;
    background-color: #f9f9f9;
    text-align: center;
    font-family: 'Arial', sans-serif;
}

/* Section title */
.team-section .name p {
    font-size: 2.5rem;
    font-weight: bold;
    color: #333;
    margin-bottom: 40px;
}

/* Grid container for team members */
.team-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
    justify-items: center;
}

/* Individual team member card */
.team-member {
    position: relative;
    width: 250px;
    height: 300px;
    overflow: hidden;
    border-radius: 15px;
    cursor: pointer;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.team-member:hover {
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

/* Team member image */
.member-image {
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    transition: transform 0.5s ease;
}

/* Info section initially hidden */
.member-info {
    position: absolute;
    bottom: 0;
    width: 100%;
    background: rgba(255, 255, 255, 0.95);
    padding: 20px 10px;
    text-align: center;
    transform: translateY(100%);
    transition: transform 0.5s ease;
}

/* Name and designation styling */
.member-info h3 {
    font-size: 1.3rem;
    margin-bottom: 8px;
    color: #222;
}

.member-info p {
    font-size: 1rem;
    color: #555;
    margin: 0;
}

/* Hover effect: shrink image & reveal info */
.team-member:hover .member-image {
    transform: scale(0.8) translateY(-20px);
}

.team-member:hover .member-info {
    transform: translateY(0);
}

/* Responsive adjustments */
@media screen and (max-width: 1024px) {
    .team-member {
        width: 220px;
        height: 280px;
    }
}

@media screen and (max-width: 768px) {
    .team-container {
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 20px;
    }

    .team-member {
        width: 180px;
        height: 250px;
    }

    .member-info {
        padding: 15px 8px;
    }

    .member-info h3 {
        font-size: 1.1rem;
    }

    .member-info p {
        font-size: 0.9rem;
    }
}

/* Optional: smooth fade-in effect for info text */
.member-info h3,
.member-info p {
    opacity: 0;
    transition: opacity 0.5s ease;
}

.team-member:hover .member-info h3,
.team-member:hover .member-info p {
    opacity: 1;
}


    </style>

<!-- HEADER NAVIGATION -->
<header>
    <a href="index.php" class="logo">
        <span><img src="Logo.jpeg" alt="CIL Innovation & Incubation Centre"></span>
    </a>
    <div class="menu-toggle" id="menu-icon">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
    </div>
    <nav class="navbar">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="incubation.php">Incubation Programs</a></li>
            <li><a href="events.php">Events</a></li>
            <li><a href="portfolio.php">Portfolio</a></li>
            <li><a href="team.php" class="active">Our Team</a></li>
            <li><a href="newsletter.php">Newsletters</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>
</header>

<!-- TEAM SECTION -->
<section class="team-section">
    <div class="name"><p>Team Members</p></div>
    <div class="team-container">
        <?php 
        $rows = mysqli_query($conn, "SELECT * FROM team ORDER BY id ASC"); // Assuming you have a 'team' table
        foreach($rows as $row): ?>
        <div class="team-member">
            <div class="member-image" style="background-image: url('<?php echo "admin/img/team/".$row['image']; ?>');"></div>
            <div class="member-info">
                <h3><?php echo $row['name']; ?></h3>
                <p><?php echo $row['designation']; ?></p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- FOOTER -->
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
                        <li><a href="events.php">Events</a></li>
                        <li><a href="portfolio.php">Protfolio</a></li>
                        <!-- <li><a href="team.php">Our Team</a></li> -->
                         <li><a href="newsletter.php">Newsletters</a></li>
                        <li><a href="contact.php" class="active">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-column">
          <h3>Contact Us</h3>
          <ul class="contact-info">
            <li><i class="fas fa-map-marker-alt"></i> 4<sup>th </sup>Floor, i2h Building, IIT (ISM),</li>
            <li> Dhanbad, Jharkhand ,India</li>
            <li><i class="fas fa-envelope"></i> cii@iitism.ac.in</li>
            <!-- <li><i class="fas fa-phone"></i> +91 9449247076</li> -->
            <li><i class="fas fa-phone"></i> +91 6299255860</li>
          </ul>
        </div>
            </div>
        </div>
    </footer>

</body>
</html>
