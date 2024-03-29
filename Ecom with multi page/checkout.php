<?php
require_once("./components/navbar.php");

$subtotal = 0;
$qty = 0;
$vat = 0;
$total = 0;

if (isset($_POST['total'])) {
    $subtotal = $_POST['total'];
    $qty = $_POST['qty'];
    $vat = ($subtotal * 20) / 100;
    $total = $subtotal + $vat;
}

$userID = $_SESSION['user']['userID'];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['place_order'])) {
    // Retrieve form data
    $address = htmlspecialchars($_POST['address']);
    $total = $_POST['total'];

    // Insert order details into the 'orders' table
    $insertOrderSQL = "INSERT INTO orders (userID, orderDate, address, totalPrice) VALUES (:userID, NOW(), :address, :totalPrice)";
    $stmt = $pdo->prepare($insertOrderSQL);
    $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
    $stmt->bindParam(':address', $address, PDO::PARAM_STR);
    $stmt->bindParam(':totalPrice', $total, PDO::PARAM_INT);
    $stmt->execute();

    // Retrieve the order ID that was just inserted
    $orderID = $pdo->lastInsertId();

    // Store the order ID in the session variable
    $_SESSION['orderID'] = $orderID;

    // Insert order items into the 'order_items' table
    $insertOrderItemSQL = "INSERT INTO order_items (orderID, productID, quantity) VALUES (:orderID, :productID, :quantity)";
    $stmtOrderItem = $pdo->prepare($insertOrderItemSQL);

    foreach ($_SESSION['cart'] as $productID => $product) {
        // Bind parameters
        $stmtOrderItem->bindParam(':orderID', $orderID, PDO::PARAM_INT);
        $stmtOrderItem->bindParam(':productID', $productID, PDO::PARAM_INT);
        $stmtOrderItem->bindParam(':quantity', $product['qty'], PDO::PARAM_INT);

        // Execute the statement
        $stmtOrderItem->execute();
    }

    // Clear the cart after placing the order
    $_SESSION['cart'] = [];

    // Redirect to order confirmation page
    header("Location: order_confirmation.php");
    exit();
}
?>
 
<style>
    
.container {
    max-width: 1200px;
    margin: 20px auto;
    overflow: hidden;
    background-color: #f8f9fa;
}

.box-1 {
    width: 1050px;
    padding: 10px 40px;
    user-select: none;
}

.box-1 div .fs-12 {
    font-size: 8px;
    color: white;
}

.box-1 div .fs-14 {
    font-size: 15px;
    color: white;
}

.box-1 img.pic {
    width: 20px;
    height: 20px;
    object-fit: cover;
}

.box-1 img.mobile-pic {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.box-1 .name {
    font-size: 11px;
    font-weight: 600;
}

.dis {
    font-size: 12px;
    font-weight: 500;
}

label.box {
    width: 100%;
    font-size: 12px;
    background: #ddd;
    margin-top: 12px;
    padding: 10px 12px;
    border-radius: 5px;
    cursor: pointer;
    border: 1px solid transparent;
}

#one:checked~label.first,
#two:checked~label.second,
#three:checked~label.third {
    border-color: #7700ff;
}

#one:checked~label.first .circle,
#two:checked~label.second .circle,
#three:checked~label.third .circle {
    border-color: #7a34ca;
    background-color: #fff;
}

label.box .course {
    width: 100%;
}

label.box .circle {
    height: 12px;
    width: 12px;
    background: #ccc;
    border-radius: 50%;
    margin-right: 15px;
    border: 4px solid transparent;
    display: inline-block;
}

input[type="radio"] {
    display: none;
}

.box-2 {
    max-width: 450px;
    padding: 10px 40px;
}


.box-2 .box-inner-2 input.form-control {
    font-size: 12px;
    font-weight: 600;
}

.box-2 .box-inner-2 .inputWithIcon {
    position: relative;
}

.box-2 .box-inner-2 .inputWithIcon span {
    position: absolute;
    left: 15px;
    top: 8px;
}

.box-2 .box-inner-2 .inputWithcheck {
    position: relative;
}

.box-2 .box-inner-2 .inputWithcheck span {
    position: absolute;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background-color: green;
    font-size: 12px;
    color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    right: 15px;
    top: 6px;
}

.form-control:focus,
.form-select:focus {
    box-shadow: none;
    outline: none;
    border: 1px solid #7700ff;
}

.border:focus-within {
    border: 1px solid #7700ff !important;
}

.box-2 .card-atm .form-control {
    border: none;
    box-shadow: none;
}

.form-select {
    border-radius: 0;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;

}

.address .form-control.zip {
    border-radius: 0;
    border-bottom-left-radius: 10px;

}

.address .form-control.state {
    border-radius: 0;
    border-bottom-right-radius: 10px;

}

.box-2 .box-inner-2 .btn.btn-outline-primary {
    width: 120px;
    padding: 10px;
    font-size: 11px;
    padding: 0% !important;
    display: flex;
    align-items: center;
    border: none;
    border-radius: 0;
    background-color: whitesmoke;
    color: black;
    font-weight: 600;
}

.box-2 .box-inner-2 .btn.btn-primary {
    background-color: #7700ff;
    color: whitesmoke;
    font-size: 14px;
    display: flex;
    align-items: center;
    font-weight: 600;
    justify-content: center;
    border: none;
    padding: 10px;
}

.box-2 .box-inner-2 .btn.btn-primary:hover {
    background-color: #7a34ca;
}

