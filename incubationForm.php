<?php
// CRITICAL: session_start() must be the very first thing in the file.
session_start();
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
    <link rel="stylesheet" href="css/form_style.css">
    <link rel="stylesheet" href="stylenav.css">

    <style>
        .captcha-container {
            display: flex;
            align-items: center;
            gap: 10px;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            width: max-content;
            background: #fafafa;
            margin-top: 10px;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-top: 3px;
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
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="incubation.php" class="active">Incubation Programs</a></li>
                <li><a href="events.php">Events</a></li>
                <li><a href="portfolio.php">Portfolio</a></li>
                <li><a href="team.php">Our Team</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>

    <div class="container2">
        <h1>CIL Innovation & Incubation Centre, IIT(ISM) Dhanbad</h1>
        <h2>Apply For Incubation</h2>

        <?php
        // --- PHP ALERT AND REDIRECT LOGIC ---
        if (isset($_SESSION['message'])) {
            $message = htmlspecialchars($_SESSION['message']);
            // Determine the page to redirect to. Default to current page on error.
            $redirect_page = isset($_SESSION['redirect_to']) ? htmlspecialchars($_SESSION['redirect_to']) : 'incubation.php';
            
            // Generate the JavaScript to show the alert
            echo "<script>";
            echo "alert('$message');";
            
            // Redirect only if the submission was successful
            if (strpos($message, 'successfully') !== false) {
                echo "window.location.href = '$redirect_page';";
            }
            
            echo "</script>";
            
            // Clear the session variables
            unset($_SESSION['message']);
            unset($_SESSION['redirect_to']);
        }
        ?>

        <form id="incubationForm" action="submit_form.php" method="post">

            <fieldset>
                <legend>Applicant's Details</legend>

                <div class="input-group">
                    <label for="name">Name*</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="input-group">
                    <label for="email">Email*</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="input-group">
                    <label for="phone">Mobile Number*</label>
                    <input type="text" id="phone" name="mobile-number" required>
                    <p id="phoneError" class="error"></p>
                </div>

                <div class="input-group">
                    <label for="address">Permanent Address*</label>
                    <input type="text" id="address" name="address" required>
                </div>

            </fieldset>

            <fieldset>
                <legend>Company Details</legend>

                <div class="input-group">
                    <label>Do you have a registered Pvt. Ltd. Company?*</label>
                    <label><input type="radio" name="registered-company" required value="yes"> Yes</label>
                    <label><input type="radio" name="registered-company" value="no"> No</label>
                </div>

                <div class="input-group">
                    <label>Have you received any investment?*</label>
                    <label><input type="radio" name="investment-received" required value="yes"> Yes</label>
                    <label><input type="radio" name="investment-received" value="no"> No</label>
                </div>

                <div class="input-group">
                    <label for="co-founders">Number of full-time co-founders* (Max 20)</label>
                    <input type="text" id="co-founders" name="co-founders" required>
                    </div>
            </fieldset>

            <fieldset>
                <legend>Business Proposal*</legend>
                <div class="input-group">
                    <label for="proposal">Summary of proposal in 200 words</label>
                    <textarea id="proposal" name="proposal" required></textarea>
                </div>
            </fieldset>

            <p>
                <a href="form.docx" download class="submit_button">Download Form*</a> and mail us from the above mentioned mail.
            </p>

            <div class="checkbox-group">
                <label><input type="checkbox" name="info-shared[]" required value="downloaded"> I have downloaded the above form.</label><br>
                <label><input type="checkbox" name="info-shared[]" required value="experts"> The provided information may be shared with experts.</label><br>
                <label><input type="checkbox" name="info-accurate" required> Information provided is accurate.</label><br>
                <label><input type="checkbox" name="no-fraud-conviction" required> No fraud conviction.</label><br>
                <label><input type="checkbox" name="no-restriction" required> No statutory restriction.</label>
            </div>

            <fieldset>
                <legend>Captcha*</legend>

                <div class="input-group">

                    <div class="captcha-container">
                        <img src="captcha.php" id="captchaImage" style="height:50px;">
                        <button type="button" onclick="refreshCaptcha()" style="padding:8px 12px; cursor:pointer;">
                            Refresh
                        </button>
                    </div>

                    <input type="text" id="captchaInput" name="captcha_input" placeholder="Enter Captcha" required>
                    <p id="captchaError" class="error"></p>

                </div>
            </fieldset>

            <button type="submit" class="submit_button">Submit</button>

        </form>
    </div>

    <footer class="footer">
        <div class="container">
            <div class="footer-columns">
                <div class="footer-column">
                    <h3>About Us</h3>
                    <p>IIT (ISM) Dhanbad establishes Coal India Innovation Centre (CII), enabling young innovators to shape ideas.</p>
                </div>

                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <ul class="quick-links">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about.php">About</a></li>
                        <li><a href="incubation.php" class="active">Incubation Programs</a></li>
                        <li><a href="events.php">Events</a></li>
                        <li><a href="portfolio.php">Portfolio</a></li>
                        <li><a href="team.php">Our Team</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h3>Contact Us</h3>
                    <ul class="contact-info">
                        <li>i2h Building, IIT (ISM), Dhanbad, Jharkhand, India</li>
                        <li>cii@iitism.ac.in</li>
                        <li>+91 9449247076</li>
                        <li>+91 6299255860</li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script src="scriptnav.js"></script>

    <script>
        /* MOBILE NUMBER VALIDATION */
        document.getElementById("phone").addEventListener("input", function() {
            let phone = this.value.trim();
            let errorBox = document.getElementById("phoneError");

            // Allow only digits and limit to 10 characters
            this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);
            phone = this.value.trim();

            if (phone.length === 10 && !/^[6-9][0-9]{9}$/.test(phone)) {
                errorBox.innerText = "Enter a valid 10-digit Indian mobile number.";
            } else if (phone.length < 10 && phone.length > 0) {
                errorBox.innerText = "Mobile number must be 10 digits.";
            } else {
                errorBox.innerText = "";
            }
        });

        /* REFRESH CAPTCHA */
        function refreshCaptcha() {
            // Appends a unique timestamp to force the browser to load a new image
            document.getElementById("captchaImage").src = "captcha.php?" + Date.now();
        }

        /* CO-FOUNDERS LIVE VALIDATION (NEW) */
        const coFoundersInput = document.getElementById("co-founders");
        // Dynamically create error container if it doesn't exist
        let coFoundersError = document.getElementById('coFoundersError');
        if (!coFoundersError) {
             coFoundersError = document.createElement('p');
             coFoundersError.id = 'coFoundersError';
             coFoundersError.className = 'error';
             coFoundersInput.parentNode.insertBefore(coFoundersError, coFoundersInput.nextSibling);
        }

        coFoundersInput.addEventListener("input", function() {
            let value = this.value.trim();
            coFoundersError.innerText = "";

            // 1. Enforce only digits and limit length (e.g., max 2 digits for 20)
            this.value = value.replace(/[^0-9]/g, '').slice(0, 2);
            value = this.value;

            // 2. Check max limit
            if (value !== "" && parseInt(value) > 20) {
                coFoundersError.innerText = "Maximum number of co-founders is 20.";
            }
        });


        /* FORM SUBMISSION VALIDATION (Combined Checks) */
        document.getElementById("incubationForm").addEventListener("submit", function(e) {

            let phone = document.getElementById("phone").value.trim();
            let captchaInput = document.getElementById("captchaInput").value.trim();
            let coFounders = document.getElementById("co-founders").value.trim(); 

            let phoneError = document.getElementById("phoneError");
            let captchaError = document.getElementById("captchaError");
            let coFoundersError = document.getElementById("coFoundersError"); // Use existing element

            let isValid = true;

            // 1. Phone validation
            if (phone.length !== 10 || !/^[6-9][0-9]{9}$/.test(phone)) {
                phoneError.innerText = "Enter a valid 10-digit Indian mobile number.";
                isValid = false;
            } else {
                phoneError.innerText = "";
            }

            // 2. Captcha validation
            if (captchaInput === "") {
                captchaError.innerText = "Captcha required!";
                isValid = false;
            } else {
                captchaError.innerText = "";
            }

            // 3. Co-Founders validation (MUST BE NUMBER and MAX 20)
            if (coFounders === "" || !/^\d+$/.test(coFounders)) {
                coFoundersError.innerText = "Number of co-founders is required and must be a number.";
                isValid = false;
            } else if (parseInt(coFounders) < 1 || parseInt(coFounders) > 20) {
                coFoundersError.innerText = "Number of co-founders must be between 1 and 20.";
                isValid = false;
            } else {
                coFoundersError.innerText = "";
            }

            if (!isValid) e.preventDefault();
        });
    </script>

</body>

</html>