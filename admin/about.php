<?php include 'header.php'; ?>
<?php include 'connection.php'; ?>

<?php
$edit_mode = false;
$edit_data = [];

if (isset($_GET['edit'])) {
    $edit_mode = true;
    $id = $_GET['edit'];
    $result = $conn->query("SELECT * FROM about WHERE id='$id'");
    $edit_data = $result->fetch_assoc();
}
?>

<style>
    .main-content { padding: 20px; }
    .form-container { max-width: 800px; margin: 0 auto; }
    .form-column { display: flex; flex-direction: column; gap: 10px; }
    .form-column label { font-weight: bold; margin-bottom: 5px; }
    .form-column input,
    .form-column textarea {
        padding: 10px; font-size: 16px;
        border: 1px solid #ccc; border-radius: 5px;
    }
    .form-column input[type="file"] { padding: 3px; }
    .form-column textarea { resize: vertical; height: 100px; }
    .form-group { display: flex; flex-wrap: wrap; gap: 20px; }
    .form-column, .form-group { width: 100%; }
    .form-group .form-column { flex: 1; }
    #preview-box { margin-top: 10px; text-align: center; }
    #preview-img {
        max-width: 200px;
        border: 1px solid #ccc;
        padding: 5px;
        border-radius: 5px;
    }
    .submit-btn { display: flex; justify-content: center; margin-top: 20px; }
    .submit-btn input {
        padding: 10px 20px; font-size: 18px;
        border: none; border-radius: 5px;
        background-color: #007BFF; color: white;
        cursor: pointer;
    }
    .submit-btn input:hover { background-color: #0056b3; }

    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    table th, table td {
        border: 1px solid #ccc; padding: 10px; text-align: left;
    }
    table th { background-color: #f4f4f4; }
    table img { max-width: 100px; }
</style>

<div class="main-content">

    <h1>
        <?php echo $edit_mode ? $edit_data['name'] . " Data Updation" : "About Us"; ?>
    </h1>

    <div class="form-container">
        <form action="process_about.php" method="POST" enctype="multipart/form-data">

            <?php if ($edit_mode): ?>
                <input type="hidden" name="id" value="<?= $edit_data['id'] ?>">
            <?php endif; ?>

            <div class="form-column">

                <label for="image">Image:</label>
                <input type="file" id="image" name="upload_img" accept="image/*" onchange="previewImage(event)">

                <!-- IMAGE PREVIEW BOX -->
                <div id="preview-box" style="<?= $edit_mode ? '' : 'display:none;' ?>">
                    <img id="preview-img"
                         src="<?= $edit_mode ? 'img/about/'.$edit_data['image'] : '' ?>"
                         alt="Preview">
                </div>

                <label for="name">Name:</label>
                <input type="text" id="name" name="name"
                       value="<?= $edit_mode ? $edit_data['name'] : '' ?>" required>

                <label for="paragraph">Paragraph:</label>
                <textarea id="paragraph" name="paragraph" required><?= $edit_mode ? $edit_data['paragraph'] : '' ?></textarea>

                <label for="title">Title:</label>
                <input type="text" id="title" name="title"
                       value="<?= $edit_mode ? $edit_data['title'] : '' ?>" required>
            </div>

            <div class="form-group">
                <div class="form-column">
                    <?php
                    for ($i = 1; $i <= 5; $i++) {
                        $p = "p$i";
                        echo "
                        <label for='point$i'>Point $i:</label>
                        <input type='text' id='point$i' name='point$i'
                            value='".($edit_mode ? $edit_data[$p] : "")."' required>
                        ";
                    }
                    ?>
                </div>

                <div class="form-column">
                    <?php
                    for ($i = 6; $i <= 10; $i++) {
                        $p = "p$i";
                        echo "
                        <label for='point$i'>Point $i:</label>
                        <input type='text' id='point$i' name='point$i'
                            value='".($edit_mode ? $edit_data[$p] : "")."' required>
                        ";
                    }
                    ?>
                </div>
            </div>

            <div class="submit-btn">
                <input type="submit"
                       name="<?= $edit_mode ? 'update' : 'submit' ?>"
                       value="<?= $edit_mode ? 'Update' : 'Submit' ?>">
            </div>

        </form>
    </div>

    <?php
    $sql = "SELECT * FROM about";
    $result = $conn->query($sql);
    ?>

    <h1>About Data</h1>
    <table>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Paragraph</th>
            <th>Title</th>
            <th>Point 1</th>
            <th>Point 2</th>
            <th>Point 3</th>
            <th>Point 4</th>
            <th>Point 5</th>
            <th>Point 6</th>
            <th>Point 7</th>
            <th>Point 8</th>
            <th>Point 9</th>
            <th>Point 10</th>
            <th>Actions</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td><img src='img/about/".$row['image']."' alt='Img'></td>";
                echo "<td>".$row['name']."</td>";
                echo "<td>".$row['paragraph']."</td>";
                echo "<td>".$row['title']."</td>";
                echo "<td>".$row['p1']."</td>";
                echo "<td>".$row['p2']."</td>";
                echo "<td>".$row['p3']."</td>";
                echo "<td>".$row['p4']."</td>";
                echo "<td>".$row['p5']."</td>";
                echo "<td>".$row['p6']."</td>";
                echo "<td>".$row['p7']."</td>";
                echo "<td>".$row['p8']."</td>";
                echo "<td>".$row['p9']."</td>";
                echo "<td>".$row['p10']."</td>";
                echo "<td>
                        <a href='about.php?edit=".$row['id']."'>Edit</a> |
                        <a href='delete.php?id=".$row['id']."&table=about&file_location=img/about/&redirect=about.php'>Delete</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='16'>No data found</td></tr>";
        }
        ?>
    </table>

    <?php include 'footer.php'; ?>

</div>

<script>
function previewImage(event) {
    const img = document.getElementById('preview-img');
    const box = document.getElementById('preview-box');

    img.src = URL.createObjectURL(event.target.files[0]);
    box.style.display = 'block';
}
</script>

</body>
</html>
