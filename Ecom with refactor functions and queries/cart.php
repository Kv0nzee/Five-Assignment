<?php 
    require('core/bootstrap.php');
    //header
    require('./components/header.php');

    $qty =0;
    $total = 0;
    $subtotal = 0;

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    
        $productId = $_POST['product_id'];
    
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
    
?>
<style>
    @layer utilities {
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
  }

  @layer utilities {
      /* Hide scrollbar for Chrome, Safari and Opera */
      .no-scrollbar::-webkit-scrollbar {
          display: none;
      }
     /* Hide scrollbar for IE, Edge and Firefox */
      .no-scrollbar {
          -ms-overflow-style: none;  /* IE and Edge */
          scrollbar-width: none;  /* Firefox */
    }
  }
</style>
<div class="pt-10 bg-gray-100 ">
<h1 class="mb-4 text-2xl font-bold text-center">Cart Items</h1>
    <div class="justify-center max-w-5xl min-h-screen px-6 mx-auto md:flex md:space-x-6 xl:px-0">
        <?php if(empty($_SESSION['cart'])): ?>
            <p class="text-lg font-bold text-center">Your cart is empty.</p>
        <?php else: ?>
        <div class="h-[400px] overflow-y-scroll rounded-lg no-scrollbar md:w-2/3">
            <?php foreach ($_SESSION['cart'] as $product): ?>
                <form method="POST">
                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                    <div class="justify-between p-6 mb-6 bg-white rounded-lg shadow-md sm:flex sm:justify-start">
                        <a href="productDetail.php?id=<?= $product['id'] ?>"><img src="<?= $product['productImg'] ?>" alt="product-image" class="w-full h-16 rounded-lg sm:w-40" /></a>
                        <div class="sm:ml-4 sm:flex sm:w-full sm:justify-between">
                            <div class="mt-5 sm:mt-0">
                                <h2 class="text-lg font-bold text-gray-900"><?= $product['name'] ?></h2>
                                <p class="mt-1 text-xs text-gray-700"><?= $product['description'] ?></p>
                            </div>
                            <div class="flex justify-between mt-4 sm:space-y-6 sm:mt-0 sm:block sm:space-x-6">
                                <div class="flex items-center border-gray-100">
                                    <button type="submit" name="decrease_quantity" class="cursor-pointer rounded-l bg-gray-100 py-1 px-3.5 duration-100 hover:bg-blue-500 hover:text-blue-50"> - </button>
                                    <input class="w-8 h-8 text-xs text-center bg-white border outline-none" type="number" name="quantity" value="<?= $product['qty'] ?>" min="1" />
                                    <button type="submit" name="increase_quantity" class="px-3 py-1 duration-100 bg-gray-100 rounded-r cursor-pointer hover:bg-blue-500 hover:text-blue-50"> + </button>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <p class="text-sm">$<?= $product['price'] ?></p>
                                    <a href="deleteCartProduct.php?id=<?= $product['id'] ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 duration-150 cursor-pointer hover:text-red-500">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            <?php
            $qty += $product['qty'];
            $subtotal += $product['price'] * $product['qty'];
            endforeach;
            $total = $subtotal + 20;
            ?>
        </div>
        <!-- Subtotal -->
        <div class="h-full p-6 mt-6 bg-white border rounded-lg shadow-md md:mt-0 md:w-1/3">
            <div class="flex justify-between mb-2">
                <p class="text-gray-700">Subtotal</p>
                <p class="text-gray-700">$<?= $subtotal ?></p>
            </div>
            <div class="flex justify-between mb-2">
                <p class="text-gray-700">Quantity</p>
                <p class="text-gray-700"><?= $qty ?></p>
            </div>
            <div class="flex justify-between">
                <p class="text-gray-700">Shipping</p>
                <p class="text-gray-700">$20</p>
            </div>
            <hr class="my-4" />
            <div class="flex justify-between">
                <p class="text-lg font-bold">Total</p>
                <div class="">
                    <p class="mb-1 text-lg font-bold">$<?= $total ?>USD</p>
                    <p class="text-sm text-gray-700">including VAT</p>
                </div>
            </div>
            <form method="POST" action="checkout.php">
            <button name="checkout" class="mt-6 w-full rounded-md py-1.5 font-medium text-white <?php echo isset($_SESSION['user']) ? 'bg-violet-500 hover:bg-violet-600' : 'bg-gray-300'; ?>" <?php if (!isset($_SESSION['user'])) echo 'disabled'; ?>>
                Check out
            </button>
                <input type="text" hidden value="<?= $total ?>" name="total">
                <input type="text" hidden value="<?= $subtotal ?>" name="subtotal">
                <input type="text" hidden value="<?= $qty ?>" name="qty">
            </form>
        </div>
        <?php endif; ?>
    </div>
</div>
    <?php require("./components/footer.php") ?>
