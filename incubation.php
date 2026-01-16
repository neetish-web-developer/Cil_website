<?php
include 'admin/connection.php';

/* =========================
   FETCH APPLICATION STATUS
========================= */
// Fetch the current status from the database to decide whether to show the button
$statusResult = $conn->query(
    "SELECT application_status FROM incubation_settings WHERE id=1"
);

$statusRow = $statusResult->fetch_assoc();
$applicationStatus = $statusRow['application_status'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CIL Innovation & Incubation Centre | Dhanbad</title>

    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/contact_style.css">
    <link rel="stylesheet" href="css/incubation_style.css">
    <link rel="stylesheet" href="stylenav.css">
    <link rel="stylesheet" href="css/style_about.css">

    <script src="js/script_image_slider.js" defer></script>
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
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="incubation.php" class="active">Incubation Programs</a></li>
            <li><a href="events.php">Events</a></li>
            <li><a href="portfolio.php">Portfolio</a></li>
            <li><a href="team.php">Our Team</a></li>
            <li><a href="newsletter.php">Newsletters</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>
</header>

<div class="container_incu">

    <div class="row">
        <div class="section">
            <h2>Who can Apply</h2>
            <ul class="incu_sec1">
                <li class="incu_li">Start-up companies</li>
                <li class="incu_li">Students / Faculty Members</li>
                <li class="incu_li">Innovators</li>
            </ul>

            <h3>In the technology areas of:</h3>
            <ul class="incu_sec1">
                <li class="incu_li">Mining Process Technology (Core Business Area of CIL)</li>
            </ul>

            <h3>In any of the following sectors:</h3>
            <ul class="incu_sec1">
                <li class="incu_li">Mining</li>
                <li class="incu_li">Industrial Automation</li>
                <li class="incu_li">Robotics / Mechatronics</li>
                <li class="incu_li">Industry 4.0</li>
                <li class="incu_li">and the like</li>
            </ul>
        </div>

        <div class="section">
            <h2>What is the Selection Process</h2>
            <ol class="incu_ol">
                <li class="incu_li">Preliminary scrutiny of applications</li>
                <li class="incu_li">Shortlisted applicants pitch to expert panel</li>
            </ol>

            <h3>The pitching may result in:</h3>
            <ul class="incu_sec1">
                <li class="incu_li2">Selection for incubation / pre-incubation program (6–12 months)</li>
                <li class="incu_li2">Suggestions to improve business plan and apply later</li>
            </ul>

            <ol class="incu_ol">
                <li class="incu_li">Offer of incubation / pre-incubation</li>
                <li class="incu_li">Accept offer, sign agreements & start venture</li>
            </ol>

            <?php if ($applicationStatus === 'OPEN'): ?>
                <a href="incubationForm.php" class="apply-now-btn">Apply Now</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="row">
        <div class="section">
            <h2>What we offer</h2>
            <ul class="incu_sec1">
                <li class="incu_li">Mentors: business, technology & product development</li>
                <li class="incu_li">Seed Fund: Up to ₹05 Lakhs</li>

                <ul class="incu_sec1">
                    <li class="incu_li1">Fully furnished, air-conditioned office</li>
                    <li class="incu_li1">Meeting & conference facilities</li>
                    <li class="incu_li1">Internet & communication</li>
                </ul>

                <li class="incu_li">State-of-the-art laboratories:</li>
                <ul class="incu_sec1">
                    <li class="incu_li1">Virtual Reality Lab</li>
                    <li class="incu_li1">Electronics Lab</li>
                    <li class="incu_li1">Fabrication Lab</li>
                    <li class="incu_li1">Mine Simulation Space</li>
                    <li class="incu_li1">Mine Automation Space</li>
                    <li class="incu_li1">Electronics & Sensor Space</li>
                </ul>

                <li class="incu_li">Access to service providers (Legal, Audit, IP etc.)</li>

                <?php if ($applicationStatus === 'OPEN'): ?>
                    <a href="incubationForm.php" class="apply-now-btn">Apply Now</a>
                <?php endif; ?>
            </ul>
        </div>
    </div>

</div>
<footer class="footer">
    <div class="container">
        <div class="footer-columns">
            <div class="footer-column">
                <h3>About Us</h3>
                <p>
                    Indian Institute of Technology (ISM) Dhanbad establishes Coal India Innovation Centre (CII),
                    providing an enabling environment for innovators to shape ideas and create impact.
                </p>
            </div>

            <div class="footer-column">
                <h3>Quick Links</h3>
                <ul class="quick-links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="events.php">Events</a></li>
                    <li><a href="portfolio.php">Portfolio</a></li>
                    <li><a href="team.php">Our Team</a></li>
                    <li><a href="newsletter.php">Newsletters</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h3>Contact Us</h3>
                <ul class="contact-info">
                    <li>4<sup>th</sup> Floor, i2h Building, IIT (ISM)</li>
                    <li>Dhanbad, Jharkhand, India</li>
                    <li>Email: cii@iitism.ac.in</li>
                    <li>Phone: +91 6299255860</li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<script src="scriptnav.js"></script>

</body>
</html>