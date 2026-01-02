<?php
// Session + auth handled in header.php
include 'header.php';
include 'connection.php';

$loggedAdmin = $_SESSION['admin_username'] ?? 'Admin';

// ------------------- Handle Edit Button Click -------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['edit_slider_id'])) {
        $_SESSION['edit_slider_id'] = (int)$_POST['edit_slider_id'];
    }
    if (isset($_POST['edit_lab_id'])) {
        $_SESSION['edit_lab_id'] = (int)$_POST['edit_lab_id'];
    }
}

// ------------------- Load Edit Data -------------------
$edit_mode1 = false;
$edit_data1 = [];

$edit_mode2 = false;
$edit_data2 = [];

if (isset($_SESSION['edit_slider_id'])) {
    $edit_mode1 = true;
    $id = $_SESSION['edit_slider_id'];
    $result = $conn->query("SELECT * FROM home_slider WHERE id=$id");
    $edit_data1 = $result->fetch_assoc();
    unset($_SESSION['edit_slider_id']);
}

if (isset($_SESSION['edit_lab_id'])) {
    $edit_mode2 = true;
    $id = $_SESSION['edit_lab_id'];
    $result = $conn->query("SELECT * FROM home_labs_infra WHERE id=$id");
    $edit_data2 = $result->fetch_assoc();
    unset($_SESSION['edit_lab_id']);
}
?>

<style>
.main-content { padding:20px; }
.form-container {
    background:#fff;
    padding:20px;
    border-radius:8px;
    box-shadow:0 0 10px rgba(0,0,0,0.1);
    margin-bottom:30px;
}
.form-column {
    display:flex;
    flex-direction:column;
    gap:10px;
}
.form-column input,
.form-column textarea {
    padding:10px;
    border:1px solid #ccc;
    border-radius:5px;
}
.preview-img {
    max-width:200px;
    border:1px solid #ccc;
}
.submit-btn {
    text-align:center;
    margin-top:15px;
}
.submit-btn input {
    padding:10px 25px;
    background:#007BFF;
    border:none;
    color:white;
    border-radius:5px;
    cursor:pointer;
}
table {
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
}
table th, table td {
    border:1px solid #ccc;
    padding:10px;
}
</style>

