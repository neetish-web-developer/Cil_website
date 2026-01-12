<?php
include 'header.php';
include 'connection.php';

$id = null;
$title = "";

// 1. FETCH DATA FOR EDIT MODE
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $res = $conn->query("SELECT * FROM newsletters WHERE id=$id");
    if ($res->num_rows > 0) {
        $data = $res->fetch_assoc();
        $title = $data['title'];
    }
}

// 2. SAVE FORM (CREATE & UPDATE)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $updated_by = $_SESSION['admin_username']; // Using the session variable that works in your announcement form

    if (!empty($_POST['id'])) {
        // UPDATE EXISTING: Only title and updated_by
        $id = (int)$_POST['id'];
        $stmt = $conn->prepare("UPDATE newsletters SET title=?, updated_by=? WHERE id=?");
        $stmt->bind_param("ssi", $title, $updated_by, $id);
        $stmt->execute();
    } else {
        // CREATE NEW: Handle File Upload
        $file = $_FILES['newsletter_pdf'];
        $fileName = time() . '_' . basename($file['name']);
        $targetPath = "docs/newsletters/" . $fileName;

        if (!is_dir('docs/newsletters/')) {
            mkdir('docs/newsletters/', 0777, true);
        }

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            $stmt = $conn->prepare("INSERT INTO newsletters (title, file_path, updated_by) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $title, $fileName, $updated_by);
            $stmt->execute();
        }
    }

    header("Location: newsletter.php");
    exit;
}
?>

<div class="main-content" style="padding:20px; font-family: sans-serif;">
    <h2><?= $id ? "Edit" : "Upload" ?> Newsletter</h2>

    <form method="POST" enctype="multipart/form-data" style="max-width: 500px; background: #fff; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
        <input type="hidden" name="id" value="<?= $id ?>">

        <div style="margin-bottom: 15px;">
            <label style="display:block; margin-bottom: 5px; font-weight: bold;">Newsletter Title*</label>
            <input type="text" name="title" value="<?= htmlspecialchars($title) ?>" required placeholder="e.g. October 2026 Edition" style="width: 100%; padding: 8px; box-sizing: border-box;">
        </div>

        <?php if (!$id): ?>
        <div style="margin-bottom: 15px;">
            <label style="display:block; margin-bottom: 5px; font-weight: bold;">Select PDF File*</label>
            <input type="file" name="newsletter_pdf" accept="application/pdf" required style="width: 100%;">
        </div>
        <?php else: ?>
        <p style="font-size: 0.85em; color: #666; margin-bottom: 15px; background: #f9f9f9; padding: 10px; border-left: 3px solid #3b82f6;">
            <strong>Note:</strong> You are editing the title only. To change the PDF file, please delete this entry and upload a new one.
        </p>
        <?php endif; ?>

        <div style="margin-top: 20px;">
            <button type="submit" style="background: #3b82f6; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; font-weight: bold;">
                Save Newsletter
            </button>
            <a href="newsletter.php" style="margin-left: 10px; color: #666; text-decoration: none;">Cancel</a>
        </div>
    </form>
    <?php include 'footer.php'; ?>
</div>

