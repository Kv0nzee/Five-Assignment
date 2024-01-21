<?php

require_once("./components/navbar.php");


if (isset($_SESSION['orderID'])) {
    $orderID = $_SESSION['orderID'];

    // Fetch order details from the orders table
    $selectOrderSQL = "SELECT * FROM orders WHERE orderID = :orderID";
    $stmtOrder = $pdo->prepare($selectOrderSQL);
    $stmtOrder->bindParam(':orderID', $orderID, PDO::PARAM_INT);
    $stmtOrder->execute();
    $order = $stmtOrder->fetch(PDO::FETCH_ASSOC);

    // Fetch order items from the order_items and products tables
    $selectOrderItemsSQL = "SELECT oi.productID, p.productName, oi.quantity, p.productPrice 
                            FROM order_items oi
                            JOIN products p ON oi.productID = p.productID
                            WHERE oi.orderID = :orderID";
    $stmtOrderItems = $pdo->prepare($selectOrderItemsSQL);
    $stmtOrderItems->bindParam(':orderID', $orderID, PDO::PARAM_INT);
    $stmtOrderItems->execute();
    $orderItems = $stmtOrderItems->fetchAll(PDO::FETCH_ASSOC);
} else {
    // If orderID is not set, redirect to the shopping cart page
    header("Location: cart.php");
    exit();
}
?>
    <div class="container p-5">
        <h2>Order Confirmation</h2>

        <!-- Display order details -->
        <div class="d-flex justify-content-between">
        <div style="min-width:200px; margin-right:100px;">
            <p><strong>Order ID:</strong> <?= $order['orderID'] ?></p>
            <p><strong>User ID:</strong> <?= $order['userID'] ?></p>
            <p><strong>Order Date:</strong> <?= $order['orderDate'] ?></p>
            <p><strong>Address:</strong> <?= $order['address'] ?></p>
        </div>

        <!-- Display order items -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orderItems as $item) : ?>
                    <tr>
                        <td><?= $item['productName'] ?></td>
                        <td><?= $item['quantity'] ?></td>
                        <td>$<?= $item['quantity'] * $item['productPrice'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>

        <!-- Display total price -->
        <?php
        $totalPrice = 0;
        foreach ($orderItems as $item) {
            $totalPrice += $item['quantity'] * $item['productPrice'];
        }
        ?>
        <p class="total-price"><strong>Total Price:</strong> $<?= $totalPrice ?></p>

        <div class="d-flex justify-content-between align-items-center">
            <p class="thank-you">Thank you, User: <?= $_SESSION['user']['userName'] ?>.</p>

            <a href="./" class="btn-back">Back to Product View</a>
        </div>
    </div>