<div class="main-content">
    <h1>Welcome, <?= htmlspecialchars($loggedAdmin) ?></h1>

    <label>Select Form:</label>
    <select id="form-selector">
        <option value="form1">Slider Images</option>
        <option value="form2">Labs & Infra</option>
    </select>

    <!-- ================= SLIDER FORM ================= -->
    <div id="form1" class="form-container">
        <form action="process_form1.php" method="POST" enctype="multipart/form-data">
            <?php if ($edit_mode1): ?>
                <input type="hidden" name="id" value="<?= $edit_data1['id'] ?>">
            <?php endif; ?>

            <div class="form-column">
                <label>Image</label>
                <input type="file" name="upload_img" onchange="previewImage1(event)">
                <img id="preview-img1" class="preview-img"
                     src="<?= $edit_mode1 ? 'img/home/'.$edit_data1['image'] : '' ?>"
                     style="<?= $edit_mode1 ? '' : 'display:none;' ?>">
            </div>

            <input type="hidden" name="form_type" value="home_slider">
            <div class="submit-btn">
                <input type="submit" value="<?= $edit_mode1 ? 'Update' : 'Submit' ?>">
            </div>
        </form>

        <h3>Slider Data</h3>
        <table>
            <tr><th>Image</th><th>Actions</th></tr>
            <?php
            $result = $conn->query("SELECT * FROM home_slider");
            while ($row = $result->fetch_assoc()):
            ?>
            <tr>
                <td><img src="img/home/<?= $row['image'] ?>" width="100"></td>
                <td>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="edit_slider_id" value="<?= $row['id'] ?>">
                        <button type="submit">Edit</button>
                    </form> |
                    <a href="delete.php?id=<?= $row['id'] ?>&table=home_slider&file_location=img/home/&redirect=home.php"
                       onclick="return confirm('Delete this image?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <!-- ================= LABS FORM ================= -->
    <div id="form2" class="form-container">
        <form action="process_form1.php" method="POST" enctype="multipart/form-data">
            <?php if ($edit_mode2): ?>
                <input type="hidden" name="id" value="<?= $edit_data2['id'] ?>">
            <?php endif; ?>

            <div class="form-column">
                <label>Image</label>
                <input type="file" name="upload_img" onchange="previewImage2(event)">
                <img id="preview-img2" class="preview-img"
                     src="<?= $edit_mode2 ? 'img/home/'.$edit_data2['image'] : '' ?>"
                     style="<?= $edit_mode2 ? '' : 'display:none;' ?>">

                <input type="text" name="name" placeholder="Name" value="<?= $edit_mode2 ? $edit_data2['name'] : '' ?>" required>
                <textarea name="description" placeholder="Description (Max 170 Characters)" required><?= $edit_mode2 ? $edit_data2['description'] : '' ?></textarea>
                <input type="text" name="point1" placeholder="Point 1 (Max 100 Characters)" value="<?= $edit_mode2 ? $edit_data2['point_1'] : '' ?>">
                <input type="text" name="point2" placeholder="Point 2 (Max 100 Characters)" value="<?= $edit_mode2 ? $edit_data2['point_2'] : '' ?>">
                <input type="text" name="point3" placeholder="Point 3 (Max 100 Characters)" value="<?= $edit_mode2 ? $edit_data2['point_3'] : '' ?>">
                <input type="text" name="point4" placeholder="Point 4 (Max 100 Characters)" value="<?= $edit_mode2 ? $edit_data2['point_4'] : '' ?>">
            </div>

            <input type="hidden" name="form_type" value="home_labs_infra">
            <div class="submit-btn">
                <input type="submit" value="<?= $edit_mode2 ? 'Update' : 'Submit' ?>">
            </div>
        </form>

        <h3>Labs Data</h3>
        <table>
            <tr>
                <th>Name</th><th>Image</th><th>Description</th>
                <th>P1</th><th>P2</th><th>P3</th><th>P4</th><th>Actions</th>
            </tr>
            <?php
            $result = $conn->query("SELECT * FROM home_labs_infra");
            while ($row = $result->fetch_assoc()):
            ?>
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><img src="img/home/<?= $row['image'] ?>" width="80"></td>
                <td><?= htmlspecialchars($row['description']) ?></td>
                <td><?= htmlspecialchars($row['point_1']) ?></td>
                <td><?= htmlspecialchars($row['point_2']) ?></td>
                <td><?= htmlspecialchars($row['point_3']) ?></td>
                <td><?= htmlspecialchars($row['point_4']) ?></td>
                <td>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="edit_lab_id" value="<?= $row['id'] ?>">
                        <button type="submit">Edit</button>
                    </form> |
                    <a href="delete.php?id=<?= $row['id'] ?>&table=home_labs_infra&file_location=img/home/&redirect=home.php"
                       onclick="return confirm('Delete this record?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <?php include 'footer.php'; ?>
</div>

<script>
const selector = document.getElementById('form-selector');
const forms = document.querySelectorAll('.form-container');

function showForm(id){
    forms.forEach(f => f.style.display='none');
    document.getElementById(id).style.display='block';
}

showForm("<?= $edit_mode2 ? 'form2' : 'form1' ?>");

selector.onchange = () => showForm(selector.value);

function previewImage1(e){
    const img=document.getElementById('preview-img1');
    img.src=URL.createObjectURL(e.target.files[0]);
    img.style.display='block';
}
function previewImage2(e){
    const img=document.getElementById('preview-img2');
    img.src=URL.createObjectURL(e.target.files[0]);
    img.style.display='block';
}
</script>
