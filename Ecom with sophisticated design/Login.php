<?php
require_once("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $select_sql = "SELECT * FROM users WHERE userName = :username AND userPass = :password";
    $stmt = $pdo->prepare($select_sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION['user'] = $user;

        if ($user['userType'] == 'admin') {
            header("Location: AdminDashboard.php");
            exit();
        } elseif ($user['userType'] == 'user') {
            header("Location: index.php");
            exit();
        }
    } else {
        echo "Invalid username or password";
    }
}
?>

<div class="d-flex flex-column justify-center align-items-center">
    <img src="image/Logo1.png" alt="Logo" style="width:200px">
    <hr>

    <form method="POST" action="Login.php">
        <div class="col-12 py-3">
            <div class="form-floating" style="width:300px;">
                <input type="text" class="form-control custom-input" id="username" name="username" placeholder="Your Name" required>
                <label for="name">Your Name</label>
            </div>
        </div>

        <div class="col-12 py-3">
            <div class="form-floating" style="width:300px;">
                <input type="password" class="form-control custom-input" id="password" name="password" placeholder="Your Password" required>
                <label for="password">Your Password</label>
            </div>
        </div>
        <div class="col-12 py-3">
            <button class="btn btn-primary w-100 py-3" type="submit">Login</button>
        </div>
    </form>

    <div class="signup-link">
        Don't have an account? <a href="SignUp.php">Sign Up</a>
    </div>
</div>

<style>
    .custom-input {
        width: 100%; /* Adjust the width as needed */
    }
</style>
