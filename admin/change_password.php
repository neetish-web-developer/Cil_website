<?php include 'header.php'; ?>
<?php require 'connection.php'; ?>

<?php
$id = $_GET['id'];
$user = $conn->query("SELECT username FROM admins WHERE id='$id'")->fetch_assoc();
?>

<div class="main-content" style="padding: 20px;">
    <h1>Change Password for <?= htmlspecialchars($user['username']); ?></h1>

    <div class="form-box" style="margin-top: 20px;">
        <form action="process_admin.php" method="POST">
            <input type="hidden" name="id" value="<?= $id; ?>">

            <!-- New Password Field -->
            <div style="margin-bottom: 15px; position: relative;">
                <label>New Password:</label>
                <input type="password" id="password" name="password" required
                       style="width: 100%; padding: 8px 35px 8px 8px; border-radius: 4px; border: 1px solid #ccc; box-sizing: border-box;">
                <span onclick="togglePassword('password', this)"
                      style="position: absolute; right: 10px; top: 50%; transform: translateY(-20%); cursor: pointer; user-select: none; font-size: 18px;">👁️</span>
            </div>

            <!-- Confirm New Password Field -->
            <div style="margin-bottom: 15px; position: relative;">
                <label>Confirm New Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required
                       style="width: 100%; padding: 8px 35px 8px 8px; border-radius: 4px; border: 1px solid #ccc; box-sizing: border-box;">
                <span onclick="togglePassword('confirm_password', this)"
                      style="position: absolute; right: 10px; top: 50%; transform: translateY(-20%); cursor: pointer; user-select: none; font-size: 18px;">👁️</span>
            </div>

            <input type="submit" name="change_password"
                   value="Update Password"
                   style="background: #222; color: #fff; padding: 10px 20px; border: none; cursor: pointer; border-radius: 4px;">
        </form>
    </div>
    <?php include 'footer.php'; ?>
</div>

<script>
function togglePassword(id, icon) {
    const input = document.getElementById(id);
    if (input.type === "password") {
        input.type = "text";
        icon.textContent = "🙈"; // Slashed eye
    } else {
        input.type = "password";
        icon.textContent = "👁️"; // Regular eye
    }
}
</script>


