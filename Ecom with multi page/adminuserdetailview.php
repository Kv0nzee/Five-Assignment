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
        // Add your update SQL statement here
        // Example: $update_sql = "UPDATE users SET userName = :userName, userPass = :userPass, ... WHERE userID = :userID";
        // Execute the statement and handle success/failure
    }
} else {
    // Invalid user ID, handle accordingly (e.g., redirect)
    header("Location: AdminUserView.php");
    exit();
}
?>

    <div class="container mt-3 ">
        <a class="btn btn-primary mb-3"  href="AdminUserView.php"><<< Back to User List</a>

        <div class="card  mx-auto" style="max-width: 700px">
            <div class="card-body  ">
                <h5 class="card-title"><?= $user['userName'] ?></h5>
                <p class="card-text">Email: <?= $user['userEmail'] ?></p>
                <p class="card-text">Address: <?= $user['userAddress'] ?></p>
                <p class="card-text">Phone: <?= $user['userPhone'] ?></p>
                <p class="card-text">User Type: <?= $user['userType'] ?></p>

                <!-- Add more details as needed -->

                <!-- Edit button -->
                <a href="adminUserEditView.php?id=<?= $userId ?>" class="btn btn-warning">Edit User</a>
            </div>
        </div>
    </div>
