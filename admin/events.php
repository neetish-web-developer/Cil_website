<?php
include 'header.php';
include 'connection.php';

// ------------------- Handle Edit Button Click -------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_event_id'])) {
    // Ensure session is started if not already
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['edit_event_id'] = $_POST['edit_event_id'];
}

// ------------------- Load Edit Data from Session -------------------
$edit_mode = false;
$edit_data = [];

if (isset($_SESSION['edit_event_id'])) {
    $edit_mode = true;
    $id = $_SESSION['edit_event_id'];
    $result = $conn->query("SELECT * FROM events WHERE id='$id'");
    $edit_data = $result->fetch_assoc();
    unset($_SESSION['edit_event_id']);
}
?>

<style>
    .main-content { padding: 20px; }
    .form-container { max-width: 600px; margin: 0 auto; }
    .form-column { display: flex; flex-direction: column; gap: 10px; }
    .form-column label { font-weight: bold; margin-bottom: 5px; }
    .form-column input, .form-column textarea { padding: 10px; font-size: 16px; border: 1px solid #ccc; border-radius: 5px; }
    .form-column input[type="file"] { padding: 3px; }
    .form-column textarea { resize: vertical; height: 100px; }
    .submit-btn { display: flex; justify-content: center; margin-top: 20px; }
    .submit-btn input { padding: 10px 20px; font-size: 18px; border: none; border-radius: 5px; background-color: #007BFF; color: white; cursor: pointer; }
    .submit-btn input:hover { background-color: #0056b3; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    table th, table td { border: 1px solid #ccc; padding: 10px; text-align: left; }
    table th { background-color: #f4f4f4; }
    table img { max-width: 100px; }
    #preview-box { margin-top: 10px; text-align: center; }
    #preview-img { max-width: 200px; border: 1px solid #ccc; padding: 5px; border-radius: 5px; }
</style>

<div class="main-content">
    <h1>Events</h1>
    <div class="form-container">
        <form action="process_events.php" method="POST" enctype="multipart/form-data">
            <?php if ($edit_mode): ?>
                <input type="hidden" name="id" value="<?= $edit_data['id'] ?>">
            <?php endif; ?>
            <div class="form-column">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required value="<?= $edit_mode ? $edit_data['title'] : '' ?>">

                <label for="description">Description:</label>
                <textarea id="description" name="description" required><?= $edit_mode ? $edit_data['description'] : '' ?></textarea>

                <label for="image">Image:</label>
                <input type="file" id="image" name="upload_img" accept="image/*" onchange="previewImage(event)">
                <div id="preview-box" style="<?= $edit_mode ? '' : 'display:none;' ?>">
                    <img id="preview-img" src="<?= $edit_mode ? 'img/events/'.$edit_data['image'] : '' ?>" alt="Preview">
                </div>
            </div>

            <div class="submit-btn">
                <input type="submit" name="<?= $edit_mode ? 'update' : 'submit' ?>" value="<?= $edit_mode ? 'Update' : 'Submit' ?>">
            </div>
        </form>
    </div>

    <?php
    // --- UPDATED QUERY TO SHOW LATEST FIRST ---
    $sql = "SELECT * FROM events ORDER BY id DESC";
    $result = $conn->query($sql);
    ?>

    <h1>Event Data</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row['title']."</td>";
                echo "<td>".$row['description']."</td>";
                echo "<td><img src='img/events/".$row['image']."' alt='Event Image' /></td>";
                echo "<td>
                        <form method='POST' style='display:inline;'>
                            <input type='hidden' name='edit_event_id' value='".$row['id']."'>
                            <button type='submit'>Edit</button>
                        </form> | 
                        <a href='delete.php?id=".$row['id']."&table=events&file_location=img/events/&redirect=events.php' onclick=\"return confirm('Are you sure?')\">Delete</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No data found</td></tr>";
        }
        ?>
    </table>
    <?php include 'footer.php'; ?>
</div>

<script>
function previewImage(event){
    const img = document.getElementById('preview-img');
    const box = document.getElementById('preview-box');
    if (event.target.files.length > 0) {
        img.src = URL.createObjectURL(event.target.files[0]);
        box.style.display = 'block';
    }
}
</script>