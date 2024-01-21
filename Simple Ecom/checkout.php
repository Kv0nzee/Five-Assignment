<?php
require_once("Connect.php");

if (!$_SESSION['user']) {
  header("location:cart.php");
  exit();
}


if(isset($_POST['total']) && isset($_POST['subtotal']) && isset($_POST['qty'])){
  $subtotal = $_POST['subtotal'];
  $total = $_POST['total'];
  $qty = $_POST['qty'];
}


require_once("navbar.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['checkout'])) {
    $userId = $_SESSION['user']['id'];
    $orderDate = date("Y-m-d H:i:s");

    try {
        $pdo->beginTransaction();

        $insertOrderQuery = "INSERT INTO orders (user_id, order_date) VALUES (?, ?)";
        $stmt = $pdo->prepare($insertOrderQuery);
        $stmt->execute([$userId, $orderDate]);

        $orderId = $pdo->lastInsertId();

        foreach ($_SESSION['cart'] as $product) {
            $productId = $product['id'];
            $quantity = $product['stockQuantity'];

            $insertOrderItemQuery = "INSERT INTO order_items (order_id, product_id, quantity) VALUES (?, ?, ?)";
            $stmt = $pdo->prepare($insertOrderItemQuery);
            $stmt->execute([$orderId, $productId, $quantity]);
        }

        $pdo->commit();

        unset($_SESSION['cart']);

        header("Location: UserProductView.php");
        exit();
    } catch (PDOException $e) {
        $pdo->rollBack();
        echo "Error: " . $e->getMessage();
    }
}
?>

<div class="container mt-4 p-0">
    <div class="row px-md-4 px-2 pt-4">
        <div class="col-lg-8">
            <p class="pb-2 fw-bold">Order</p>
            <?php if (!empty($_SESSION['cart'])): ?>
                  <?php foreach ($_SESSION['cart'] as $item): ?>
                    <div class="card mb-3">
                      <div class="card-body">
                        <div class="d-flex justify-content-between">
                          <div class="d-flex flex-row align-items-center">
                            <div>
                              <img src="<?= $item['img'] ?>" class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                            </div>
                            <div class="ms-3">
                              <h5><?= $item['name'] ?></h5>
                              <p class="small mb-0"><?= $item['category'] ?></p>
                            </div>
                          </div>
                          <div class="d-flex flex-row align-items-center">
                            <div style="width: 50px;">
                              <h5 class="fw-normal mb-0"><?= $item['qty'] ?></h5>
                            </div>
                            <div style="width: 80px;">
                              <h5 class="mb-0">$<?= $item['price'] ?></h5>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                <?php else: ?>
                  <p>Your cart is empty.</p>
                <?php endif; ?>
        </div>
        <div class="col-lg-4 payment-summary">
            <p class="fw-bold pt-lg-0 pt-4 pb-2">Payment Summary</p>
            <div class="card px-md-3 px-2 pt-4">
                <div class="unregistered mb-4"> <span class="py-1">Gmail : <?= $_SESSION['user']['email'] ?></span> </div>
                <div class="d-flex justify-content-between pb-3"> <small class="text-muted">Transaction code</small>
                    <p class="">VC115665</p>
                </div>
                <div class="d-flex justify-content-between b-bottom"> <input type="text" class="ps-2" placeholder="COUPON CODE">
                    <div class="btn btn-primary">Apply</div>
                </div>
                <div class="d-flex flex-column b-bottom">
                    <div class="d-flex justify-content-between py-3"> <small class="text-muted">Quantity</small>
                        <p> <?=$qty ?></p>
                    </div>
                    <div class="d-flex justify-content-between py-3"> <small class="text-muted">Order Summary</small>
                        <p>$ <?=$subtotal ?></p>
                    </div>
                    <div class="d-flex justify-content-between pb-3"> <small class="text-muted">Additional Service</small>
                        <p>$20</p>
                    </div>
                    <div class="d-flex justify-content-between"> <small class="text-muted">Total Amount</small>
                        <p>$<?=$total ?></p>
                    </div>
                </div>
                <form method="POST">
                    <?php
                    if ($_SESSION['user']) {
                    ?>
                    <button name="checkout" type="submit" class="btn btn-info btn-block btn-lg">
                        <div class="d-flex justify-content-between">
                            <span> Order <i class="fas fa-long-arrow-alt-right ms-2"></i></span>
                        </div>
                    </button>
                    <?php
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>