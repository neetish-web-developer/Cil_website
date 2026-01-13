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