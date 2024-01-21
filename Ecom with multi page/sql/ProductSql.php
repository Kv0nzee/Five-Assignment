<?php
require_once("Connect.php");

// Modify products table to reference categoryID
$tableProducts = "CREATE TABLE IF NOT EXISTS products (
    productID INT PRIMARY KEY AUTO_INCREMENT,
    productName VARCHAR(50) NOT NULL,
    categoryID INT,
    productPrice FLOAT,
    productStock INT,
    imagePath VARCHAR(255),
    FOREIGN KEY (categoryID) REFERENCES categories(categoryID)
)";
try {
    $pdo->exec($tableProducts);

    $insertProductData = "
        INSERT INTO products (productName, categoryID, productPrice, productStock, imagePath)
        VALUES
            ('Smartphone', 1, 499.99, 50, 'image.png'),
            ('T-shirt', 2, 19.99, 100, 'image.png'),
            ('AC Unit', 3, 799.99, 20, 'image.png'),
            ('Refrigerator', 4, 1299.99, 15, 'image.png'),
            ('Microwave Oven', 5, 99.99, 30, 'image.png'),
            ('Washing Machine', 6, 599.99, 25, 'image.png'),
            ('Dishwasher', 7, 449.99, 15, 'image.png'),
            ('Oven', 8, 349.99, 10, 'image.png'),
            ('Blender', 9, 39.99, 50, 'image.png'),
            ('Coffee Maker', 10, 59.99, 40, 'image.png');
        ";

    $pdo->exec($insertProductData);

    // echo "Data inserted into the products table successfully.";
    
} catch (Exception $e) {
    echo $e->getMessage();
}
?>
