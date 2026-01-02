<?php
include('connection.php');

$id = $_GET['id'];
$table = $_GET['table'];
$redirect = $_GET['redirect'];


// Delete record from database
$sql = "DELETE FROM $table WHERE id=$id";
if ($conn->query($sql) === TRUE) {
    $message = "Record deleted successfully";
} else {
    $message = "Error deleting record: " . $conn->error;
}

$conn->close();

// Display the message before redirecting
echo $message;

// Redirect to home.php after displaying the message
header("Location: ".$redirect);
exit(); // Ensure that no further code is executed after the redirect
?>
