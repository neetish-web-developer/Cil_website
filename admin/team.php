<?php
include 'header.php';
require 'connection.php';

// ------------------- Handle Edit Button Click -------------------
$edit_mode = false;
$edit_data = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_team_id'])) {
    $_SESSION['edit_team_id'] = $_POST['edit_team_id'];
}

if (isset($_SESSION['edit_team_id'])) {
    $edit_mode = true;
    $id = $_SESSION['edit_team_id'];
    $result = $conn->query("SELECT * FROM team WHERE id='$id'");
    $edit_data = $result->fetch_assoc();
    unset($_SESSION['edit_team_id']);
}
?>

<div class="main-content">
    <h1>Manage Team Members</h1>

    <!-- Form to Add/Edit Team Member -->
    <div class="form-container">
        <form action="process_team.php" method="POST" enctype="multipart/form-data">
            <?php if($edit_mode): ?>
                <input type="hidden" name="id" value="<?= $edit_data['id'] ?>">
            <?php endif; ?>

            <div class="form-column">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?= $edit_mode ? $edit_data['name'] : '' ?>" required>

                <label for="designation">Designation:</label>
                <input type="text" id="designation" name="designation" value="<?= $edit_mode ? $edit_data['designation'] : '' ?>" required>

                <label for="image">Image:</label>
                <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(event)">
                <div class="preview-box" style="<?= $edit_mode ? '' : 'display:none;' ?>">
                    <img id="preview-img" class="preview-img" src="<?= $edit_mode ? 'img/team/'.$edit_data['image'] : '' ?>" alt="Preview">
                </div>
            </div>

            <div class="submit-btn">
                <input type="submit" name="<?= $edit_mode ? 'update_team' : 'add_team' ?>" value="<?= $edit_mode ? 'Update' : 'Add Member' ?>">
            </div>
        </form>
    </div>

    <!-- Table Listing Team Members -->
    <?php
    $result = $conn->query("SELECT * FROM team ORDER BY id ASC");
    ?>
    <h1 style="margin-top:30px;">Team Members</h1>
    <table>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Designation</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td><img src='img/team/".$row['image']."' alt='Team Image' /></td>";
                echo "<td>".$row['name']."</td>";
                echo "<td>".$row['designation']."</td>";
                echo "<td>
                        <form method='POST' style='display:inline;'>
                            <input type='hidden' name='edit_team_id' value='".$row['id']."'>
                            <button type='submit'>Edit</button>
                        </form> |
                        <a href='delete.php?id=".$row['id']."&table=team&file_location=img/team/&redirect=team.php'>Delete</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No team members found</td></tr>";
        }
        ?>
    </table>
    <?php include 'footer.php'; ?>
</div>



<script>
// Live image preview
function previewImage(event){
    const img = document.getElementById('preview-img');
    const box = img.parentElement;
    img.src = URL.createObjectURL(event.target.files[0]);
    box.style.display = 'block';
}
</script>
