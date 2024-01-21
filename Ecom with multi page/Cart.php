<?php
require_once("./components/navbar.php");

$total_qty = 0;
$total_amount = 0.0;

// Calculate total quantity and amount in the cart
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $product) {
        $total_qty += $product['qty'];
        $total_amount += $product['qty'] * $product['productPrice'];
    }
}

// Handle form submissions
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
    header('Refresh:0');
}
?>

<section class=" h-custom" style="background-color: #eee;">
    <div class="container py-5 ">
        <div class="row d-flex justify-content-center  ">
            <div class="col">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-lg-7">
                                <h5 class="mb-3"><a href="./" class="text-body"><i
                                            class="fas fa-long-arrow-alt-left me-2"></i>Continue
                                        shopping</a></h5>
                                <hr>

                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div>
                                        <p class="mb-1">Shopping cart</p>
                                        <p class="mb-0">You have <?= $total_qty ?> items in your cart</p>
                                    </div>
                                </div>

                                <?php
                                    if (!isset($_SESSION['cart'])) {
                                        echo "<h2>There is no item in your cart.</h2>";
                                    } else {
                                        foreach ($_SESSION['cart'] as $productId => $product) :
                                    ?>
                                        <form method="POST">
                                            <div class="card mb-3">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="d-flex flex-row align-items-center">
                                                            <div>
                                                                <img src="<?= $product['imagePath'] ?>" class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                                                            </div>
                                                            <div class="ms-3">
                                                                <h5><?= $product['productName'] ?></h5>
                                                                <p class="small mb-0"><?= $product['productCat'] ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <div class="input-group d-flex align-items-center quantity-container" style="max-width: 120px;">
                                                                <div class="input-group-prepend">
                                                                    <button name="decrease_quantity[<?= $productId ?>]" class="btn btn-outline-black decrease" type="submit">&minus;</button>
                                                                </div>
                                                                <input name="quantity[<?= $productId ?>]" type="text" class="form-control text-center quantity-amount" value="<?= $product['qty'] ?>" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                                                                <div class="input-group-append">
                                                                    <button name="increase_quantity[<?= $productId ?>]" class="btn btn-outline-black increase" type="submit">&plus;</button>
                                                                </div>
                                                            </div>
                                                            <div style="width: 100px;">
                                                                <h5 class="mb-0">$<?= $product['productPrice'] ?></h5>
                                                            </div>
                                                            <form method="POST" class="mb-0" action="deleteCartProduct.php">
                                                                <input type="hidden" name="id" value="<?= $product['productID'] ?>">
                                                                <button type="submit" name="remove_item[<?= $productId ?>]" class="btn btn-link" style="color: #cecece;"><i class="fas fa-trash-alt"></i></button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    <?php endforeach;
                                    } ?>
                            </div>
                            <div class="col-lg-5">
                                <div class="card bg-dark text-white rounded-3">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <h5 class="mb-0 text-white">Card details</h5>
                                        </div>

                                        <div class="d-flex justify-content-between mb-4">
                                            <p class="mb-2">Total(Incl. taxes)</p>
                                            <p class="mb-2">$<?= $total_amount ?></p>
                                        </div>
                                        <?php if (isset($_SESSION['user']) && isset($_SESSION['cart']) && count($_SESSION['cart']) >= 1) { ?>
                                            <form method="POST" action="checkout.php">
                                                <input type="text" hidden value="<?= $total_amount ?>" name="total">
                                                <input type="text" hidden value="<?= $total_qty ?>" name="qty">
                                                <button type="submit" class="btn btn-primary btn-block btn-lg">
                                                    <div class="d-flex justify-content-between w-100">
                                                        <span>$<?= $total_amount ?> </span>
                                                        <span> Checkout <i class="fas fa-long-arrow-alt-right ms-2"></i></span>
                                                    </div>
                                                </button>
                                            </form>
                                        <?php } ?>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
