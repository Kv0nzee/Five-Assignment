<?php
require('./components/header.php');
if (isset($_SESSION['user'])) {
    $loggedInUser = $_SESSION['user'];

    $orders = getAllOrdersbyUser($loggedInUser['userID']);

} else {
    // If the user is not logged in, redirect to the login page
    header("Location: ./");
    exit();
}

?>

<body>
    <div class="container mt-3">
        <h2>Order History</h2>

        <?php if (!empty($orders)) : ?>
            <table class="table table-striped ">
                <thead>
                    <tr class="text-center">
                        <th > Image</th>
                        <th>Order Date</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Payment Type</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order) : 
                        $product = getProductDetails($order['product_id']);
                    ?>
                        <tr class="text-center">
                            <td  class=" my-auto border-bottom-0" style="width:100px">
                                        <img src="<?= $product['productImg'] ?>" alt="Product Image" class="img-fluid">
                            </td>
                            <td class="my-auto"><?= $order['order_date'] ?></td>
                            <td class="my-auto"><?= $product['productName'] ?></td>
                            <td class="my-auto"><?= $order['quantity'] ?></td>
                            <td class="my-auto"><?= $order['paymentType'] ?></td>
                            <td class="my-auto">
                                <a href="OrderDetail.php?orderID=<?= $order['order_id'] ?>" class="btn btn-primary">View Details</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>No order history available.</p>
        <?php endif; ?>

        <a href="./" class="btn btn-primary mt-3 mb-5">Back to Product View</a>
    </div>
    <?php 
    require('./components/footer.php');
?>
