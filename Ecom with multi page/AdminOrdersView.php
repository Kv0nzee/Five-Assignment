<?php
require_once("./components/AdminNavber.php");

// Check if the user is logged in as an admin
if (isset($_SESSION['user']) && $_SESSION['user']['userType'] === 'admin') {
    $loggedInUser = $_SESSION['user'];

    // Fetch orders and order items
    $orders_sql = "SELECT * FROM orders";
    $orders_stmt = $pdo->query($orders_sql);
    $orders = $orders_stmt->fetchAll(PDO::FETCH_ASSOC);

    $orderItems_sql = "SELECT * FROM order_items";
    $orderItems_stmt = $pdo->query($orderItems_sql);
    $orderItems = $orderItems_stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // If the user is not logged in or not an admin, redirect to login page
    header("Location: login.php");
    exit();
}
?>

    <div class="container mt-3">
        <h2>Admin Orders View</h2>

        <?php if (!empty($orders)) : ?>
            <table class="table  text-muted table-bordered table-hover table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>Order ID</th>
                        <th>User ID</th>
                        <th>Order Date</th>
                        <th>Address</th>
                        <th>Total Price</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order) : ?>
                        <tr>
                            <td><?= $order['orderID'] ?></td>
                            <td><?= $order['userID'] ?></td>
                            <td><?= $order['orderDate'] ?></td>
                            <td><?= $order['address'] ?></td>
                            <td>$<?= $order['totalPrice'] ?></td>
                            <td>
                                <a href="adminOrderDetails.php?orderID=<?= $order['orderID'] ?>" class="btn btn-primary">View Details</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>No orders available.</p>
        <?php endif; ?>
    </div>

    <!-- Add Bootstrap JS and Popper.js scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
