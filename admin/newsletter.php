<?php
include 'header.php';
include 'connection.php';

$id = null;
$title = "";
$btn_text = "Upload Newsletter";

// 1. HANDLE EDIT FETCHING
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $res = $conn->query("SELECT * FROM newsletters WHERE id=$id");
    if ($res->num_rows > 0) {
        $data = $res->fetch_assoc();
        $title = $data['title'];
        $btn_text = "Update Title";
    }
}

// 2. HANDLE DELETE
if (isset($_GET['delete'])) {
    $del_id = (int)$_GET['delete'];
    $res = $conn->query("SELECT file_path FROM newsletters WHERE id=$del_id");
    if ($row = $res->fetch_assoc()) {
        $path = "docs/newsletters/" . $row['file_path'];
        if (file_exists($path)) { unlink($path); }
    }
    $conn->query("DELETE FROM newsletters WHERE id=$del_id");
    header("Location: newsletter.php");
    exit;
}

// 3. HANDLE FORM SUBMISSION
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form_title = $_POST['title'];
    $updated_by = $_SESSION['admin_username'];

    if (!empty($_POST['id'])) {
        $update_id = (int)$_POST['id'];
        $stmt = $conn->prepare("UPDATE newsletters SET title=?, updated_by=? WHERE id=?");
        $stmt->bind_param("ssi", $form_title, $updated_by, $update_id);
        $stmt->execute();
    } else {
        if (isset($_FILES['newsletter_pdf']) && $_FILES['newsletter_pdf']['error'] == 0) {
            $file = $_FILES['newsletter_pdf'];
            $fileName = time() . '_' . basename($file['name']);
            $targetPath = "docs/newsletters/" . $fileName;
            if (!is_dir('docs/newsletters/')) { mkdir('docs/newsletters/', 0777, true); }
            if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                $stmt = $conn->prepare("INSERT INTO newsletters (title, file_path, updated_by) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $form_title, $fileName, $updated_by);
                $stmt->execute();
            }
        }
    }
    header("Location: newsletter.php");
    exit;
}

$result = $conn->query("SELECT * FROM newsletters ORDER BY upload_date DESC");
?>

<div class="main-content" style="padding: 20px; font-family: sans-serif;">
    
    <div style="background: #fff; padding: 30px; border-radius: 8px; border: 1px solid #ddd; margin-bottom: 40px;">
        <h2 style="margin-top:0; color: #333; display: flex; align-items: center; gap: 10px;">
            <span style="color: #6366f1; font-size: 1.5rem;">+</span> 
            <?= $id ? "Edit Newsletter Title" : "Upload New Newsletter" ?>
        </h2>
        
        <form method="POST" enctype="multipart/form-data" style="max-width: 600px; margin-top: 20px;">
            <input type="hidden" name="id" value="<?= $id ?>">

            <div style="margin-bottom: 20px;">
                <label style="display:block; font-weight:bold; margin-bottom:8px;">Newsletter Title*</label>
                <input type="text" name="title" value="<?= htmlspecialchars($title) ?>" required 
                       placeholder="e.g. Monthly Newsletter of January 2026" 
                       style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; font-size: 1rem;">
            </div>

            <?php if (!$id): ?>
            <div style="margin-bottom: 25px;">
                <label style="display:block; font-weight:bold; margin-bottom:8px;">Select PDF File*</label>
                <input type="file" name="newsletter_pdf" accept="application/pdf" required 
                       style="width: 100%; padding: 10px; border: 1px solid #eee; border-radius: 6px; background: #f9f9f9;">
            </div>
            <?php endif; ?>

            <div style="display: flex; align-items: center; gap: 15px;">
                <button type="submit" style="background: #2563eb; color: white; border: none; padding: 12px 30px; border-radius: 6px; cursor: pointer; font-weight: bold; font-size: 1rem;">
                    <?= $btn_text ?>
                </button>
                <?php if($id): ?>
                    <a href="newsletter.php" style="text-decoration:none; color:#dc2626; font-weight: bold;">Cancel Edit</a>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <hr style="border: 0; border-top: 1px solid #eee; margin-bottom: 30px;">

    <h2 style="color: #333; margin-bottom: 20px;">Previous Newsletters</h2>
    
    <div style="overflow-x: auto; background: #fff; border: 1px solid #ddd; border-radius: 8px;">
        <table border="0" cellpadding="15" cellspacing="0" style="width:100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background-color: #f8fafc; border-bottom: 2px solid #edf2f7;">
                    <th style="color: #475569;">Title</th>
                    <th style="color: #475569;">File Path</th>
                    <th style="color: #475569;">Updated By</th>
                    <th style="color: #475569;">Upload Date</th>
                    <th style="color: #475569; text-align: center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="font-weight: 600; color: #1e293b;"><?= htmlspecialchars($row['title']) ?></td>
                        <td>
                            <a href="docs/newsletters/<?= $row['file_path'] ?>" target="_blank" style="color: #3b82f6; text-decoration: none; word-break: break-all;">
                                <?= htmlspecialchars($row['file_path']) ?>
                            </a>
                        </td>
                        <td style="color: #64748b;"><?= htmlspecialchars($row['updated_by']) ?></td>
                        <td style="color: #64748b;"><?= date('M d, Y', strtotime($row['upload_date'])) ?></td>
                        <td style="text-align: center;">
                            <a href="newsletter.php?id=<?= $row['id'] ?>" style="color: #059669; text-decoration: none; font-weight: bold; margin-right: 10px;">Edit</a>
                            <span style="color: #cbd5e1;">|</span>
                            <a href="newsletter.php?delete=<?= $row['id'] ?>" onclick="return confirm('Delete this newsletter?')" style="color: #dc2626; text-decoration: none; font-weight: bold; margin-left: 10px;">Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 40px; color: #94a3b8;">No records found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php include 'footer.php'; ?>
</div>

