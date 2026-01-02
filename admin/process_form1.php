<?php
require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form_type = $_POST['form_type'];

    // ------------------- Determine Update or Insert -------------------
    $is_update = isset($_POST['id']) && !empty($_POST['id']);
    $id = $is_update ? $_POST['id'] : null;

    // ------------------- Handle File Upload -------------------
    $image_name = null;
    if (isset($_FILES['upload_img']) && $_FILES['upload_img']['error'] !== 4) {
        $fileName = $_FILES["upload_img"]["name"];
        $fileSize = $_FILES["upload_img"]["size"];
        $tmpName = $_FILES["upload_img"]["tmp_name"];

        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (!in_array($imageExtension, $validImageExtension)) {
            echo "<script>alert('Invalid image extension'); history.back();</script>";
            exit;
        } elseif ($fileSize > 5000000) {
            echo "<script>alert('Image size too large'); history.back();</script>";
            exit;
        } else {
            $newImageName = uniqid() . '.' . $imageExtension;
            $upload_dir = ($form_type === 'home_slider') ? 'img/home/' : 'img/home/';
            move_uploaded_file($tmpName, $upload_dir . $newImageName);
            $image_name = $newImageName;
        }
    }

    // ------------------- Process Slider Form -------------------
    if ($form_type === 'home_slider') {
        if ($is_update) {
            // Update
            if ($image_name) {
                $sql = "UPDATE home_slider SET image='$image_name' WHERE id='$id'";
            } else {
                $sql = "UPDATE home_slider SET image=image WHERE id='$id'";
            }
            $msg = 'Slider updated successfully!';
        } else {
            // Insert
            if (!$image_name) {
                echo "<script>alert('Image is required'); history.back();</script>";
                exit;
            }
            $sql = "INSERT INTO home_slider (image) VALUES ('$image_name')";
            $msg = 'Slider added successfully!';
        }
    }

    // ------------------- Process Labs & Infra Form -------------------
    if ($form_type === 'home_labs_infra') {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $point1 = $_POST['point1'];
        $point2 = $_POST['point2'];
        $point3 = $_POST['point3'];
        $point4 = $_POST['point4'];

        if ($is_update) {
            if ($image_name) {
                $sql = "UPDATE home_labs_infra SET name='$name', description='$description', point_1='$point1', point_2='$point2', point_3='$point3', point_4='$point4', image='$image_name' WHERE id='$id'";
            } else {
                $sql = "UPDATE home_labs_infra SET name='$name', description='$description', point_1='$point1', point_2='$point2', point_3='$point3', point_4='$point4' WHERE id='$id'";
            }
            $msg = 'Lab/Infra updated successfully!';
        } else {
            if (!$image_name) {
                echo "<script>alert('Image is required'); history.back();</script>";
                exit;
            }
            $sql = "INSERT INTO home_labs_infra (name, description, point_1, point_2, point_3, point_4, image) VALUES ('$name','$description','$point1','$point2','$point3','$point4','$image_name')";
            $msg = 'Lab/Infra added successfully!';
        }
    }

    // ------------------- Execute Query -------------------
    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('$msg');
                window.location.href = 'home.php';
              </script>";
        exit;
    } else {
        echo "<script>alert('Database error: ".mysqli_error($conn)."'); history.back();</script>";
        exit;
    }
}
?>
