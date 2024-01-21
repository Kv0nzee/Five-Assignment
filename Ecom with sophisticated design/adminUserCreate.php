<?php
require('./components/sidebar.php'); 

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {
    // Retrieve form data
    $userName = $_POST["userName"];
    $userEmail = $_POST["userEmail"];
    $userPass = $_POST["userPass"];
    $userAddress = $_POST["userAddress"];
    $userPhone = $_POST["userPhone"];
    $userType = $_POST["userType"];

    // Hash the password for security
    $hashedPassword = password_hash($userPass, PASSWORD_DEFAULT);

    // Insert data into the database
    $insert_sql = "INSERT INTO users (userName, userEmail, userPass, userAddress, userPhone, userType) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($insert_sql);

    // You may need to adjust the bind parameters based on your database schema
    if ($stmt->execute([$userName, $userEmail, $hashedPassword, $userAddress, $userPhone, $userType])) {
        // Database operation successful
        header("Location: adminUserView.php"); // Redirect to success page
        exit();
    } else {
        // Error inserting data into the database
        echo "Error creating user.";
    }
}
?>
<div class="body-wrapper">
    <div class="col-lg-8 d-flex align-items-stretch w-100">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Create User</h5>
                <div class="card">
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label for="userName" class="form-label">User Name</label>
                                <input type="text" class="form-control" id="userName" name="userName" required>
                            </div>
                            <div class="mb-3">
                                <label for="userEmail" class="form-label">User Email</label>
                                <input type="email" class="form-control" id="userEmail" name="userEmail" required>
                            </div>
                            <div class="mb-3">
                                <label for="userPass" class="form-label">Password</label>
                                <input type="password" class="form-control" id="userPass" name="userPass" required>
                            </div>
                            <div class="mb-3">
                                <label for="userAddress" class="form-label">User Address</label>
                                <input type="text" class="form-control" id="userAddress" name="userAddress">
                            </div>
                            <div class="mb-3">
                                <label for="userPhone" class="form-label">User Phone</label>
                                <input type="tel" class="form-control" id="userPhone" name="userPhone" required>
                            </div>
                            <div class="mb-3">
                                <label for="userType" class="form-label">User Type</label>
                                <!-- Assuming you have a user type dropdown, adjust as needed -->
                                <select class="form-control" id="userType" name="userType" required>
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary" name="submit">Create User</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    