<?php
require_once("./components/AdminNavber.php");


// Check if the user is logged in as an admin
if (isset($_SESSION['user']) && $_SESSION['user']['userType'] === 'admin') {
    $loggedInUser = $_SESSION['user'];

    // Check if the orderID is provided in the URL
    if (isset($_GET['orderID'])) {
        $orderID = $_GET['orderID'];

        // Fetch order details
        $order_sql = "SELECT * FROM orders WHERE orderID = :orderID";
        $order_stmt = $pdo->prepare($order_sql);
        $order_stmt->bindParam(':orderID', $orderID, PDO::PARAM_INT);
        $order_stmt->execute();
        $order = $order_stmt->fetch(PDO::FETCH_ASSOC);

        // Fetch order items
        $orderItems_sql = "SELECT oi.productID, oi.quantity, p.productName
                            FROM order_items oi
                            JOIN products p ON oi.productID = p.productID
                            WHERE oi.orderID = :orderID";
        $orderItems_stmt = $pdo->prepare($orderItems_sql);
        $orderItems_stmt->bindParam(':orderID', $orderID, PDO::PARAM_INT);
        $orderItems_stmt->execute();
        $orderItems = $orderItems_stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        // If orderID is not provided, redirect to AdminOrdersView.php
        header("Location: AdminOrdersView.php");
        exit();
    }
} else {
    // If the user is not logged in or not an admin, redirect to login page
    header("Location: login.php");
    exit();
}
?>

<body>
    <div class="container mt-3 w-100">
        <h2>Order Details</h2>

        <?php if ($order) : ?>
            <div class="d-flex w-100 justify-content-center">
            <div class="w-20 mx-5">
            <h3 class="mb-3">Order Information</h3>
            <p><strong>Order ID:</strong> <?= $order['orderID'] ?></p>
            <p><strong>User ID:</strong> <?= $order['userID'] ?></p>
            <p><strong>Order Date:</strong> <?= $order['orderDate'] ?></p>
            <p><strong>Address:</strong> <?= $order['address'] ?></p>
            <p><strong>Total Price:</strong> $<?= $order['totalPrice'] ?></p>
            </div>

            <div class="w-50">
            <h3>Order Items</h3>
            <?php if (!empty($orderItems)) : ?>
                <table class="table  text-muted table-bordered table-hover table-striped">
                    <thead class="table-primary">
                        <tr>
                            <th>Product Name</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orderItems as $orderItem) : ?>
                            <tr>
                                <td><?= $orderItem['productName'] ?></td>
                                <td><?= $orderItem['quantity'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            </div>
            <?php else : ?>
                <p>No items in this order.</p>
            <?php endif; ?>
        <?php else : ?>
            <p>Order not found.</p>
        <?php endif; ?>

        <a href="AdminOrdersView.php" class="btn btn-primary">Back to Orders</a>
    </div>

    <!-- Add Bootstrap JS and Popper.js scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
