<?php
include 'header.php';
include 'connection.php';

// Delete announcement
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM announcements WHERE id=$id");
    header("Location: announcement.php");
    exit;
}

// Toggle pin/unpin
if (isset($_GET['pin'])) {
    $id = (int)$_GET['pin'];
    // Fetch current pin status
    $row = $conn->query("SELECT is_pinned FROM announcements WHERE id=$id")->fetch_assoc();
    $newStatus = $row['is_pinned'] ? 0 : 1;
    $conn->query("UPDATE announcements SET is_pinned=$newStatus WHERE id=$id");
    header("Location: announcement.php");
    exit;
}

$result = $conn->query("SELECT * FROM announcements ORDER BY created_at DESC");
?>

<div class="main-content" style="padding:20px;">
    <h2>Announcements</h2>

    <a href="announcement_form.php">➕ Add New Announcement</a>

    <table border="1" cellpadding="10" cellspacing="0" style="margin-top:15px;width:100%;">
        <tr>
            <th>Title</th>
            <th>Message</th>
            <th>Link</th>
            <th>Updated By</th>
            <th>Date</th>
            <th>Action</th>
        </tr>

        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['title']) ?></td>
            <td><?= htmlspecialchars($row['message']) ?></td>
            <td><?= htmlspecialchars($row['link']) ?></td>
            <td><?= htmlspecialchars($row['updated_by']) ?></td>
            <td><?= $row['created_at'] ?></td>
            <td>
                <a href="announcement_form.php?id=<?= $row['id'] ?>">Edit</a> |
                <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Delete this?')">Delete</a> |
                <a href="?pin=<?= $row['id'] ?>">
                    <?= $row['is_pinned'] ? '📌 Pin' : ' Unpin' ?>
                </a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <?php include 'footer.php'; ?>
</div>


