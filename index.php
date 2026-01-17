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
    <script src="js/script_image_slider.js" defer></script>
    <link rel="stylesheet" href="stylenav.css">
    <link rel="stylesheet" href="css/card_style.css">
    <link rel="stylesheet" href="css/events_card.css">
    <link rel="stylesheet" href="css/notice.css">
    
    <style>
        /* Styling for the More Details Button */
        .btn-more {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 25px;
            background-color: #009688;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background 0.3s ease;
        }
        .btn-more:hover {
            background-color: #00796b;
            color: #fff;
        }
        .mission-text {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
        /* Social Bar */
.social-bar {
  position: fixed;
  left: 0;
  top: 50%;
  transform: translateY(-50%);
  display: flex;
  flex-direction: column;
  z-index: 1000;
}

.social-bar a {
  width: 45px;
  height: 45px;
  display: flex;
  justify-content: center;
  align-items: center;
  transition: all 0.3s ease;
}

.social-bar svg {
  width: 20px;
  height: 20px;
  fill: white;
}

/* Brand Colors */
.linkedin { background: #0077b5; }
.instagram { background: #e1306c; }
.x { background: #000000; }

/* Hover Effect */
.social-bar a:hover {
  width: 55px;
}
    </style>
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
            <li><a href="index.php" class="active">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="incubation.php">Incubation Programs</a></li>
            <li><a href="events.php">Events</a></li>
            
            <li class="dropdown-item">
    <a href="portfolio.php" class="nav-link">Portfolio</a>
    <ul class="submenu">
        <li><a href="ipr.php">IPR</a></li>
    </ul>
</li>

            <li><a href="team.php">Our Team</a></li>
            <li><a href="newsletter.php">Newsletters</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>
</header>

    <div class="slider-container">
      <div class="slider">
        <?php
        $rows = mysqli_query($conn, "SELECT * FROM home_slider ORDER BY id DESC");
        foreach($rows as $row) : ?>
            <img src="admin/img/home/<?php echo $row['image'];?>" alt="Slider Image">
        <?php endforeach;?>
      </div>
    </div>

    <!-- Social Bar -->
    <div class="social-bar">
        <a href="https://www.linkedin.com/in/cil-innovation-and-incubation-centre-047a93281" target="_blank" class="linkedin" aria-label="LinkedIn">
        <!-- LinkedIn SVG -->
        <svg viewBox="0 0 24 24">
            <path d="M4.98 3.5C4.98 4.88 3.86 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1 4.98 2.12 4.98 3.5zM0 8h5v16H0zM8 8h4.8v2.2h.1c.7-1.3 2.4-2.7 4.9-2.7 5.2 0 6.2 3.4 6.2 7.8V24h-5V16.3c0-1.8 0-4.1-2.5-4.1s-2.9 1.9-2.9 4V24H8z"/>
        </svg>
        </a>

        <a href="https://www.instagram.com/cii_centre/" target="_blank" class="instagram" aria-label="Instagram">
        <!-- Instagram SVG -->
        <svg viewBox="0 0 24 24">
            <path d="M12 2.2c3.2 0 3.6 0 4.9.1 1.2.1 2 .3 2.4.5.6.2 1 .5 1.4.9.4.4.7.8.9 1.4.2.4.4 1.2.5 2.4.1 1.3.1 1.7.1 4.9s0 3.6-.1 4.9c-.1 1.2-.3 2-.5 2.4-.2.6-.5 1-.9 1.4-.4.4-.8.7-1.4.9-.4.2-1.2.4-2.4.5-1.3.1-1.7.1-4.9.1s-3.6 0-4.9-.1c-1.2-.1-2-.3-2.4-.5-.6-.2-1-.5-1.4-.9-.4-.4-.7-.8-.9-1.4-.2-.4-.4-1.2-.5-2.4-.1-1.3-.1-1.7-.1-4.9s0-3.6.1-4.9c.1-1.2.3-2 .5-2.4.2-.6.5-1 .9-1.4.4-.4.8-.7 1.4-.9.4-.2 1.2-.4 2.4-.5C8.4 2.2 8.8 2.2 12 2.2zm0 3.6a6.2 6.2 0 1 0 0 12.4 6.2 6.2 0 0 0 0-12.4zm0 10.2a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.4-10.9a1.4 1.4 0 1 1-2.8 0 1.4 1.4 0 0 1 2.8 0z"/>
        </svg>
        </a>

        <a href="https://x.com/CIIcentre" target="_blank" class="x" aria-label="X">
        <!-- X (Twitter) SVG -->
        <svg viewBox="0 0 24 24">
            <path d="M18.9 2H22l-7.5 8.6L23 22h-6.7l-5.2-6.5L5.3 22H2l8-9.2L1 2h6.9l4.7 5.9L18.9 2z"/>
        </svg>
        </a>
    </div> 
       
    <section class="mission-section">
        <div class="name">
            <p>About Us </p>
        </div>
        <div class="mission-container">
            <div class="mission-image">
                <img src="admin/img/home/center-view.jpg" alt="CIL Innovation & Incubation Centre">
            </div>
            <div class="mission-text">
                <p>
                    IIT(ISM) and CIL are collaborated to set up the CII Center with the objective to nurture innovators with technical & social impact to ideate in the domain of Technology, Innovation and Community Skill Development . 
                </p>
                <a href="about.php" class="btn-more">More Details</a>
            </div>
        </div>
    </section>
    <div class="name">
      <p>Labs and Infrastructure </p>
    </div>
    <card_body>
      <div class="card_container">
          <?php 
              $rows = mysqli_query($conn, "SELECT * FROM home_labs_infra ORDER BY id DESC");
              foreach($rows as $row) : ?>
              <div class="kard" style="--clr:#009688;">
                  <div class="imagebx">
                      <img src="admin/img/home/<?php echo $row['image'];?>">
                  </div>
                  <div class="content1">
                      <h2><?php echo $row['name'];?></h2>
                      <p><?php echo $row['description'];?></p>
                      <ul>
                          <li><h4><?php echo $row['point_1'];?></h4></li>
                          <li><h4><?php echo $row['point_2'];?></h4></li>
                          <li><h4><?php echo $row['point_3'];?></h4></li>
                          <li><h4><?php echo $row['point_4'];?></h4></li>
                      </ul>
                  </div>
              </div>
          <?php endforeach; ?>
      </div>
    </card_body> 

    <link rel="stylesheet" href="css/swiper-bundle.min.css" />
    <link rel="stylesheet" href="css/style.css" />

    <section class="supported-by">
        <div class="container">
            <h3 class="support-title">Supported By</h3>
            <div class="logo-grid">
                <div class="support-logo">
                    <img src="admin/img/home/coal.png" alt="Coal India Limited">
                </div>
                <div class="support-logo">
                    <img src="admin/img/home/aim.png" alt="Atal Innovation Mission">
                </div>
                <div class="support-logo">
                    <img src="admin/img/home/ism.png" alt="IIT (ISM) Dhanbad">
                </div>
            </div>
        </div>
    </section>

    <div class="name">
        <p>Latest Events </p>
    </div>

    <div class="event_body">
        <?php
        $sql = "SELECT title, description, image FROM events ORDER BY id DESC LIMIT 4";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
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
        ?>
    </div>

    <script>
        function openImage(imageUrl) {
            window.open('admin/img/events/' + imageUrl, '_blank');
        }
    </script>

    <div>
        <div class="name">
            <p>What Our Incubatees Say :</p>
        </div>
        <section class="container">
            <div class="testimonial mySwiper">
                <div class="testi-content swiper-wrapper">
                    <?php
                    $sql = "SELECT name, image, message FROM portfolio";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<div class="slide swiper-slide">';
                            echo '<img src="admin/img/portfolio/' . $row['image'] . '" alt="' . $row['name'] . '" class="image" />';
                            echo '<p>' . $row['message'] . '</p>';
                            echo '<i class="bx bxs-quote-alt-left quote-icon"></i>';
                            echo '<div class="details">';
                            echo '<span class="name">' . $row['name'] . '</span>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>No testimonials found.</p>';
                    }
                    mysqli_close($conn);
                    ?>
                </div>
                <div class="swiper-button-next nav-btn"></div>
                <div class="swiper-button-prev nav-btn"></div>
                <div class="swiper-pagination"></div>
            </div>
        </section>
        <script src="js/swiper-bundle.min.js"></script>
        <script src="js/script.js"></script>
    </div>

    <footer class="footer">
        <div class="container">
            <div class="footer-columns">
                <div class="footer-column">
                    <h3>About Us</h3>
                    <p>Indian Institute of Technology (Indian School of Mines) Dhanbad establishes Coal India Innovation
                        Centre (CII), providing an enabling environment for young innovators to shape their ideas.</p>
                </div>
                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <ul class="quick-links">
                        <li><a href="about.php">About</a></li>
                        <li><a href="incubation.php">Incubation Programs</a></li>
                        <li><a href="events.php">Events</a></li>
                        <li><a href="portfolio.php">Portfolio</a></li>
                        <li><a href="team.php">Our Team</a></li>
                        <li><a href="newsletter.php">Newsletters</a></li>
                        <li><a href="contact.php" class="active">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Contact Us</h3>
                    <ul class="contact-info">
                        <li>4<sup>th </sup>Floor, i2h Building, IIT (ISM), Dhanbad</li>
                        <li>cii@iitism.ac.in</li>
                        <li>+91 6299255860</li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <script src="scriptnav.js"></script>
</body>
</html>