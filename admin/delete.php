<?php
include('connection.php');

// Sanitize and validate input parameters
$id = intval($_GET['id']);  // Ensure $id is an integer
$table = $_GET['table'];
$fileLocation = $_GET['file_location'];
$redirect = $_GET['redirect'];

// Fetch image filename from database
$sql = "SELECT image FROM $table WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($imageFilename);
$stmt->fetch();
$stmt->close();

if (!$imageFilename) {
    echo "Record not found";
    exit();
}

$imagePath = $fileLocation . $imageFilename;

// Check if the image file exists
if (file_exists($imagePath)) {
    echo "File exists: $imagePath<br>";
    
    // Attempt to delete the file
    if (unlink($imagePath)) {
        echo "Image file deleted successfully<br>";
    } else {
        echo "Failed to delete image file: " . error_get_last()['message'] . "<br>";
    }
} else {
    echo "Image file not found: $imagePath<br>";
}

// Delete record from database
$sql_delete = "DELETE FROM $table WHERE id=?";
$stmt_delete = $conn->prepare($sql_delete);
$stmt_delete->bind_param("i", $id);

if ($stmt_delete->execute()) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $stmt_delete->error;
}
$stmt_delete->close();

$conn->close();

header("Location: ". $redirect);
exit();
?>
