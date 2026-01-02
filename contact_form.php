<?php
session_start();

// --- 1. CAPTCHA VALIDATION ---
if (isset($_POST['captcha_input']) && isset($_SESSION['captcha_code'])) {
    
    $user_captcha = $_POST['captcha_input'];
    $stored_captcha = $_SESSION['captcha_code'];

    // Case-sensitive comparison: Captcha validation check
    if ($user_captcha !== $stored_captcha) {
        // CAPTCHA FAILED
        echo "<script>alert('CAPTCHA ERROR: The entered captcha is incorrect or the casing is wrong. Please try again.'); window.location.href='contact.php';</script>";
        // Clear the captcha session variable after failed attempt
        unset($_SESSION['captcha_code']);
        exit; // Stop execution
    }
    
    // CAPTCHA PASSED
    
    // Clear the captcha session variable after successful validation
    unset($_SESSION['captcha_code']); 

    // --- 2. DATABASE CONFIGURATION & CONNECTION ---
    $servername = "localhost";
    $username = "root";        // Your database username
    $password = "";            // Your database password
    $dbname = "cii_centre";    // Your specific database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // --- 3. SANITIZATION AND DATA COLLECTION ---
    // Using the specific column names from your table structure
    $fname = $conn->real_escape_string(trim($_POST['fname']));
    $lname = $conn->real_escape_string(trim($_POST['lname']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $mobile = $conn->real_escape_string(trim($_POST['phone'])); // Mapped form field 'phone' to DB column 'mobile'
    $message = $conn->real_escape_string(trim($_POST['message']));

    // --- 4. INSERT DATA INTO DATABASE ---
    // Using the specific table and column names: `contact`, `f_name`, `l_name`, `mobile`
    $sql = "INSERT INTO contact (f_name, l_name, email, mobile, message) 
            VALUES ('$fname', '$lname', '$email', '$mobile', '$message')";

    if ($conn->query($sql) === TRUE) {
        // Success message
        echo "<script>alert('Message sent successfully! Your inquiry has been recorded.'); window.location.href='contact.php';</script>";
    } else {
        // Database insertion failure
        echo "<script>alert('DATABASE ERROR: Failed to save message. Error: " . $conn->error . "'); window.location.href='contact.php';</script>";
    }

    $conn->close();

} else {
    // CAPTCHA or POST data not set (Invalid form submission)
    echo "<script>alert('ERROR: Invalid form submission. Please refresh and try again.'); window.location.href='contact.php';</script>";
}
?>