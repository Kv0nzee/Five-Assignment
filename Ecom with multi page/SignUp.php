<?php
require('Connect.php');

// Function to hash the password
function hashPassword($password)
{
    // Use a strong hashing algorithm like bcrypt
    return password_hash($password, PASSWORD_BCRYPT);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize user input
    $userName = $_POST[ 'username'];
    $userEmail = $_POST[ 'userEmail'];
    $userPass = $_POST[ 'userPass'];
    $userAddress = $_POST[ 'userAddress'];
    $userPhone = $_POST[ 'userPhone'];

    // Insert user data into the 'users' table
    $insertUserSQL = "INSERT INTO users (userName, userPass, userEmail, userAddress, userPhone, userType)
                      VALUES (:userName, :userPass, :userEmail, :userAddress, :userPhone, 'user')";

    $stmt = $pdo->prepare($insertUserSQL);
    $stmt->bindParam(':userName', $userName, PDO::PARAM_STR);
    $stmt->bindParam(':userPass', $userPass, PDO::PARAM_STR);
    $stmt->bindParam(':userEmail', $userEmail, PDO::PARAM_STR);
    $stmt->bindParam(':userAddress', $userAddress, PDO::PARAM_STR);
    $stmt->bindParam(':userPhone', $userPhone, PDO::PARAM_STR);

    try {
        $stmt->execute();
        echo "Registration successful. Redirecting to login page...";
        header("refresh:2;url=login.php"); // Redirect to login page after 2 seconds
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<div class="d-flex flex-column justify-center align-items-center">
    <img src="image/Logo1.png" alt="Logo" style="width:200px">
    <hr>    
        <h2>User Registration</h2>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="col-12 py-3">
                <div class="form-floating" style="width:300px;">
                    <input type="text" class="form-control custom-input" id="username" name="username" placeholder="Your Name" required>
                    <label for="name">Your Name</label>
                </div>
            </div>
            <div class="col-12 py-3">
                <div class="form-floating" style="width:300px;">
                    <input type="text" class="form-control custom-input" id="userEmail" name="userEmail" placeholder="Your email" required>
                    <label for="name">Your Email</label>
                </div>
            </div>

            <div class="col-12 py-3">
                <div class="form-floating" style="width:300px;">
                    <input type="password" class="form-control custom-input" id="userPass" name="userPass" placeholder="Your Password" required>
                    <label for="userPass">Your Password</label>
                </div>
            </div>

            <div class="col-12 py-3">
                <div class="form-floating" style="width:300px;">
                    <input type="text" name="userAddress" class="form-control custom-input" id="userAddress"  placeholder="Your Address" required>
                    <label for="userAddress">Your Address</label>
                </div>
            </div>

            <div class="col-12 py-3">
                <div class="form-floating" style="width:300px;">
                    <input type="text" name="userPhone" class="form-control custom-input" id="userPhone"  placeholder="Your PhoneNumber" required>
                    <label for="userPhone">Your Phone Number</label>
                </div>
            </div>

            <div class="col-12 py-3">
                <button class="btn btn-primary w-100 py-3" type="submit">Register</button>
            </div>
        </form>

        <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </div>