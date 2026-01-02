<?php
require 'connection.php';
include 'header.php';
?>

<div class="main-content" style="padding: 20px;">

    <!-- CREATE ADMIN SECTION -->
    <div class="card" style="margin-bottom: 30px; padding: 20px; background: #fff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
        <h2 style="margin-bottom: 20px;">Create Admin</h2>
        <form action="process_admin.php" method="POST">
            <div style="margin-bottom: 15px;">
                <label>Username:</label>
                <input type="text" name="username" required 
                       style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #ccc; box-sizing: border-box;">
            </div>

            <!-- Password Field -->
            <div style="margin-bottom: 15px; position: relative;">
                <label>Password:</label>
                <input type="password" id="password" name="password" required 
                       style="width: 100%; padding: 8px 35px 8px 8px; border-radius: 4px; border: 1px solid #ccc; box-sizing: border-box;">
                <span class="toggle-eye" onclick="togglePassword('password', this)" 
                      style="position: absolute; right: 10px; top: 50%; transform: translateY(-20%); cursor: pointer; user-select: none; font-size: 18px;">👁️</span>
            </div>

            <!-- Confirm Password Field -->
            <div style="margin-bottom: 15px; position: relative;">
                <label>Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required 
                       style="width: 100%; padding: 8px 35px 8px 8px; border-radius: 4px; border: 1px solid #ccc; box-sizing: border-box;">
                <span class="toggle-eye" onclick="togglePassword('confirm_password', this)" 
                      style="position: absolute; right: 10px; top: 50%; transform: translateY(-20%); cursor: pointer; user-select: none; font-size: 18px;">👁️</span>
            </div>

            <button type="submit" name="create_admin" 
                    style="background: #222; color: #fff; padding: 10px 20px; border: none; cursor: pointer;">Create Admin</button>
        </form>
    </div>

    <!-- ACTIVE USERS SECTION -->
    <div class="card" style="padding: 20px; background: #fff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
        <h2 style="margin-bottom: 20px;">Active Users</h2>
        <table style="width: 100%; border-collapse: collapse;">
            <thead style="background: #f4f4f4;">
                <tr>
                    
                    <th style="padding: 10px; border: 1px solid #ccc;">Username</th>
                    <th style="padding: 10px; border: 1px solid #ccc;">Created At</th>
                    <th style="padding: 10px; border: 1px solid #ccc;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("SELECT * FROM admins ORDER BY id DESC");
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        
                        <td style='padding: 10px; border: 1px solid #ccc;'>{$row['username']}</td>
                        <td style='padding: 10px; border: 1px solid #ccc;'>{$row['created_at']}</td>
                        <td style='padding: 10px; border: 1px solid #ccc;'>
                            <a href='delete_admin.php?id={$row['id']}' style='margin-right: 10px; color: #007bff;'>Delete</a>
                            <a href='change_password.php?id={$row['id']}' style='color: #007bff;'>Change Password</a>
                        </td>
                    </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
    </div>

<?php
include 'footer.php';
?>

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
