<?php
require_once("Connect.php");

try {
    // Create categories table
    $createCategoriesTable = "CREATE TABLE IF NOT EXISTS categories (
        categoryID INT PRIMARY KEY AUTO_INCREMENT,
        categoryName VARCHAR(50) NOT NULL
    )";

    $pdo->exec($createCategoriesTable);

    // Insert Home Appliance data
    $homeAppliances = ['AC', 'Refrigerator', 'Microwave', 'Washing Machine', 'Dishwasher', 'Oven', 'Blender', 'Coffee Maker', 'Toaster', 'Vacuum Cleaner'];

    foreach ($homeAppliances as $appliance) {
        $insertHomeApplianceData = "INSERT INTO categories (categoryName) VALUES ('$appliance')";
        $pdo->exec($insertHomeApplianceData);
    }

    // echo "Categories table created and Home Appliance data added successfully!";
} catch (PDOException $e) {
    echo "Error creating categories table: " . $e->getMessage();
}
?>
