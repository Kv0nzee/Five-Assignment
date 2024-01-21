<?php
require('./components/header.php');

$quantity = 1;

if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    $productDetails = getProductDetails($productId);
} else {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["add_to_cart"])) {
    $id = $productDetails['productID'];
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (!isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id] = [
            'productID'             => $id,
            'productName'           => $productDetails['productName'],
            'productDescription'    => $productDetails['productDescription'],
            'catId'       => getProductCatName($productDetails['catId']),
            'productPrice'          => $productDetails['productPrice'],
            'productStock'  => $productDetails['productStock'],
            'productImg'            => $productDetails['productImg'],
            'qty'            => $_POST['quantity']
        ];
    } else {
        $_SESSION['cart'][$id]["qty"] += $_POST['quantity'];
    }
    header("Location: ./");
    exit();
}
?>

<!-- Product Detail Section -->
<div class="container mt-5" style="min-height:500px;">
    <div class="row">
        <div class="col-lg-6">
            <img src="<?= $productDetails['productImg'] ?>" class="img-fluid" alt="<?= $productDetails['productName'] ?>">
        </div>
        <div class="col-lg-6">
            <h1 class="product-title"><?= $productDetails['productName'] ?></h1>
            <p class="text-muted mb-3">Category: <?= getProductCatName($productDetails['catId']) ?></p>
            <p class="text-muted mb-3">Price: $<?= $productDetails['productPrice'] ?></p>
            <p class="text-muted mb-3">Stock: <?= $productDetails['productStock'] ?></p>
            <p><?= $productDetails['productDescription'] ?></p>
            <div class="d-flex align-items-center justify-content-between">
                <div class="input-group mb-3 d-flex align-items-center quantity-container" style="max-width: 220px;">
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-black decrease" type="button">&minus;</button>
                    </div>
                    <input type="text" class="form-control text-center quantity-amount" min="1" name="quantity" id="quantity" value="<?= $quantity ?>" placeholder="" aria-label="Example text with a button addon" aria-describedby="button-addon1">
                    <div class="input-group-append">
                        <button class="btn btn-outline-black increase" type="button">&plus;</button>
                    </div>
                </div>
                <!-- Add to Cart Button -->
                <form method="post">
                    <input type="hidden" name="quantity" id="hiiden-number" value="<?= $quantity ?>">
                    <button name="add_to_cart" type="submit" class="btn btn-primary text-center" style="height:70px; font:10px">Add to Cart</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require('./components/footer.php') ?>
<script>
    var forminputElement = document.getElementById('hiiden-number');
    var quantityInputElement = document.getElementById('quantity');

    $(document).ready(function () {
        $('.increase').click(function () {
            // quantityInputElement.value = parseInt(quantityInputElement.value) ;
            updateHiddenInput();
        });

        $('.decrease').click(function () {
            var value = parseInt(quantityInputElement.value);
            if (value > 1) {
                // quantityInputElement.value = value - 1;
                updateHiddenInput();
            }
        });

        // Update hidden input when the visible quantity input changes
        quantityInputElement.addEventListener('input', function () {
            updateHiddenInput();
        });

        function updateHiddenInput() {
            forminputElement.value = quantityInputElement.value;
        }
    });
</script>