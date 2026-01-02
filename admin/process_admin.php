<?php
require 'connection.php';

// Ensure request is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    /* =========================================================
       1) CREATE ADMIN PROCESS
       ========================================================= */
    if (isset($_POST["create_admin"])) {

        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if ($password !== $confirm_password) {
            echo "<script>alert('Passwords do not match!'); window.history.back();</script>";
            exit;
        }

        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO admins (username, password) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $username, $hashedPassword);

        if ($stmt->execute()) {
            echo "<script>
                    alert('Admin Created Successfully');
                    window.location.href='create_admin.php';
                  </script>";
        } else {
            echo "<script>alert('Error creating admin');</script>";
        }

        exit;
    }


    /* =========================================================
       2) CHANGE PASSWORD PROCESS
       ========================================================= */
    if (isset($_POST["change_password"])) {

        $id = $_POST['id'];
        $password = $_POST['password'];
        $confirm = $_POST['confirm_password'];

        if ($password !== $confirm) {
            echo "<script>alert('Passwords do not match!'); window.history.back();</script>";
            exit;
        }

        $hashed = password_hash($password, PASSWORD_DEFAULT);

        $query = "UPDATE admins SET password=? WHERE id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $hashed, $id);

        if ($stmt->execute()) {
            echo "<script>
                    alert('Password Updated Successfully');
                    window.location.href='create_admin.php';
                  </script>";
        } else {
            echo "<script>alert('Error updating password');</script>";
        }

        exit;
    }
}
?>
