<?php
require '../connection.php';

if (isset($_POST["submit"])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $registered_company = $_POST['registered_company'];
    $investment_received = $_POST['investment_received'];
    $number_of_co_founders = $_POST['number_of_co_founders'];
    $proposal = $_POST['proposal'];

    $query = "INSERT INTO incubation_applications (name, email, phone, address, registered_company, investment_received, number_of_co_founders, proposal) 
              VALUES ('$name', '$email', '$phone', '$address', '$registered_company', '$investment_received', '$number_of_co_founders', '$proposal')";

    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Application submitted successfully');
                document.location.href = 'incubation.html';
              </script>";
    } else {
        echo "<script>alert('Database error');</script>";
    }
}
?>
