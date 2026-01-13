<?php
// if (session_status() == PHP_SESSION_NONE) {
//     session_start();
// }

include 'connection.php';

/* ------------------- Handle Edit Button Click ------------------- */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'])) {
    $_SESSION['edit_portfolio_id'] = $_POST['edit_id'];
}

/* ------------------- Load Edit Data ------------------- */
$edit_mode = false;
$edit_data = [];

if (isset($_SESSION['edit_portfolio_id'])) {
    $edit_mode = true;
    $id = $_SESSION['edit_portfolio_id'];
    $result = $conn->query("SELECT * FROM portfolio WHERE id='$id'");
    $edit_data = $result->fetch_assoc();
    unset($_SESSION['edit_portfolio_id']);
}
?>

<?php include 'header.php'; ?>

<style>
.main-content { padding: 20px; }
.form-container { max-width: 900px; margin: 0 auto; }
.form-column { display: flex; flex-direction: column; gap: 10px; }
.form-column label { font-weight: bold; }
.form-column input, .form-column textarea, .form-column select {
    padding: 10px; font-size: 16px; border: 1px solid #ccc; border-radius: 5px;
}
.form-column textarea { resize: vertical; height: 100px; }
.form-group { display: flex; flex-wrap: wrap; gap: 20px; }
.form-column { flex: 1; min-width: 280px; }
.submit-btn { text-align: center; margin-top: 20px; }
.submit-btn input {
    padding: 12px 25px; font-size: 18px; border: none;
    border-radius: 5px; background-color: #007BFF; color: white; cursor: pointer;
}
.submit-btn input:hover { background-color: #0056b3; }
table { width: 100%; border-collapse: collapse; margin-top: 30px; }
table th, table td { border: 1px solid #ccc; padding: 10px; }
table th { background-color: #f4f4f4; }
table img { max-width: 100px; }
#preview-img { max-width: 200px; border: 1px solid #ccc; padding: 5px; }
</style>

<div class="main-content">
<h1>Portfolio</h1>

<div class="form-container">
<form action="process_portfolio.php" method="POST" enctype="multipart/form-data">

<?php if($edit_mode): ?>
    <input type="hidden" name="id" value="<?= $edit_data['id'] ?>">
<?php endif; ?>

<div class="form-group">
<div class="form-column">

<label>Name (Director):</label>
<input type="text" name="name" value="<?= $edit_mode ? $edit_data['name'] : '' ?>" required>

<label>Company Name:</label>
<input type="text" name="company_name" value="<?= $edit_mode ? $edit_data['company_name'] : '' ?>" required>

<label>Product Name:</label>
<input type="text" name="product_name" value="<?= $edit_mode ? $edit_data['product_name'] : '' ?>" required>

<label>TRL Level (1–9):</label>
<select name="trl_level" required>
    <option value="">Select TRL</option>
    <?php for($i=1;$i<=9;$i++): ?>
        <option value="<?= $i ?>" <?= ($edit_mode && $edit_data['trl_level']==$i) ? 'selected' : '' ?>>
            TRL <?= $i ?>
        </option>
    <?php endfor; ?>
</select>

<label>Pre-Incubation Date (Optional):</label>
<input type="date" name="preincubation_date"
       value="<?= $edit_mode ? $edit_data['preincubation_date'] : '' ?>">

</div>

<div class="form-column">
<label>Message:</label>
<textarea name="message" required><?= $edit_mode ? $edit_data['message'] : '' ?></textarea>

<label>Image:</label>
<input type="file" name="upload_img" accept="image/*" onchange="previewImage(event)">

<?php if($edit_mode && $edit_data['image']): ?>
    <img id="preview-img" src="img/portfolio/<?= $edit_data['image'] ?>">
<?php endif; ?>
</div>
</div>

<div class="submit-btn">
<input type="submit" name="<?= $edit_mode ? 'update' : 'submit' ?>"
       value="<?= $edit_mode ? 'Update' : 'Submit' ?>">
</div>

</form>
</div>

<?php
$result = $conn->query("SELECT * FROM portfolio ORDER BY id DESC");
?>

<h1>Portfolio Data</h1>
<table>
<tr>
<th>Director</th>
<th>Company</th>
<th>Product</th>
<th>Message</th>
<th>TRL</th>
<th>Pre-Incubation</th>
<th>Image</th>
<th>Actions</th>
</tr>

<?php
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
?>
<tr>
<td><?= $row['name'] ?></td>
<td><?= $row['company_name'] ?></td>
<td><?= $row['product_name'] ?></td>
<td style="max-width:250px;">
    <?= nl2br(htmlspecialchars($row['message'])) ?>
</td>
<td>TRL <?= $row['trl_level'] ?></td>
<td><?= $row['preincubation_date'] ?: '—' ?></td>
<td><img src="img/portfolio/<?= $row['image'] ?>"></td>
<td>
<form method="POST" style="display:inline;">
<input type="hidden" name="edit_id" value="<?= $row['id'] ?>">
<button type="submit">Edit</button>
</form> |
<a href="delete2.php?id=<?= $row['id'] ?>&table=portfolio&file_location=img/portfolio/&redirect=portfolio.php">
Delete</a>
</td>
</tr>
<?php } } else { ?>
<tr><td colspan="7">No data found</td></tr>
<?php } ?>
</table>

<?php include 'footer.php'; ?>
</div>

<script>
function previewImage(event){
    document.getElementById('preview-img').src =
        URL.createObjectURL(event.target.files[0]);
}
</script>

</body>
</html>
