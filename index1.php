<?php
require 'admin/connection.php';

// Fetch the first notice item
$notice_result = mysqli_query($conn, "SELECT * FROM notice ORDER BY id DESC LIMIT 1");
$notice = mysqli_fetch_assoc($notice_result);
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
    <style>
.notice-marquee {
    width: 100%;
    overflow: hidden;
    white-space: nowrap;
    box-sizing: border-box;
    background-color: #f1f1f1;
    padding: 10px 0;
    margin-top: 20px;
    text-align: center;
    font-size: 1.2em;
    font-weight: bold;
    cursor: pointer;
    position: relative;
}

.marquee-content {
    display: inline-block;
    white-space: nowrap;
    padding-left: 100%;
    animation: marquee 25s linear infinite;
}

@keyframes marquee {
    0% { transform: translateX(100%); }
    100% { transform: translateX(-100%); }
}
</style>
</head>

<body>
    <header>
        <a href="#" class="logo">
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
                <li><a href="portfolio.php">Portfolio</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>

    <div class="slider-container">
        <div class="slider">
            <?php
            $rows = mysqli_query($conn, "SELECT * FROM home_slider ORDER BY id DESC");
            foreach ($rows as $row) : ?>
                <img src="admin/img/home/<?php echo $row['image']; ?>" alt="Image 1">
            <?php endforeach; ?>
        </div>
    </div>

    <div class="notice-marquee">
        <?php if ($notice) : ?>
            <div class="marquee-content" onclick="window.location.href='announcement.php?id=<?php echo $notice['id']; ?>'">
                <?php echo $notice['title']; ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="name">
        <p>Our Labs and Infra </p>
    </div>

    <card_body>
        <div class="card_container">
            <?php 
            $rows = mysqli_query($conn, "SELECT * FROM home_labs_infra ORDER BY id DESC");
            foreach($rows as $row) : ?>
                <div class="kard" style="--clr:#009688;">
                    <div class="imagebx">
                        <img src="admin/img/home/<?php echo $row['image']; ?>">
                    </div>
                    <div class="content1">
                        <h2><?php echo $row['name']; ?></h2>
                        <p><?php echo $row['description']; ?></p>
                        <ul>
                            <li><h4><?php echo $row['point_1']; ?></h4></li>
                            <li><h4><?php echo $row['point_2']; ?></h4></li>
                            <li><h4><?php echo $row['point_3']; ?></h4></li>
                            <li><h4><?php echo $row['point_4']; ?></h4></li>
                        </ul>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </card_body>

    <link rel="stylesheet" href="css/swiper-bundle.min.css" />
    <link rel="stylesheet" href="css/style.css" />

    <div class="name">
        <p>Our Latest Events </p>
    </div>

    <div class="event_body">
        <?php
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
            window.open(imageUrl, '_blank');
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

        <!-- Swiper JS -->
        <script src="js/swiper-bundle.min.js"></script>

        <!-- JavaScript -->
        <script src="js/script.js"></script>
    </div>

    <footer>
        <footer class="footer">
            <div class="container">
                <div class="footer-columns">
                    <div class="footer-column">
                        <h3>About Us</h3>
                        <p>Indian Institute of Technology (Indian School of Mines) Dhanbad establishes Coal India Innovation Centre [CII], providing an enabling environment for young innovators to shape their ideas. It contributes to youth development and societal growth.</p>
                    </div>
                    <div class="footer-column">
                        <h3>Quick Links</h3>
                        <ul class="quick-links">
                            <li><a href="index.html">Home</a></li>
                            <li><a href="about.html">About</a></li>
                            <li><a href="incubation.html">Incubation Programs</a></li>
                            <li><a href="events.html">Events</a></li>
                            <li><a href="portfolio.html">Portfolio</a></li>
                            <li><a href="contact.html">Contact</a></li>
                        </ul>
                    </div>
                    <div class="footer-column">
                        <h3>Contact Us</h3>
                        <ul class="contact-info">
                            <li><i class="fas fa-map-marker-alt"></i> i2h Building, IIT (ISM), Dhanbad, Jharkhand, India</li>
                            <li><i class="fas fa-envelope"></i> cii@iitism.ac.in</li>
                            <li><i class="fas fa-phone"></i> +91 9449247076</li>
                            <li><i class="fas fa-phone"></i> +91 6299255860</li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </footer>

    <script src="scriptnav.js"></script>
</body>
</html>
