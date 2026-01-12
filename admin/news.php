<?php
include 'header.php';
include 'connection.php';

// Check if admin is logged in (optional but recommended)
// if (!isset($_SESSION['username'])) {
//     header("Location: index.php");
//     exit();
// }

// Delete Newsletter
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    
    // Fetch filename to delete physical file from server
    $res = $conn->query("SELECT file_path FROM newsletters WHERE id=$id");
    if ($row = $res->fetch_assoc()) {
        $file_to_delete = "docs/newsletters/" . $row['file_path'];
        if (file_exists($file_to_delete)) {
            unlink($file_to_delete);
        }
    }
    
    $conn->query("DELETE FROM newsletters WHERE id=$id");
    header("Location: newsletter.php");
    exit;
}

// Toggle Pin/Unpin (Optional feature for newsletters)
if (isset($_GET['pin'])) {
    $id = (int)$_GET['pin'];
    $row = $conn->query("SELECT is_pinned FROM newsletters WHERE id=$id")->fetch_assoc();
    $newStatus = $row['is_pinned'] ? 0 : 1;
    $conn->query("UPDATE newsletters SET is_pinned=$newStatus WHERE id=$id");
    header("Location: newsletter.php");
    exit;
}

$result = $conn->query("SELECT * FROM newsletters ORDER BY upload_date DESC");
?>

<div class="main-content" style="padding:20px;">
    <h2>Newsletter Archive Management</h2>

    <a href="newsletter_form.php" style="text-decoration:none; background:#3b82f6; color:white; padding:8px 15px; border-radius:5px; display:inline-block;">➕ Upload New Newsletter</a>

    <table border="1" cellpadding="10" cellspacing="0" style="margin-top:20px; width:100%; border-collapse:collapse; font-family: sans-serif;">
        <tr style="background-color: #f8fafc; text-align: left;">
            <th>Title</th>
            <th>File Name</th>
            <th>Updated By</th>
            <th>Date</th>
            <th>Action</th>
        </tr>

        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td style="font-weight:bold;"><?= htmlspecialchars($row['title']) ?></td>
                <td style="color: #64748b; font-size: 0.9em;"><?= htmlspecialchars($row['file_path']) ?></td>
                <td><?= htmlspecialchars($row['updated_by']) ?></td>
                <td><?= date('d M Y', strtotime($row['upload_date'])) ?></td>
                <td>
                    <a href="docs/newsletters/<?= $row['file_path'] ?>" target="_blank">View</a> |
                    <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Delete this newsletter and its file?')" style="color:red;">Delete</a> |
                    
                </td>
            </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" style="text-align:center;">No newsletters found.</td>
            </tr>
        <?php endif; ?>
    </table>

    <?php include 'footer.php'; ?>
</div>