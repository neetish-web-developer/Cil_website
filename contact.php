<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CIL Innovation & Incubation Centre | Dhanbad</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/contact_style.css">
    <link rel="stylesheet" href="stylenav.css">
    <!-- <script src="script.js" defer></script> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
                <li><a href="incubation.php">Incubation Programs</a></li>
                <li><a href="events.php">Events</a></li>
                <li><a href="portfolio.php">Protfolio</a></li>
                <li><a href="team.php">Our Team</a></li>
                <li><a href="contact.php" class="active">Contact</a></li>
            </ul>
        </nav>
    </header>

    <div class="contactus">
        <div class="title">
            <h2 class="g2">Get in Touch</h2>
        </div>
        <div class="box">
            <div class="contact form">
                <h3>Send a Message</h3>
                <form action="contact_form.php" method="post">
                    <div class="formBox">
                        <div class="row50">
                            <div class="inputBox">
                                <span>First Name*</span>
                                <input type="text" id="fname" name="fname" placeholder="Neetish" required>
                            </div>
                            <div class="inputBox">
                                <span>Last Name*</span>
                                <input type="text" id="lname" name="lname" placeholder="Raj" required>
                            </div>
                        </div>

                        <div class="row50">
                            <div class="inputBox">
                                <span>Email*</span>
                                <input type="email" id="email" name="email" placeholder="abc@gmail.com" required>
                            </div>
                            <div class="inputBox">
                                <span>Mobile*</span>
                                <input type="tel" id="phone" name="phone" placeholder="1234567890" required
                                    pattern="[0-9]{10}" title="Please enter a 10-digit mobile number" maxlength="10">
                            </div>
                        </div>

                        <div class="row100">
                            <div class="inputBox">
                                <span>Message*</span>
                                <textarea id="message" name="message" placeholder="Write your message here...."
                                    required></textarea>
                            </div>
                        </div>

                        <div class="row100">
                            <div class="inputBox">
                                <span>Captcha*</span>
                                <div style="display:flex; align-items:center; gap:10px;">
                                    <img src="captcha.php" id="captchaImage"
                                        style="border:1px solid #ccc; height:50px;">
                                    <button type="button" onclick="refreshCaptcha()"
                                        style="padding:8px 12px; cursor:pointer;">
                                        Refresh
                                    </button>
                                </div>
                                <input type="text" id="captcha_input" name="captcha_input" placeholder="Enter Captcha"
                                    required>
                            </div>
                        </div>

                        <div class="row100">
                            <div class="inputBox">
                                <input type="submit" value="Submit">
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="contact info">
                <h3>Contact Info</h3>
                <div class="infoBox">
                    <div>
                        <span><ion-icon name="location"></ion-icon></span>
                        <p>4<sup>th</sup> Floor,i2h Building, IIT (ISM)<br> Dhanbad, Jharkhand,  India</p>
                    </div>
                    <div>
                        <span><ion-icon name="mail"></ion-icon></span>
                        <a href="mailto:cii@iitism.ac.in">cii@iitism.ac.in</a>
                    </div>
                    <!-- <div>
                        <span><ion-icon name="call"></ion-icon></span>
                        <a href="tel:+919449247076">+91 9449247076</a>
                    </div> -->
                    <div>
                        <span><ion-icon name="call"></ion-icon></span>
                        <a href="tel:+916299255860">+91 6299255860</a>
                    </div>

                    <ul class="sci">
                        <li><a href="https://twitter.com/CIIcentre" target="_blank"><ion-icon name="logo-twitter"></ion-icon></a></li>
                        <li><a href="http://www.linkedin.com/in/cil-innovation-and-incubation-centre-047a93281" target="_blank"><ion-icon name="logo-linkedin"></ion-icon></a></li>
                        <li><a href="https://www.instagram.com/cii_centre/" target="_blank"><ion-icon name="logo-instagram"></ion-icon></a></li>
                    </ul>
                </div>
            </div>

            <div class="contact map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3650.1719142738443!2d86.43601377623102!3d23.812485086388367!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f6bdbdf0f326d3%3A0x4e8600cd575da3a0!2si2h%20(Institute%20Innovation%20Hub)%20Building!5e0!3m2!1sen!2sin!4v1688895871903!5m2!1sen!2sin" style="border:0;" allowfullscreen=""
                    loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>

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
                        <li><a href="team.php">Our Team</a></li>
                        <!-- <li><a href="contact.php" class="active">Contact</a></li> -->
                    </ul>
                </div>
                <div class="footer-column">
          <h3>Contact Us</h3>
          <ul class="contact-info">
            <li><i class="fas fa-map-marker-alt"></i> 4<sup>th</sup> Floor, i2h Building, IIT (ISM),</li>
            <li> Dhanbad, Jharkhand ,India</li>
            <li><i class="fas fa-envelope"></i> cii@iitism.ac.in</li>
            <!-- <li><i class="fas fa-phone"></i> +91 9449247076</li> -->
            <li><i class="fas fa-phone"></i> +91 6299255860</li>
          </ul>
        </div>
            </div>
        </div>
    </footer>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script>
        function refreshCaptcha() {
            // Appends a unique timestamp to force the browser to load a new image
            document.getElementById('captchaImage').src = 'captcha.php?' + Date.now(); 
        }

        // Mobile input: only numbers, max 10 digits
        const phoneInput = document.getElementById('phone');
        phoneInput.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);
        });
    </script>
</body>

</html>