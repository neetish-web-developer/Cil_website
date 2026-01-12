<?php
require 'admin/connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Notices | CIL Innovation & Incubation Centre</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Same CSS as index.php -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/contact_style.css">
    <link rel="stylesheet" href="stylenav.css">
    <link rel="stylesheet" href="css/notice.css">
</head>

<body>

<!-- ================= HEADER ================= -->
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
            <li><a href="index.php"class="active">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="incubation.php">Incubation Programs</a></li>
            <li><a href="events.php">Events</a></li>
            <li><a href="portfolio.php">Portfolio</a></li>
            <li><a href="team.php">Our Team</a></li>
            <li><a href="newsletter.php">Newsletters</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>
</header>

<!-- ================= NOTICE CONTENT ================= -->
<div class="nam">
    <p>All Notices</p>
</div>

<div style="padding: 20px; max-width: 1200px; margin: auto;">
    <table style="width:100%; border-collapse: collapse; background:#fff;">
        <thead>
            <tr style="background:#003366; color:#fff;">
                <th style="padding:10px; border:1px solid #ddd;">Sl No</th>
                <th style="padding:10px; border:1px solid #ddd;">Title</th>
                <th style="padding:10px; border:1px solid #ddd;">Description</th>
                <th style="padding:10px; border:1px solid #ddd;">Document</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT title, message, link FROM announcements ORDER BY created_at DESC";
            $res = mysqli_query($conn, $sql);
            $i = 1;

            if (mysqli_num_rows($res) > 0):
                while ($row = mysqli_fetch_assoc($res)):
            ?>
            <tr>
                <td style="padding:10px; border:1px solid #ddd;"><?= $i++ ?></td>
                <td style="padding:10px; border:1px solid #ddd;"><?= htmlspecialchars($row['title']) ?></td>
                <td style="padding:10px; border:1px solid #ddd;"><?= nl2br(htmlspecialchars($row['message'])) ?></td>
                <td style="padding:10px; border:1px solid #ddd;">
                    <?php if (!empty($row['link'])): ?>
                        <a href="<?= htmlspecialchars($row['link']) ?>" target="_blank">View / Download</a>
                    <?php else: ?>
                        —
                    <?php endif; ?>
                </td>
            </tr>
            <?php endwhile; else: ?>
            <tr>
                <td colspan="4" style="text-align:center; padding:15px;">No notices available</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- ================= FOOTER ================= -->
 <footer class="footer">
    <div class="container">
      <div class="footer-columns">
        <div class="footer-column">
          <h3>About Us</h3>
         <p>Indian Institute of Technology (Indian School of Mines) Dhanbad establishes Coal India Innovation Centre (CII), providing an enabling environment for young innovators to shape their ideas. It contributes to youth development and societal growth.</p>
        </div>
        <div class="footer-column">
          <h3>Quick Links</h3>
          <ul class="quick-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="incubation.php">Incubation Programs</a></li>
            <li><a href="events.php">Events</a></li>
            <li><a href="portfolio.php">Protfolio</a></li>
            <li><a href="team.php">Our Team</a></li>
            <li><a href="newsletter.php">Newsletters</a></li>
            <li><a href="contact.php">Contact</a></li>
          </ul>
        </div>
        
        <div class="footer-column">
          <h3>Contact Us</h3>
          <ul class="contact-info">
            <li><i class="fas fa-map-marker-alt"></i> i2h Building, IIT (ISM) , Dhanbad, Jharkhand ,India</li>
            <li><i class="fas fa-envelope"></i> cii@iitism.ac.in</li>
            <li><i class="fas fa-phone"></i> +91 9449247076</li>
            <li><i class="fas fa-phone"></i> +91 6299255860</li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

<script src="scriptnav.js"></script>
</body>
</html>
