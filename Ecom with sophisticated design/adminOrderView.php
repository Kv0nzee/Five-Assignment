<?php
require('./components/sidebar.php');

$orders = getAllOrders();


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete"])) {
    $id = $_POST["order_id"];

    // Begin a transaction to ensure both deletions succeed or fail together
    $pdo->beginTransaction();

    try {
        // Delete from order_items table first
        $deleteOrderItems_sql = "DELETE FROM order_items WHERE order_id = ?";
        $stmtOrderItems = $pdo->prepare($deleteOrderItems_sql);
        $stmtOrderItems->execute([$id]);

        // Then, delete from orders table
        $deleteOrders_sql = "DELETE FROM orders WHERE id = ?";
        $stmtOrders = $pdo->prepare($deleteOrders_sql);
        $stmtOrders->execute([$id]);

        // If both deletions are successful, commit the transaction
        $pdo->commit();

        header("Location: adminorderview.php");
        exit();
    } catch (PDOException $e) {
        // An error occurred, rollback the transaction and handle the error
        $pdo->rollBack();
        echo "Error deleting order: " . $e->getMessage();
    }
}
?>


<div class="body-wrapper">
    <div class="col-lg-8 d-flex align-items-stretch w-100">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Orders View</h5>
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle w-100">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Order ID</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Product Name</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Category</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">User Name</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Order Date</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Quantity</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($orders as $order) {
                                $product = getProductDetails($order['product_id']);
                            ?>
                                <tr>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0"><?= $order['order_id'] ?></h6></td>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0"><?= $product['productName'] ?></h6></td>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0"><?= getProductCatName($product['catId']) ?></h6></td>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0"><?= getUserDetails($order['user_id'])['userName'] ?></h6></td>
                                    <td class="border-bottom-0"><p class="mb-0 fw-normal"><?= $order['order_date'] ?></p></td>
                                    <td class="border-bottom-0"><p class="mb-0 fw-normal"><?= $order['quantity'] ?></p></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>