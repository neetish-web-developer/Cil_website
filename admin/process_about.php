<?php
require 'connection.php';

// -------------------------
// INSERT NEW DATA
// -------------------------
if (isset($_POST["submit"])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $paragraph = mysqli_real_escape_string($conn, $_POST['paragraph']);

    $image = '';

    // IMAGE UPLOAD
    if ($_FILES["upload_img"]["error"] === 0) {
        $fileName = $_FILES["upload_img"]["name"];
        $fileSize = $_FILES["upload_img"]["size"];
        $tmpName = $_FILES["upload_img"]["tmp_name"];

        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (!in_array($imageExtension, $validImageExtension)) {
            die("Invalid image extension. Please upload JPG, JPEG or PNG only.");
        } elseif ($fileSize > 5000000) {
            die("Image size too large. Please upload below 5MB.");
        }

        $newImageName = uniqid() . "." . $imageExtension;
        move_uploaded_file($tmpName, "img/about/" . $newImageName);

        $image = $newImageName;
    }

    // POINTS
    $points = [];
    for ($i = 1; $i <= 10; $i++) {
        $points[$i] = isset($_POST["point{$i}"]) ? 
                      mysqli_real_escape_string($conn, $_POST["point{$i}"]) : "";
    }

    // INSERT QUERY
    $query = "INSERT INTO about (name, title, paragraph, image, 
                                p1, p2, p3, p4, p5, p6, p7, p8, p9, p10)
              VALUES ('$name', '$title', '$paragraph', '$image',
                      '{$points[1]}','{$points[2]}','{$points[3]}','{$points[4]}','{$points[5]}',
                      '{$points[6]}','{$points[7]}','{$points[8]}','{$points[9]}','{$points[10]}')";

    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('About data successfully added.');
                window.location.href = 'about.php';
              </script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    exit();
}



// -------------------------
// UPDATE EXISTING DATA
// -------------------------
if (isset($_POST["update"])) {

    $id = $_POST["id"];

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $paragraph = mysqli_real_escape_string($conn, $_POST['paragraph']);

    // Fetch old image
    $oldImage = mysqli_fetch_assoc(mysqli_query($conn, "SELECT image FROM about WHERE id='$id'"))['image'];
    $image = $oldImage;

    // If new image uploaded:
    if ($_FILES["upload_img"]["error"] === 0) {

        $fileName = $_FILES["upload_img"]["name"];
        $fileSize = $_FILES["upload_img"]["size"];
        $tmpName = $_FILES["upload_img"]["tmp_name"];

        $validImageExtension = ['jpg','jpeg','png'];
        $imageExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (!in_array($imageExtension, $validImageExtension)) {
            die("Invalid image extension.");
        } elseif ($fileSize > 5000000) {
            die("Image size too large. Max 5MB.");
        }

        // Delete old image file
        if (!empty($oldImage) && file_exists("img/about/".$oldImage)) {
            unlink("img/about/".$oldImage);
        }

        // Upload new file
        $newImageName = uniqid() . "." . $imageExtension;
        move_uploaded_file($tmpName, "img/about/" . $newImageName);
        $image = $newImageName;
    }

    // POINTS
    $points = [];
    for ($i = 1; $i <= 10; $i++) {
        $points[$i] = isset($_POST["point{$i}"]) ? 
                      mysqli_real_escape_string($conn, $_POST["point{$i}"]) : "";
    }

    // UPDATE QUERY
    $query = "UPDATE about SET 
                name='$name',
                title='$title',
                paragraph='$paragraph',
                image='$image',
                p1='{$points[1]}',
                p2='{$points[2]}',
                p3='{$points[3]}',
                p4='{$points[4]}',
                p5='{$points[5]}',
                p6='{$points[6]}',
                p7='{$points[7]}',
                p8='{$points[8]}',
                p9='{$points[9]}',
                p10='{$points[10]}'
              WHERE id='$id'";

    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('About data successfully updated.');
                window.location.href = 'about.php';
              </script>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    exit();
}



// -------------------------
// If form not submitted
// -------------------------
header("Location: about.php");
exit();

?>
