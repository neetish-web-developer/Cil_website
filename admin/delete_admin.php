<?php
require 'connection.php';

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM admins WHERE id='$id'");

echo "<script>alert('Admin Deleted'); window.location.href='create_admin.php';</script>";
?>
