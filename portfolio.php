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
  <link rel="stylesheet" href="css/card_style.css">
  <link rel="stylesheet" href="stylenav.css">
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
          <li><a href="events.php">Events</a></li>
          <li><a href="portfolio.php"class="active">Portfolio</a></li>
          <li><a href="team.php">Our Team</a></li>
          <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>
  </header>

  <main>
    <div class="card_container">
      <?php
      // Include the database connection file
      // include 'admin/connection.php';

      // Fetch data from the database (example query)
      $query = "SELECT * FROM portfolio";
      $result = mysqli_query($conn, $query);

      // Check if there are rows in the result
      if (mysqli_num_rows($result) > 0) {
        // Loop through the rows and display card elements
        while ($row = mysqli_fetch_assoc($result)) {
          ?>
          <div class="kard" style="--clr:#009688;">
            <div class="imagebx">
              <img src="admin/img/portfolio/<?php echo $row['image'];?>">
            </div>
            <div class="content1">
              <h2><?php echo $row['company_name']; ?></h2>
              <p><?php echo $row['message']; ?></p>
              <h4>Director - <?php echo $row['name']; ?></h4>
            </div>
          </div>
        <?php
        }
      } else {
        echo "No data available";
      }

      // Close database connection
      mysqli_close($conn);
      ?>
    </div>
  </main>

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
                        <!-- <li><a href="portfolio.php">Protfolio</a></li> -->
                        <li><a href="team.php">Our Team</a></li>
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

  <script src="scriptnav.js"></script>
</body>

</html>
