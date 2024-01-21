<?php

require_once("./components/navbar.php");
// Check if the user is logged in
if (isset($_SESSION['user'])) {
    $loggedInUser = $_SESSION['user'];

    // Fetch order history for the user
    $orderHistorySQL = "SELECT o.orderID, o.orderDate, o.totalPrice
                        FROM orders o
                        WHERE o.userID = :userID
                        ORDER BY o.orderDate DESC";
    
    $orderHistoryStmt = $pdo->prepare($orderHistorySQL);
    $orderHistoryStmt->bindParam(':userID', $loggedInUser['userID'], PDO::PARAM_INT);
    $orderHistoryStmt->execute();
    $orderHistory = $orderHistoryStmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // If the user is not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}
?>

<body>
    <div class="container mt-3">
        <h2>Order History</h2>

        <?php if (!empty($orderHistory)) : ?>
            <table class="table table-striped table-primary">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Order Date</th>
                        <th>Total Price</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orderHistory as $order) : ?>
                        <tr>
                            <td><?= $order['orderID'] ?></td>
                            <td><?= $order['orderDate'] ?></td>
                            <td>$<?= $order['totalPrice'] ?></td>
                            <td>
                                <a href="OrderDetails_user.php?orderID=<?= $order['orderID'] ?>" class="btn btn-primary">View Details</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>No order history available.</p>
        <?php endif; ?>

        <a href="./" class="btn btn-primary mt-3">Back to Product View</a>
    </div>
