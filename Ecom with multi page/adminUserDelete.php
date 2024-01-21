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
        // Handle form submission for user deletion
        try {
            // Delete user
            $delete_sql = "DELETE FROM users WHERE userID = :userID";
            $stmt = $pdo->prepare($delete_sql);
            $stmt->bindParam(':userID', $userId, PDO::PARAM_INT);
            $stmt->execute();

            // Redirect to user list with success message
            header("Location: AdminUserView.php?delete=ok");
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User</title>
    <!-- Add your CSS styles or include external stylesheets here -->
</head>

<body>

    <div class="container mt-3">
        <a class="btn btn-secondary mb-3" href="AdminUserView.php"><<< Back to User List</a>

        <div class="card">
            <div class="card-header bg-danger text-white text-center">
                <h4 style="font-family: 'Arial', sans-serif;">Delete User</h4>
            </div>
            <div class="card-body" style="background-color: #ffb3b3;"> <!-- Set the background color -->
                <p>Are you sure you want to delete the user with the following details?</p>
                <ul>
                    <li><strong>Username:</strong> <?= $user['userName'] ?></li>
                    <li><strong>Email:</strong> <?= $user['userEmail'] ?></li>
                    <!-- Add other user details as needed -->
                </ul>
                <form method="POST">
                    <button type="submit" class="btn btn-danger float-end">Delete User</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
