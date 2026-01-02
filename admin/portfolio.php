<?php
// if (session_status() == PHP_SESSION_NONE) {
//     session_start();
// }

include 'connection.php';

// ------------------- Handle Edit Button Click -------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'])) {
    $_SESSION['edit_portfolio_id'] = $_POST['edit_id'];
}

// ------------------- Load Edit Data from Session -------------------
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
.form-container { max-width: 800px; margin: 0 auto; }
.form-column { display: flex; flex-direction: column; gap: 10px; }
.form-column label { font-weight: bold; margin-bottom: 5px; }
.form-column input, .form-column textarea { padding: 10px; font-size: 16px; border: 1px solid #ccc; border-radius: 5px; }
.form-column input[type="file"] { padding: 3px; }
.form-column textarea { resize: vertical; height: 100px; }
.form-group { display: flex; flex-wrap: wrap; gap: 20px; }
.form-column, .form-group { width: 100%; }
.submit-btn { display: flex; justify-content: center; margin-top: 20px; }
.submit-btn input { padding: 10px 20px; font-size: 18px; border: none; border-radius: 5px; background-color: #007BFF; color: white; cursor: pointer; }
.submit-btn input:hover { background-color: #0056b3; }
table { width: 100%; border-collapse: collapse; margin-top: 20px; }
table th, table td { border: 1px solid #ccc; padding: 10px; text-align: left; }
table th { background-color: #f4f4f4; }
table img { max-width: 100px; }
#preview-box { margin-top: 10px; text-align: center; }
#preview-img {
        max-width: 200px;
        border: 1px solid #ccc;
        padding: 5px;
        border-radius: 5px;
}
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
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?= $edit_mode ? $edit_data['name'] : '' ?>" required>

                    <label for="company_name">Company Name:</label>
                    <input type="text" id="company_name" name="company_name" value="<?= $edit_mode ? $edit_data['company_name'] : '' ?>" required>
                </div>

                <div class="form-column">
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" required><?= $edit_mode ? $edit_data['message'] : '' ?></textarea>

                    <label for="image">Image:</label>
                    <input type="file" id="image" name="upload_img" accept="image/*" onchange="previewImage(event)">
                    <div id="preview-box" style="<?= $edit_mode ? '' : 'display:none;' ?>">
                        <img id="preview-img" src="<?= $edit_mode ? 'img/portfolio/'.$edit_data['image'] : '' ?>" alt="Preview">
                    </div>
                </div>
            </div>

            <div class="submit-btn">
                <input type="submit" name="<?= $edit_mode ? 'update' : 'submit' ?>" value="<?= $edit_mode ? 'Update' : 'Submit' ?>">
            </div>
        </form>
    </div>

    <?php
    $sql = "SELECT * FROM portfolio";
    $result = $conn->query($sql);
    ?>

    <h1>Portfolio Data</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>Company Name</th>
            <th>Message</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row['name']."</td>";
                echo "<td>".$row['company_name']."</td>";
                echo "<td>".$row['message']."</td>";
                echo "<td><img src='img/portfolio/".$row['image']."' alt='Portfolio Image' /></td>";
                echo "<td>
                        <form method='POST' style='display:inline;'>
                            <input type='hidden' name='edit_id' value='".$row['id']."'>
                            <button type='submit'>Edit</button>
                        </form> |
                        <a href='delete2.php?id=".$row['id']."&table=portfolio&file_location=img/portfolio/&redirect=portfolio.php'>Delete</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No data found</td></tr>";
        }
        ?>
    </table>
    <?php include 'footer.php'; ?>
</div>

<script>
function previewImage(event){
    const img = document.getElementById('preview-img');
    const box = document.getElementById('preview-box');
    img.src = URL.createObjectURL(event.target.files[0]);
    box.style.display = 'block';
}
</script>


</body>
</html>
