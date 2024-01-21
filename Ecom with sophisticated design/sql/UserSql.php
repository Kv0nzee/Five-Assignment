<?php
require_once("Connect.php");

// Create the users table if it doesn't exist
$table = "users";
$tableCreate = "
    CREATE TABLE IF NOT EXISTS $table (
        userID INT AUTO_INCREMENT PRIMARY KEY,
        userName VARCHAR(50) NOT NULL,
        userPass VARCHAR(50) NOT NULL,
        userEmail VARCHAR(100) NOT NULL,
        userAddress VARCHAR(150),
        userPhone VARCHAR(25),
        userType VARCHAR(10)
    );
";

try {
    $pdo->exec($tableCreate);

    // Insert sample data
    $adminData = [
        'userName' => 'admin',
        'userPass' => 123, // This should be securely hashed in a real application
        'userEmail' => 'admin@example.com',
        'userType' => 'admin',
    ];

    $userData = [
        'userName' => 'user',
        'userPass' => 11, // This should be securely hashed in a real application
        'userEmail' => 'user@example.com',
        'userType' => 'user',
    ];

    // Insert admin data
    $insertAdmin = $pdo->prepare("INSERT INTO $table (userName, userPass, userEmail, userType) VALUES (:userName, :userPass, :userEmail, :userType)");
    $insertAdmin->execute($adminData);

    // Insert user data
    $insertUser = $pdo->prepare("INSERT INTO $table (userName, userPass, userEmail, userType) VALUES (:userName, :userPass, :userEmail, :userType)");
    $insertUser->execute($userData);

    // echo "Sample data inserted successfully.";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
