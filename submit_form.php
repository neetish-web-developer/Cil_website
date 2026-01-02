<?php
session_start();
// Ensure the database connection file uses mysqli_connect or similar.
require 'admin/connection.php'; 

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // --- 1. CAPTCHA VALIDATION ---
    if (!isset($_POST['captcha_input']) || !isset($_SESSION['captcha_code'])) {
        $_SESSION['message'] = "ERROR: Captcha not generated or form data missing.";
        header("Location: incubationForm.php");
        exit;
    }

    $user_captcha = $_POST['captcha_input'];
    $stored_captcha = $_SESSION['captcha_code'];

    // Case-sensitive comparison
    if ($user_captcha !== $stored_captcha) {
        $_SESSION['message'] = "CAPTCHA ERROR: The entered captcha is incorrect. Please try again.";
        unset($_SESSION['captcha_code']);
        header("Location: incubationForm.php");
        exit;
    }
    
    // CAPTCHA PASSED
    unset($_SESSION['captcha_code']); 


    // --- 2. DATA COLLECTION & SANITIZATION ---
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['mobile-number']); 
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $registered_company = mysqli_real_escape_string($conn, $_POST['registered-company']);
    $investment_received = mysqli_real_escape_string($conn, $_POST['investment-received']);
    $number_of_co_founders = $_POST['co-founders']; // Will be validated below
    $proposal = mysqli_real_escape_string($conn, $_POST['proposal']);

    
    // --- 3. SERVER-SIDE CO-FOUNDERS VALIDATION (NEW) ---
    // Ensure it's an integer and within the max limit
    if (!filter_var($number_of_co_founders, FILTER_VALIDATE_INT) || $number_of_co_founders < 1 || $number_of_co_founders > 20) {
        $_SESSION['message'] = "VALIDATION ERROR: Number of full-time co-founders must be a number between 1 and 20.";
        header("Location: incubationForm.php");
        exit;
    }


    // --- 4. DATABASE INSERTION ---
    $query = "INSERT INTO incubation (name, email, mobile, address, reg_company, inv_received, co_founder, proposal) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    // Using Prepared Statements
    if ($stmt = $conn->prepare($query)) {
        // 's' for string, 'i' for integer (for co_founder)
        $stmt->bind_param("ssssssis", $name, $email, $phone, $address, $registered_company, $investment_received, $number_of_co_founders, $proposal);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Application submitted successfully.";
        } else {
            $_SESSION['message'] = "DATABASE ERROR: Failed to submit application. Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $_SESSION['message'] = "DATABASE ERROR: Could not prepare statement. Error: " . $conn->error;
    }

    // Close connection and redirect
    $conn->close();
    header("Location: incubationForm.php");
    exit;

} else {
    // If accessed directly without POST
    $_SESSION['message'] = "ERROR: Form submission method not allowed.";
    header("Location: incubationForm.php");
    exit;
}
?>