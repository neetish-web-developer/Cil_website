<?php
include 'header.php';
include 'connection.php';

$id = null;
$title = $message = $link ="";

// Edit mode
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $res = $conn->query("SELECT * FROM announcements WHERE id=$id");
    $data = $res->fetch_assoc();
    $title = $data['title'];
    $link = $data['link'];
    $message = $data['message'];
}

// Save form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = $_POST['title'];
    $link = $_POST['link'];
    $message = $_POST['message'];
    $updated_by = $_SESSION['admin_username'];

    if (!empty($_POST['id'])) {
        $id = (int)$_POST['id'];
        $stmt = $conn->prepare(
            "UPDATE announcements SET title=?, link=?,message=?, updated_by=? WHERE id=?"
        );
        $stmt->bind_param("ssssi", $title, $link, $message, $updated_by, $id);
    } else {
        $stmt = $conn->prepare(
            "INSERT INTO announcements (title, link, message, updated_by) VALUES (?,?,?,?)"
        );
        $stmt->bind_param("ssss", $title, $link, $message, $updated_by);
    }

    $stmt->execute();
    header("Location: announcement.php");
    exit;
}
?>

<div class="main-content" style="padding:20px;">
    <h2><?= $id ? "Edit" : "Add" ?> Announcement</h2>

    <form method="POST">
        <input type="hidden" name="id" value="<?= $id ?>">

        <label>Title*</label><br>
        <input type="text" name="title" value="<?= htmlspecialchars($title) ?>" required><br><br>

        <label>Document / Registration Link</label><br>
        <input type="text" name="link" value="<?= htmlspecialchars($link) ?>" ><br><br>

        <label>Message*</label><br>
        <textarea name="message" rows="5" required><?= htmlspecialchars($message) ?></textarea><br><br>

        <button type="submit">Save</button>
        <a href="announcement.php">Cancel</a>
    </form>
    <?php include 'footer.php'; ?>
</div>