.box-2 .box-inner-2 .btn.btn-primary .fas {
    font-size: 13px !important;
    color: whitesmoke;
}

.carousel-indicators [data-bs-target] {
    width: 10px;
    height: 10px;
    border-radius: 50%;
}

.carousel-inner {
    width: 100%;
    height: 250px;
}

.carousel-item img {
    object-fit: cover;
    height: 100%;
}

.carousel-control-prev {
    transform: translateX(-50%);
    opacity: 1;
}

.carousel-control-prev:hover .fas.fa-arrow-left {
    transform: translateX(-5px);
}

.carousel-control-next {
    transform: translateX(50%);
    opacity: 1;
}

.carousel-control-next:hover .fas.fa-arrow-right {
    transform: translateX(5px);
}

.fas.fa-arrow-left,
.fas.fa-arrow-right {
    font-size: 0.8rem;
    transition: all .2s ease;
}

.icon {
    width: 30px;
    height: 30px;
    background-color: #f8f9fa;
    color: black;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transform-origin: center;
    opacity: 1;
}

.fas,
.fab {
    color: #6d6c6d;
}

::placeholder {
    font-size: 12px;
}

@media (max-width:768px) {
    .container {
        max-width: 700px;
        margin: 10px auto;
    }

    .box-1,
    .box-2 {
        max-width: 600px;
        padding: 20px 90px;
        margin: 20px auto;
    }

}

@media (max-width:426px) {

    .box-1,
    .box-2 {
        max-width: 400px;
        padding: 20px 10px;
    }

    ::placeholder {
        font-size: 9px;
    }
}
</style>

<div class="container d-lg-flex justify-content-between">
    <div class="box-1 bg-light user">
        <div class="d-flex align-items-center mb-3">
            <h2 class="text-dark"><?= $_SESSION['user']['userName'] ?></h2>
        </div>
       <div class="w-100">
       <?php foreach ($_SESSION['cart'] as $productId => $product) :
        ?>
            <form method="POST">
                <div class="card mb-3 w-100">
                    <div class="card-body w-100">
                    <div class="d-flex flex-row align-items-center justify-content-between">
                                <div class="d-flex  align-items-center" style="width:200px;">
                                <div>
                                    <img src="<?= $product['imagePath'] ?>" class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                                </div>
                                <div class="ms-3">
                                    <h5><?= $product['productName'] ?></h5>
                                    <p class="small mb-0"><?= $product['productCat'] ?></p>
                                </div>
                                </div>
                                <h5  >Quantity: <?= $product['qty'] ?></h5>
                                <div style="width: 100px; margin-bottom:0;">
                                    <h5 class="mb-0">$<?= $product['productPrice'] ?></h5>
                                </div>
                            </div>
                    </div>
                </div>
            </form>
        <?php endforeach;
         ?>
       </div>
    </div>
    <div class="box-2">
        <div class="box-inner-2">
            <div>
                <p class="fw-bold">Payment Details</p>
                <p class="dis mb-3">Complete your purchase by providing your payment details</p>
            </div>
            <form action="checkout.php" method="POST"> 
                <div class="mb-3">
                    <p class="dis fw-bold mb-2">Email address</p>
                    <input class="form-control" type="email" value="<?= $_SESSION['user']['userEmail'] ?>" readonly>
                </div>
                <div>
                    <p class="dis fw-bold mb-2">Card details</p>
                    <div class="d-flex align-items-center justify-content-between card-atm border rounded">
                        <div class="fab fa-cc-visa ps-3"></div>
                        <input type="text" class="form-control" placeholder="Card Details">
                        <div class="d-flex w-50">
                            <input type="text" class="form-control px-0" placeholder="MM/YY">
                            <input type="password" maxlength=3 class="form-control px-0" placeholder="CVV">
                        </div>
                    </div>
                    <div class="my-3 cardname">
                        <p class="dis fw-bold mb-2">Cardholder name</p>
                        <input class="form-control" type="text">
                    </div>
                    <div class="address">
                        <p class="dis fw-bold mb-3">Billing address</p>
                        <select name="address" class="form-select" aria-label="Default select example">
                            <option selected hidden>Yangoon</option>
                            <option value="1">Mandalay</option>
                            <option value="2">Taunggyi</option>
                            <option value="3">Sagaing</option>
                        </select>
                        <div class="d-flex">
                            <input class="form-control zip" type="text" placeholder="ZIP">
                            <input class="form-control state" type="text" placeholder="State">
                        </div>
                        <div class=" my-3">
                            <p class="dis fw-bold mb-2">VAT Number</p>
                            <div class="inputWithcheck">
                                <input class="form-control" type="text" value="GB012345B9">
                                <span class="fas fa-check"></span>
                            </div>
                        </div>
                        <div class="d-flex flex-column dis">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <p>Subtotal</p>
                        <p><span class="fas fa-dollar-sign"></span><?= $subtotal ?></p>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <p>Quantity</p>
                        <p></span><?= $qty ?></p>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <p>VAT<span>(20%)</span></p>
                        <p><span class="fas fa-dollar-sign"></span><?= $vat ?></p>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <p class="fw-bold">Total</p>
                        <p class="fw-bold"><span class="fas fa-dollar-sign"></span><?= $total?></p>
                    </div>
                    <input type="text" hidden name="total" value="<?= $total ?>">
                    <button type="submit" name="place_order" class="btn btn-primary mt-2">Pay<span class="fas fa-dollar-sign px-1"></span>35.80</button>
                </div>
            </form>
        </div>
    </div>
</div>