<?php
require('./components/sidebar.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {
    // Retrieve form data
    $userID = $_POST["user_id"]; // Assuming the hidden field is user_id

    $userName = $_POST["userName"];
    $userEmail = $_POST["userEmail"];
    $userPass = $_POST["userPass"];
    $userAddress = $_POST["userAddress"];
    $userPhone = $_POST["userPhone"];
    $userType = $_POST["userType"];

    // Hash the password only if it's not empty
    $hashedPassword = !empty($userPass) ? password_hash($userPass, PASSWORD_DEFAULT) : null;

    // Update data in the database
    $update_sql = "UPDATE users SET userName=?, userEmail=?, userPass=?, userAddress=?, userPhone=?, userType=? WHERE userID=?";
    $stmt = $pdo->prepare($update_sql);

    if ($stmt->execute([$userName, $userEmail, $hashedPassword, $userAddress, $userPhone, $userType, $userID])) {
        // Database operation successful
        $_SESSION['success_message'] = "User updated successfully.";
        header("Location: adminUserView.php"); // Redirect to success page
        exit();
    } else {
        // Error updating data in the database
        $_SESSION['error_message'] = "Error updating user.";
    }
}

// Display the form for updating user information
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"])) {
    $userID = $_GET["id"];

    $select_sql = "SELECT * FROM users WHERE userID = ?";
    $stmt = $pdo->prepare($select_sql);

    if ($stmt->execute([$userID])) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
?>
<div class="body-wrapper">
    <div class="col-lg-8 d-flex align-items-stretch w-100">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Update User</h5>
                <div class="card">
                    <div class="card-body">
                        <form method="POST">
                            <input type="hidden" name="user_id" value="<?= $user['userID'] ?>">

                            <div class="mb-3">
                                <label for="userName" class="form-label">User Name</label>
                                <input type="text" class="form-control" id="userName" name="userName" value="<?= $user['userName'] ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="userEmail" class="form-label">User Email</label>
                                <input type="email" class="form-control" id="userEmail" name="userEmail" value="<?= $user['userEmail'] ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="userPass" class="form-label">Password</label>
                                <input type="password" class="form-control" id="userPass" name="userPass">
                                <small class="text-muted">Leave blank if you don't want to change the password.</small>
                            </div>

                            <div class="mb-3">
                                <label for="userAddress" class="form-label">User Address</label>
                                <input type="text" class="form-control" id="userAddress" name="userAddress" value="<?= $user['userAddress'] ?>">
                            </div>

                            <div class="mb-3">
                                <label for="userPhone" class="form-label">User Phone</label>
                                <input type="tel" class="form-control" id="userPhone" name="userPhone" value="<?= $user['userPhone'] ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="userType" class="form-label">User Type</label>
                                <!-- Assuming you have a user type dropdown, adjust as needed -->
                                <select class="form-control" id="userType" name="userType" required>
                                    <option value="user" <?= ($user['userType'] === 'user') ? 'selected' : '' ?>>User</option>
                                    <option value="admin" <?= ($user['userType'] === 'admin') ? 'selected' : '' ?>>Admin</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary" name="submit">Update User</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
        } else {
            echo "User not found";
        }
    } else {
        echo "Error fetching user data: " . $stmt->errorInfo()[2];
    }
}
?>
