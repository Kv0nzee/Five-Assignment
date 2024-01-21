<?php
require_once("Connect.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $newName = $_POST['new_name'];
    $newEmail = $_POST['new_email'];
    $newType = $_POST['user_type'];
    $newPassword = password_hash($_POST['new_password'], PASSWORD_DEFAULT); // Hash the new password, assuming you store hashed passwords

    // Create new admin user
    $insert_sql = "INSERT INTO users (name, email, password, type) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($insert_sql);
    
    if ($stmt->execute([$newName, $newEmail, $newPassword, $newType])) {
        header("Location: adminuserview.php");
        exit();
    } else {
        echo "Error creating admin user.";
    }
}

require('sidebar.php');
?>

<div class="container">
    <a class="m-2 text-decoration-none btn btn-outline-primary" href="adminProductView.php"><<< Back</a>    
    <h2>Create Admin User</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="new_name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="new_name" name="new_name" required>
        </div>

        <div class="mb-3">
            <label for="new_email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="new_email" name="new_email" required>
        </div>

        <div class="mb-3">
            <label for="new_password" class="form-label">Password:</label>
            <input type="password" class="form-control" id="new_password" name="new_password" required>
        </div>

        <div class="mb-3">
            <label for="user_type" class="form-label">User Type:</label>
            <select class="form-control" id="user_type" name="user_type">
                <option value="admin">Admin</option>
                <option value="regular">User</option>
                <!-- Add more options as needed -->
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
