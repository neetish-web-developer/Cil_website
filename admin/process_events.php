<?php
require 'connection.php';

if (isset($_POST["submit"]) || isset($_POST["update"])) {

    $isUpdate = isset($_POST["update"]);
    $id = $isUpdate ? $_POST['id'] : null;

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $imageName = '';

    // Check if image is uploaded
    if (isset($_FILES["upload_img"]) && $_FILES["upload_img"]["error"] !== 4) {
        $fileName = $_FILES["upload_img"]["name"];
        $fileSize = $_FILES["upload_img"]["size"];
        $tmpName = $_FILES["upload_img"]["tmp_name"];

        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (!in_array($imageExtension, $validImageExtension)) {
            die("<script>alert('Invalid image extension'); window.location.href='events.php';</script>");
        } elseif ($fileSize > 5000000) {
            die("<script>alert('Image size too large'); window.location.href='events.php';</script>");
        }

        $imageName = uniqid() . '.' . $imageExtension;
        move_uploaded_file($tmpName, 'img/events/' . $imageName);
    }

    if ($isUpdate) {
        // ----------- UPDATE EXISTING RECORD -----------
        $query = "UPDATE events SET 
                    title='$name', 
                    description='$description'";

        if ($imageName) {
            $query .= ", image='$imageName'";
        }

        $query .= " WHERE id='$id'";

        if (mysqli_query($conn, $query)) {
            echo "<script>
                    alert('Event updated successfully');
                    window.location.href='events.php';
                  </script>";
        } else {
            echo "<script>alert('Database error');</script>";
        }

    } else {
        // ----------- INSERT NEW RECORD -----------
        if (!$imageName) {
            die("<script>alert('Image is required'); window.location.href='events.php';</script>");
        }

        $query = "INSERT INTO events (title, description, image) 
                  VALUES ('$name', '$description', '$imageName')";

        if (mysqli_query($conn, $query)) {
            echo "<script>
                    alert('Successfully Uploaded');
                    window.location.href='events.php';
                  </script>";
        } else {
            echo "<script>alert('Database error');</script>";
        }
    }
}
?>
