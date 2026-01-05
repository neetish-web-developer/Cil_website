<?php
// Include the database connection
include 'admin/connection.php';

// Initialize variables
$aboutImage = $aboutName = $aboutParagraph = '';
$aimTitle = '';
$aimPoints = [];

// Fetch data
$aboutQuery = "SELECT * FROM about LIMIT 1";
$aboutResult = mysqli_query($conn, $aboutQuery);

if ($aboutResult && mysqli_num_rows($aboutResult) > 0) {
    $aboutData = mysqli_fetch_assoc($aboutResult);
    $aboutImage = $aboutData['image'];
    $aboutName = $aboutData['name'];
    $aboutParagraph = $aboutData['paragraph'];
    $aimTitle = $aboutData['title'];

    for ($i = 1; $i <= 11; $i++) {
        if (!empty($aboutData["p$i"])) {
            $aimPoints[] = $aboutData["p$i"];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About | CIL Innovation & Incubation Centre</title>

    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/contact_style.css">
    <link rel="stylesheet" href="stylenav.css">
    <link rel="stylesheet" href="css/style_about.css">
</head>

<body>

<header>
    <a href="index.php" class="logo">
        <span><img src="Logo.jpeg" alt="CIL"></span>
    </a>

    <div class="menu-toggle" id="menu-icon">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
    </div>

    <nav class="navbar">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php" class="active">About</a></li>
            <li><a href="incubation.php">Incubation Programs</a></li>
            <li><a href="events.php">Events</a></li>
            <li><a href="portfolio.php">Portfolio</a></li>
            <li><a href="team.php">Our Team</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>
</header>

<div class="main_body">

    <div class="heading">
        <h1>About Us</h1>
        <p>CIL INNOVATION & INCUBATION CENTRE</p>
    </div>

    <?php if ($aboutImage && $aboutName && $aboutParagraph): ?>
    <div class="container">
        <section class="about">

            <div class="about-image">
                <img src="admin/img/about/<?php echo htmlspecialchars($aboutImage); ?>" alt="About Image">
            </div>

            <div class="about-content">
                <h2><?php echo htmlspecialchars($aboutName); ?></h2>
                <p><?php echo htmlspecialchars($aboutParagraph); ?></p>
            </div>

        </section>
    </div>
    <?php endif; ?>

</div>

<?php if ($aimTitle && !empty($aimPoints)): ?>
<div class="container2">
    <h1><?php echo htmlspecialchars($aimTitle); ?></h1>
    <ul class="aim">
        <?php foreach ($aimPoints as $point): ?>
            <li class="about_li"><span><?php echo htmlspecialchars($point); ?></span></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

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
                        <!-- <li><a href="about.php">About</a></li> -->
                        <li><a href="incubation.php">Incubation Programs</a></li>
                        <li><a href="events.php">Events</a></li>
                        <li><a href="portfolio.php">Protfolio</a></li>
                        <li><a href="team.php">Our Team</a></li>
                        <li><a href="contact.php" class="active">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-column">
          <h3>Contact Us</h3>
          <ul class="contact-info">
            <li><i class="fas fa-map-marker-alt"></i>4<sup>th </sup>Floor, i2h Building, IIT (ISM),</li>
            <li> Dhanbad, Jharkhand ,India</li>
            <li><i class="fas fa-envelope"></i> cii@iitism.ac.in</li>
            <!-- <li><i class="fas fa-phone"></i> +91 9449247076</li> -->
            <li><i class="fas fa-phone"></i> +91 6299255860</li>
          </ul>
        </div>
            </div>
        </div>
    </footer>

<script src="scriptnav.js"></script>

<!-- IMAGE ANIMATION SCRIPT -->
<script>
const aboutImg = document.querySelector('.about-image img');

if (aboutImg) {
    aboutImg.addEventListener('mousemove', (e) => {
        const rect = aboutImg.getBoundingClientRect();
        const x = e.clientX - rect.left - rect.width / 2;
        const y = e.clientY - rect.top - rect.height / 2;

        aboutImg.style.transform =
            `rotateX(${ -y / 20 }deg) rotateY(${ x / 20 }deg) scale(1.04)`;
    });

    aboutImg.addEventListener('mouseleave', () => {
        aboutImg.style.transform = 'rotateX(0) rotateY(0) scale(1)';
    });
}
</script>

</body>
</html>
