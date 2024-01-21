<?php
require('./components/header.php');

$qty = 0;
$total = 0;
$subtotal = 0;

if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $value) {
        $qty += $value['qty'];
        $subtotal += $value['productPrice'] * $value['qty'];
    }
    $total = $subtotal + 20;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST['quantity'] as $productId => $quantity) {
        $quantity = intval($quantity);

        if (isset($_POST['increase_quantity'][$productId])) {
            $_SESSION['cart'][$productId]['qty'] += 1;
        } elseif (isset($_POST['decrease_quantity'][$productId])) {
            if ($_SESSION['cart'][$productId]['qty'] > 1) {
                $_SESSION['cart'][$productId]['qty'] -= 1;
            } else {
                unset($_SESSION['cart'][$productId]);
            }
        } elseif (isset($_POST['remove_item'][$productId])) {
            unset($_SESSION['cart'][$productId]);
        }
    }
}

?>

<!-- Start Hero Section -->
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>Cart</h1>
                </div>
            </div>
            <div class="col-lg-7">

            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->

<div class="untree_co-section before-footer-section">
    <div class="container">
        <div class="row mb-5">
            <form class="col-md-12" method="post" action="Cart.php">
                <div class="site-blocks-table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="product-thumbnail">Image</th>
                                <th class="product-name">Product</th>
                                <th class="product-price">Price</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-total">Total</th>
                                <th class="product-remove">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if(!isset($_SESSION['cart'])){
                                    echo "<h3 class='text-black h4 text-uppercase'>No items are currently available</h3>";

                                }else{
                                foreach ($_SESSION['cart'] as $productId => $product) { 

							?>
                                <tr>
                                    <td class="product-thumbnail">
                                        <img src="<?= $product['productImg']?>" alt="Image" class="img-fluid">
                                    </td>
                                    <td class="product-name">
                                        <h2 class="h5 text-black"><?= $product['productName'] ?></h2>
                                    </td>
                                    <td><?= $product['productPrice'] ?></td>
                                    <td>
                                        <div class="input-group mb-3 d-flex align-items-center quantity-container" style="max-width: 120px;">
                                            <div class="input-group-prepend">
                                                <button name="decrease_quantity[<?= $productId ?>]" class="btn btn-outline-black decrease" type="submit">&minus;</button>
                                            </div>
                                            <input name="quantity[<?= $productId ?>]" type="text" class="form-control text-center quantity-amount" value="<?= $product['qty'] ?>" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                                            <div class="input-group-append">
                                                <button name="increase_quantity[<?= $productId ?>]" class="btn btn-outline-black increase" type="submit">&plus;</button>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?= $product['productPrice'] * $product['qty'] ?></td>
                                    <td><button name="remove_item[<?= $productId ?>]" class="btn btn-black btn-sm">X</button></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <a href="./" class="btn btn-outline-black btn-sm btn-block">Continue Shopping</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="text-black h4" for="coupon">Coupon</label>
                                <p>Enter your coupon code if you have one.</p>
                            </div>
                            <div class="col-md-8 mb-3 mb-md-0">
                                <input type="text" class="form-control py-3" id="coupon" placeholder="Coupon Code">
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-black">Apply Coupon</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 pl-5">
                        <div class="row justify-content-end">
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-12 text-right border-bottom mb-5">
                                        <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                                    </div>
                                </div>
								<div class="row mb-3">
                                    <div class="col-md-6">
                                        <span class="text-black">Quantity</span>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <strong class="text-black"><?= $qty ?></strong>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <span class="text-black">Subtotal</span>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <strong class="text-black">$<?= $subtotal ?></strong>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <div class="col-md-6">
                                        <span class="text-black">Total</span>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <strong class="text-black">$<?= $total ?></strong>
                                    </div>
                                </div>

                                <div class="row">
									<?php if (isset($_SESSION['user'])) { ?>
                                    <div class="col-md-12">
                                        <a href="checkout.php" class="btn btn-black btn-lg py-3 btn-block">Proceed To Checkout</a>
                                    </div>
									<?php }}?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

</div>

<?php require("./components/footer.php") ?>
