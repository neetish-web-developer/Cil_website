<?php
require 'connection.php';

if (isset($_POST["submit"]) || isset($_POST["update"])) {

    $isUpdate = isset($_POST["update"]);
    $id = $isUpdate ? $_POST['id'] : null;

    /* ---------- Sanitize Inputs ---------- */
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $company_name = mysqli_real_escape_string($conn, $_POST['company_name']);
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $trl_level = (int) $_POST['trl_level'];
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $preincubation_date = !empty($_POST['preincubation_date'])
        ? mysqli_real_escape_string($conn, $_POST['preincubation_date'])
        : NULL;

    /* ---------- TRL Validation ---------- */
    if ($trl_level < 1 || $trl_level > 9) {
        die("<script>alert('Invalid TRL Level'); window.location.href='portfolio.php';</script>");
    }

    $imageName = '';

    /* ---------- Image Upload ---------- */
    if (isset($_FILES["upload_img"]) && $_FILES["upload_img"]["error"] !== 4) {

        $fileName = $_FILES["upload_img"]["name"];
        $fileSize = $_FILES["upload_img"]["size"];
        $tmpName  = $_FILES["upload_img"]["tmp_name"];

        $validExt = ['jpg', 'jpeg', 'png'];
        $imageExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (!in_array($imageExt, $validExt)) {
            die("<script>alert('Invalid image extension'); window.location.href='portfolio.php';</script>");
        }

        if ($fileSize > 5000000) {
            die("<script>alert('Image size too large (Max 5MB)'); window.location.href='portfolio.php';</script>");
        }

        $imageName = uniqid('portfolio_', true) . '.' . $imageExt;
        move_uploaded_file($tmpName, 'img/portfolio/' . $imageName);
    }

    /* ================= UPDATE ================= */
    if ($isUpdate) {

        $query = "UPDATE portfolio SET
                    name='$name',
                    company_name='$company_name',
                    product_name='$product_name',
                    trl_level='$trl_level',
                    preincubation_date=" . ($preincubation_date ? "'$preincubation_date'" : "NULL") . ",
                    message='$message'";

        if (!empty($imageName)) {
            $query .= ", image='$imageName'";
        }

        $query .= " WHERE id='$id'";

        if (mysqli_query($conn, $query)) {
            echo "<script>
                    alert('Portfolio updated successfully');
                    window.location.href='portfolio.php';
                  </script>";
        } else {
            echo "<script>alert('Database error');</script>";
        }

    } 
    /* ================= INSERT ================= */
    else {

        if (!$imageName) {
            die("<script>alert('Image is required'); window.location.href='portfolio.php';</script>");
        }

        $query = "INSERT INTO portfolio
                    (name, company_name, product_name, trl_level, preincubation_date, message, image)
                  VALUES
                    ('$name', '$company_name', '$product_name', '$trl_level',
                     " . ($preincubation_date ? "'$preincubation_date'" : "NULL") . ",
                     '$message', '$imageName')";

        if (mysqli_query($conn, $query)) {
            echo "<script>
                    alert('Portfolio added successfully');
                    window.location.href='portfolio.php';
                  </script>";
        } else {
            echo "<script>alert('Database error');</script>";
        }
    }
}
?>
