<?php
require_once("Connect.php");

$qty = 0;
$total = 0;
$subtotal = 0;

if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $value) {
        $qty += $value['qty'];
        $subtotal += $value['price'] * $value['qty'];
    }
    $total = $subtotal + 20;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    
  $productId = $_POST['id'];

  if (isset($_POST['increase_quantity'])) {
     
      $_SESSION['cart'][$productId]['qty'] += 1;
  } elseif (isset($_POST['decrease_quantity'])) {

      if ($_SESSION['cart'][$productId]['qty'] > 1) {
          $_SESSION['cart'][$productId]['qty'] -= 1;
      } else {
          unset($_SESSION['cart'][$productId]);
      }
  } elseif (isset($_POST['remove_item'])) {
      unset($_SESSION['cart'][$productId]);
  }

  header("Location: Cart.php");
  exit();
}


require_once("navbar.php");

?>

<section class="h-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col">
        <div class="card">
          <div class="card-body p-4">
            <div class="row">
              <div class="col-lg-7">
                <h5 class="mb-3 text-white"><a href="userProductView.php" class="btn  btn-light #cecece "><i
                      class="fas fa-long-arrow-alt-left me-2 "></i>Continue shopping</a></h5>
                <hr>

                <div class="d-flex justify-content-between align-items-center mb-4">
                  <div>
                    <p class="mb-1">Shopping cart</p>
                    <p class="mb-0">You have <?= $qty ?> items in your cart</p>
                  </div>
                </div>

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
                          <form method="POST">
                          <div class="d-flex align-items-center">
                              <div class="input-group d-flex align-items-center quantity-container" style="max-width: 120px;">
                                  <div class="input-group-prepend">
                                      <button name="decrease_quantity" class="btn btn-outline-black decrease" type="submit">&minus;</button>
                                  </div>
                                  <input name="quantity" type="text" class="form-control text-center quantity-amount" value="<?= $item['qty'] ?>" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                                  <div class="input-group-append">
                                      <button name="increase_quantity" class="btn btn-outline-black increase" type="submit">&plus;</button>
                                  </div>
                              </div>
                              <div style="width: 100px;">
                                  <h5 class="mb-0">$<?= $item['price'] ?></h5>
                              </div>
                              <form method="POST" class="mb-0" action="deleteCartProduct.php">
                                  <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                  <button type="submit" name="remove_item[<?= $item['id'] ?>]" class="btn btn-link" style="color: #cecece;"><i class="fas fa-trash-alt"></i></button>
                              </form>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                <?php else: ?>
                  <p>Your cart is empty.</p>
                <?php endif; ?>
              </div>

              <div class="col-lg-5">
                <div class="d-flex justify-content-between">
                  <p class="mb-2">Subtotal</p>
                  <p class="mb-2">$<?= $subtotal ?></p>
                </div>

                <div class="d-flex justify-content-between">
                  <p class="mb-2">Shipping</p>
                  <p class="mb-2">$20.00</p>
                </div>

                <div class="d-flex justify-content-between mb-4">
                  <p class="mb-2">Total(Incl. taxes)</p>
                  <p class="mb-2">$<?= $total ?></p>
                </div>

                <form method="POST" action="checkout.php">
                  <?php
                    if(isset($_SESSION['user'])){ 
                  ?>
                  <input type="text" name="total" hidden value="<?= $total ?>">
                  <input type="text" name="subtotal" hidden value="<?= $subtotal ?>">
                  <input type="text" name="qty" hidden value="<?= $qty ?>">
                  <button type="submit" class="btn btn-info btn-block btn-lg">
                    <div class="d-flex justify-content-between">
                      <span>$<?= $total ?></span>
                      <span> Checkout <i class="fas fa-long-arrow-alt-right ms-2"></i></span>
                    </div>
                  </button>
                  <?php }?>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
