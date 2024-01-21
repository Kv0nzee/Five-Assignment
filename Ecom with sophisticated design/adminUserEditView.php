<?php
require_once("./components/AdminNavber.php");

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $userId = $_GET['id'];

    // Retrieve user details
    $select_sql = "SELECT * FROM users WHERE userID = :userID";
    $stmt = $pdo->prepare($select_sql);
    $stmt->bindParam(':userID', $userId, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        // User not found, handle accordingly (e.g., redirect)
        header("Location: AdminUserView.php");
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Handle form submission for editing user details
        $userName = $_POST['userName'];
        $userEmail = $_POST['userEmail'];
        $userAddress = $_POST['userAddress'];
        $userPhone = $_POST['userPhone'];
        $userType = $_POST['userType'];

        try {
            // Update user details
            $update_sql = "UPDATE users SET userName = :userName, userEmail = :userEmail, userAddress = :userAddress, userPhone = :userPhone, userType = :userType WHERE userID = :userID";
            $stmt = $pdo->prepare($update_sql);
            $stmt->bindParam(':userName', $userName, PDO::PARAM_STR);
            $stmt->bindParam(':userEmail', $userEmail, PDO::PARAM_STR);
            $stmt->bindParam(':userAddress', $userAddress, PDO::PARAM_STR);
            $stmt->bindParam(':userPhone', $userPhone, PDO::PARAM_STR);
            $stmt->bindParam(':userType', $userType, PDO::PARAM_STR);
            $stmt->bindParam(':userID', $userId, PDO::PARAM_INT);
            $stmt->execute();

            header("Location: UserDetailview.php?id=$userId&success=ok");
            exit();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
} else {
    // Invalid user ID, handle accordingly (e.g., redirect)
    header("Location: AdminUserView.php");
    exit();
}
?>


    <div class="container mt-3">
        <a class="btn btn-primary mb-3" href="AdminUserView.php"><<< Back to User List</a>

        <div class="card mx-auto">
            <div class="card-header bg-dark  text-center">
                <h4 class="text-white">Edit User</h4>
            </div>
            <div class="card-body" >
                <form method="POST">
                    <div class="mb-3">
                        <label for="userName" class="form-label">Username</label>
                        <input type="text" class="form-control" id="userName" name="userName" value="<?= $user['userName'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="userEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="userEmail" name="userEmail" value="<?= $user['userEmail'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="userAddress" class="form-label">Address</label>
                        <input type="text" class="form-control" id="userAddress" name="userAddress" value="<?= $user['userAddress'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="userPhone" class="form-label">Phone</label>
                        <input type="tel" class="form-control" id="userPhone" name="userPhone" value="<?= $user['userPhone'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="userType" class="form-label">User Type</label>
                        <select class="form-select" id="userType" name="userType">
                            <option value="user" <?= ($user['userType'] == 'user') ? 'selected' : '' ?>>User</option>
                            <option value="admin" <?= ($user['userType'] == 'admin') ? 'selected' : '' ?>>Admin</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
