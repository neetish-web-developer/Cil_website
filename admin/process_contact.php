<?php
require '../connection.php';

if (isset($_POST["submit"])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    $query = "INSERT INTO contact_us (first_name, last_name, email, phone, message) 
              VALUES ('$first_name', '$last_name', '$email', '$phone', '$message')";

    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Message Sent Successfully');
                document.location.href = 'contact_us.html';
              </script>";
    } else {
        echo "<script>alert('Database error');</script>";
    }
}
?>
