<?php
require('core/bootstrap.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_order'])) {
    // Assuming you have a database connection object named $pdo
    $orderIdToDelete = $_POST['order_id'];

    // Delete associated order items
    $deleteOrderItemsQuery = "DELETE FROM order_items WHERE order_id = :orderId";
    $orderItemsStatement = $pdo->prepare($deleteOrderItemsQuery);
    $orderItemsStatement->bindParam(':orderId', $orderIdToDelete, PDO::PARAM_INT);
    $orderItemsStatement->execute();

    // Delete the order
    $deleteOrderQuery = "DELETE FROM orders WHERE id = :orderId";
    $orderStatement = $pdo->prepare($deleteOrderQuery);
    $orderStatement->bindParam(':orderId', $orderIdToDelete, PDO::PARAM_INT);
    $orderStatement->execute();

    // Redirect to a page or take further actions as needed
    header("Location: OrdersList.php");
    exit();
}
?>