<?php
require_once("Connect.php");

try {
    // Create orders table
    $createOrdersTable = "CREATE TABLE IF NOT EXISTS orders (
        orderID INT PRIMARY KEY AUTO_INCREMENT,
        userID INT,
        orderDate DATE NOT NULL,
        address VARCHAR(255) NOT NULL,
        totalPrice DECIMAL(10, 2) NOT NULL,
        FOREIGN KEY (userID) REFERENCES users(userID)
    )";

    $pdo->exec($createOrdersTable);

    // Create order_items table
    $createOrderItemsTable = "CREATE TABLE IF NOT EXISTS order_items (
        orderID INT,
        productID INT,
        quantity INT NOT NULL,
        FOREIGN KEY (orderID) REFERENCES orders(orderID),
        FOREIGN KEY (productID) REFERENCES products(productID)
    )";

    $pdo->exec($createOrderItemsTable);

    // echo "Tables created successfully!";
} catch (PDOException $e) {
    echo "Error creating tables: " . $e->getMessage();
}
?>
