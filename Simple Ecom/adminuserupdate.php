<?php
require_once("Connect.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $adminUserId = $_POST['admin_user_id']; 

    $newName = $_POST['new_name'];
    $newEmail = $_POST['new_email'];
    $newType = $_POST['user_type'];
    $newPassword = password_hash($_POST['new_password'], PASSWORD_DEFAULT); // Hash the new password, assuming you store hashed passwords

    // Update query
    $update_sql = "UPDATE users SET name = ?, email = ?, password = ?, type = ? WHERE id = ?";
    $stmt = $pdo->prepare($update_sql);
    
    if ($stmt->execute([$newName, $newEmail, $newPassword, $newType, $adminUserId])) {
        header("Location: adminuserview.php");
        exit();
    } else {
        echo "Error updating admin user.";
    }
}

// Fetching admin user details from the database
$adminUserId = $_GET['id'];
$adminUser_sql = "SELECT * FROM users WHERE id = ?";
$stmt = $pdo->prepare($adminUser_sql);
$stmt->execute([$adminUserId]);
$adminUser = $stmt->fetch(PDO::FETCH_ASSOC);

require('sidebar.php');
?>

<div class="container">
<a class="m-2 text-decoration-none btn btn-outline-primary" href="adminProductView.php"><<< Back</a>    
    <h2>Update Admin User</h2>
    <form method="POST">
        <input type="hidden" name="admin_user_id" value="<?= $adminUser['id']; ?>">
        
        <div class="mb-3">
            <label for="new_name" class="form-label">New Name:</label>
            <input type="text" class="form-control" id="new_name" name="new_name" value="<?= $adminUser['name']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="new_email" class="form-label">New Email:</label>
            <input type="email" class="form-control" id="new_email" name="new_email" value="<?= $adminUser['email']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="new_password" class="form-label">New Password:</label>
            <input type="password" class="form-control" id="new_password" name="new_password" required>
        </div>

        <div class="mb-3">
            <label for="user_type" class="form-label">User Type:</label>
            <select class="form-control" id="user_type" name="user_type">
                <option value="admin" <?= ($adminUser['type'] === 'admin') ? 'selected' : ''; ?>>Admin</option>
                <option value="regular" <?= ($adminUser['type'] === 'regular') ? 'selected' : ''; ?>>User</option>
                <!-- Add more options as needed -->
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
