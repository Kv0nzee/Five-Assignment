<?php

require_once("./components/navbar.php");

// Check if the user is logged in
if (isset($_SESSION['user'])) {
    $loggedInUser = $_SESSION['user'];
} else {
    // If the user is not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}

// Check if the orderID is provided in the URL
if (isset($_GET['orderID'])) {
    $orderID = $_GET['orderID'];

    // Fetch order details
    $orderSQL = "SELECT o.orderID, o.orderDate, o.address, o.totalPrice
                 FROM orders o
                 WHERE o.orderID = :orderID";
    
    $orderStmt = $pdo->prepare($orderSQL);
    $orderStmt->bindParam(':orderID', $orderID, PDO::PARAM_INT);
    $orderStmt->execute();
    $order = $orderStmt->fetch(PDO::FETCH_ASSOC);

    // Fetch order items
    $orderItemsSQL = "SELECT oi.quantity, p.productName, p.productPrice
                      FROM order_items oi
                      JOIN products p ON oi.productID = p.productID
                      WHERE oi.orderID = :orderID";
    
    $orderItemsStmt = $pdo->prepare($orderItemsSQL);
    $orderItemsStmt->bindParam(':orderID', $orderID, PDO::PARAM_INT);
    $orderItemsStmt->execute();
    $orderItems = $orderItemsStmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // If orderID is not provided, redirect to the order history page
    header("Location: OrderHistory.php");
    exit();
}
?>

<body>
    <div class="container mt-3">
        <h2>Order Details</h2>

        <?php if ($order) : ?>
            <p><strong>Order ID:</strong> <?= $order['orderID'] ?></p>
            <p><strong>Order Date:</strong> <?= $order['orderDate'] ?></p>
            <p><strong>Address:</strong> <?= $order['address'] ?></p>

            <h3>Order Items</h3>
            <?php if (!empty($orderItems)) : ?>
                <table class="table table-striped table-primary">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orderItems as $orderItem) : ?>
                            <tr>
                                <td><?= $orderItem['productName'] ?></td>
                                <td><?= $orderItem['quantity'] ?></td>
                                <td>$<?= $orderItem['productPrice'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <p>No items in this order.</p>
            <?php endif; ?>

            <p><strong>Total Price:</strong> $<?= $order['totalPrice'] ?></p>

            <a href="OrderHistory.php" class="btn btn-primary">Back to Order History</a>
        <?php else : ?>
            <p>Order not found.</p>
            <a href="OrderHistory.php" class="btn btn-primary">Back to Order History</a>
        <?php endif; ?>
    </div>

    <!-- Add Bootstrap JS and Popper.js scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
