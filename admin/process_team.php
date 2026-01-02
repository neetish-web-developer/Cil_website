<?php
include 'connection.php';

if(isset($_POST['add_team']) || isset($_POST['update_team'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $designation = mysqli_real_escape_string($conn, $_POST['designation']);

    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
        $image_name = time().'_'.$_FILES['image']['name'];
        $target_dir = "img/team/";
        $target_file = $target_dir . basename($image_name);
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
    } elseif(isset($_POST['id'])) {
        // For update, keep existing image if no new image uploaded
        $id = $_POST['id'];
        $image_name = $conn->query("SELECT image FROM team WHERE id='$id'")->fetch_assoc()['image'];
    } else {
        $image_name = '';
    }

    if(isset($_POST['add_team'])){
        $sql = "INSERT INTO team (name, designation, image) VALUES ('$name', '$designation', '$image_name')";
    } else {
        $id = $_POST['id'];
        $sql = "UPDATE team SET name='$name', designation='$designation', image='$image_name' WHERE id='$id'";
    }

    if($conn->query($sql)){
        header("Location: team.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
