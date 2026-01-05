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
              <li><a href="index.php"class="active">Home</a></li>
              <li><a href="about.php">About</a></li>
              <li><a href="incubation.php">Incubation Programs</a></li>
              <li><a href="events.php">Events</a></li>
              <li><a href="portfolio.php">Protfolio</a></li>
              <li><a href="team.php">Our Team</a></li>
              <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>
    <div class="slider-container">
      <div class="slider">
        <?php
       $rows = mysqli_query($conn, "SELECT * FROM home_slider ORDER BY id DESC");
       ?>
       <?php foreach($rows as $row) : ?>
        <img src="admin/img/home/<?php echo $row['image'];?>" alt="Image 1">
       
        <?php endforeach;?>
      </div>
      <!-- <div class="slider-controls">
        <button id="prevBtn"></button>
        <button id="nextBtn"></button>
      </div> -->
    </div>
       
    <!-- Announcements Section -->
        <div class="announcement-bar">
            <div class="announcement-label">📢 Announcements</div>

            <?php
            $sql = "SELECT title, message, link FROM announcements WHERE is_pinned=1 ORDER BY created_at DESC LIMIT 1";
            $res = mysqli_query($conn, $sql);
            if ($row = mysqli_fetch_assoc($res)):
                $hasLink = !empty($row['link']); // Check if link exists
            ?>
                <div class="announcement-title">
                    <?php if ($hasLink): ?>
                        <a href="<?= htmlspecialchars($row['link']) ?>" target="_blank"><?= htmlspecialchars($row['title']) ?></a>
                    <?php else: ?>
                        <?= htmlspecialchars($row['title']) ?>
                    <?php endif; ?>
                </div>

                <div class="announcement-marquee">
                    <div class="announcement-text">
                        <?php if ($hasLink): ?>
                            <a href="<?= htmlspecialchars($row['link']) ?>" target="_blank"><?= htmlspecialchars($row['message']) ?></a>
                        <?php else: ?>
                            <?= htmlspecialchars($row['message']) ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
            <!-- VIEW ALL NOTICES -->
    <div class="announcement-all" class="announcement-label">
        <a href="notice.php">View All</a>
    </div>
        </div>
    <!-- End Announcements Section -->

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
    
    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css" />

    <!-- Boxicons CSS -->
    
          <div class="name">
            <p>Latest Events </p>
          </div>


          


          <div class="event_body">
            <?php
            // Assuming $conn is your database connection
            $sql = "SELECT title, description, image FROM events ORDER BY date DESC LIMIT 4";
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
                window.open('admin/img/events/' +imageUrl, '_blank');
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
                    // Fetch data from the portfolio table
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

        <!-- Swiper JS -->
        <script src="js/swiper-bundle.min.js"></script>

        <!-- JavaScript -->
        <script src="js/script.js"></script>
    </div>
 
<!--contact us page body -->


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
                        <!-- <li><a href="index.php">Home</a></li> -->
                        <li><a href="about.php">About</a></li>
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
    <script>
function initMarquee() {
    const marquee = document.querySelector('.announcement-marquee');
    const text = document.querySelector('.announcement-text');

    if (!marquee || !text) return;

    const marqueeWidth = marquee.clientWidth;
    const textWidth = text.scrollWidth;

    // Distance text should move (px)
    const distance = marqueeWidth - textWidth;

    // SPEED: pixels per second (adjust this)
    const speed = 80; // 80px/sec = smooth & readable

    // Time = distance / speed
    const duration = Math.abs(distance) / speed;

    marquee.style.setProperty('--marquee-width', distance + 'px');
    marquee.style.setProperty('--marquee-duration', duration + 's');
}

window.addEventListener('load', initMarquee);
window.addEventListener('resize', initMarquee);
</script>


</body>
</html>
