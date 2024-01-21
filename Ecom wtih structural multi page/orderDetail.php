<?php
require('./components/header.php');

if (isset($_GET['orderID'])) {
    $orderID = $_GET['orderID'];
    $orderDetails = getAllOrdersbyorder_item($orderID);
    
    if (!$orderDetails) {
        // Redirect to the main page if the order is not found
        header("Location: ./");
        exit();
    }
} else {
    // Redirect to the main page if no orderID is provided
    header("Location: ./");
    exit();
}

$product = getProductDetails($orderDetails['product_id']);

?>

<body>
    <div class="container mt-3">
        <h2>Order Details</h2>

        <?php if (!empty($orderDetails)) : ?>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Order ID:</strong> <?= $orderDetails['order_id'] ?></p>
                    <p><strong>Order Date:</strong> <?= $orderDetails['order_date'] ?></p>
                    <p><strong>User ID:</strong> <?= $orderDetails['user_id'] ?></p>
                    <p><strong>Payment Type:</strong> <?= $orderDetails['paymentType'] ?></p>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr class="text-center">
                        <th>Product ID</th>
                        <th> Image</th>
                        <th> Name</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center">
                        <td><?= $orderDetails['product_id'] ?></td>
                        <td  class=" my-auto border-bottom-0" style="width:100px">
                            <img src="<?= $product['productImg'] ?>" alt="Product Image" class="img-fluid">
                        </td>
                        <td><?= $product['productName'] ?></td>
                        <td><?= $orderDetails['quantity'] ?></td>
                    </tr>
                </tbody>
            </table>
        <?php else : ?>
            <p>No order details available.</p>
        <?php endif; ?>

        <a href="./" class="btn btn-primary my-5">Back to Product View</a>
    </div>
<?php 
    require('./components/footer.php');
?>
