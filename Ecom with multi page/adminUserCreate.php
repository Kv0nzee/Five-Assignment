<?php
require_once("./components/AdminNavber.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = $_POST['userName'];
    $userPass = $_POST['userPass'];
    $userEmail = $_POST['userEmail'];
    $userAddress = $_POST['userAddress'];
    $userPhone = $_POST['userPhone'];
    $userType = $_POST['userType'];

    try {
        $insert_sql = "INSERT INTO users (userName, userPass, userEmail, userAddress, userPhone, userType) VALUES (:userName, :userPass, :userEmail, :userAddress, :userPhone, :userType)";
        $stmt = $pdo->prepare($insert_sql);
        $stmt->bindParam(':userName', $userName, PDO::PARAM_STR);
        $stmt->bindParam(':userPass', $userPass, PDO::PARAM_STR);
        $stmt->bindParam(':userEmail', $userEmail, PDO::PARAM_STR);
        $stmt->bindParam(':userAddress', $userAddress, PDO::PARAM_STR);
        $stmt->bindParam(':userPhone', $userPhone, PDO::PARAM_STR);
        $stmt->bindParam(':userType', $userType, PDO::PARAM_STR);
        $stmt->execute();

        header("Location: adminUserCreate.php?success=ok");
        exit();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
?>


    <div class="container mt-3">
        <a class="btn btn-primary mb-3" href="AdminUserView.php"><<< Back to User List</a>

        <div class="card">
            <div class="card-header bg-dark text-center">
                <h4 class="text-white ">Create A New User</h3>
            </div>
            <div class="card-body">
                <?php if (isset($_GET['success']) && $_GET['success'] == 'ok') : ?>
                    <div class="alert alert-success" role="alert">
                        User created successfully!
                    </div>
                <?php endif; ?>

                <form method="POST">
                    <div class="mb-3">
                        <label for="userName" class="form-label">Username</label>
                        <input type="text" class="form-control" id="userName" required name="userName">
                    </div>
                    <div class="mb-3">
                        <label for="userPass" class="form-label">Password</label>
                        <input type="password" class="form-control" id="userPass" required name="userPass">
                    </div>
                    <div class="mb-3">
                        <label for="userEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="userEmail" required name="userEmail">
                    </div>
                    <div class="mb-3">
                        <label for="userAddress" class="form-label">Address</label>
                        <input type="text" class="form-control" id="userAddress" name="userAddress">
                    </div>
                    <div class="mb-3">
                        <label for="userPhone" class="form-label">Phone</label>
                        <input type="tel" class="form-control" id="userPhone" name="userPhone">
                        </div>
                    <div class="mb-3">
                        <label for="userType" class="form-label">User Type</label>
                        <select class="form-select" id="userType" name="userType">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary float-end">Create User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

