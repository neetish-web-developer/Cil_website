<?php
session_start();
require 'connection.php';

if (!isset($_SESSION['admin_username'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $conn->prepare("DELETE FROM announcements WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header("Location: announcements.php");
exit;
