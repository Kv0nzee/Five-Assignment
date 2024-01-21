<?php 
   require('core/bootstrap.php');

if (!$_SESSION['user']) {
    redirect("cart.php");
    exit();
}

if(isset($_POST['total']) && isset($_POST['subtotal']) && isset($_POST['qty'])){
    $subtotal = $_POST['subtotal'];
    $total = $_POST['total'];
    $qty = $_POST['qty'];
}

if (isset($_POST['createorder'])) {
    $userId = $_SESSION['user']->id;

    $productData = [
        'user_id' => $userId,
    ];
    $data = createOrder($productData);

    $orderId = findLastInsertId();

    foreach ($_SESSION['cart'] as $product) {
        $orderItemData = [
            'order_id' => $orderId,
            'product_id' => $product['id'],
            'quantity' => $product['qty'],
        ];
        $data = createOrderItem($orderItemData);
    }

    $_SESSION['cart'] = array();

    redirect("/ecomAssignment");
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

<div class="flex items-center justify-center px-4 py-8 md:px-6 2xl:px-0 2xl:mx-auto 2xl:container">
            <div class="flex flex-col items-start justify-start w-full space-y-9">
                <div class="flex flex-col items-start justify-start space-y-2">
                    <a href="cart.php">
                        <button class="flex flex-row items-center space-x-1 text-gray-600 hover:text-gray-500">
                            <svg class="fill-stroke" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.91681 7H11.0835" stroke="currentColor" stroke-width="0.666667" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M2.91681 7L5.25014 9.33333" stroke="currentColor" stroke-width="0.666667" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M2.91681 7.00002L5.25014 4.66669" stroke="currentColor" stroke-width="0.666667" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <p class="text-sm leading-none">Back</p>
                        </button>
                    </a>
                    <p class="text-3xl font-semibold leading-7 text-gray-800 lg:text-4xl lg:leading-9 ">Checkout</p>
                    <p class="text-base leading-normal text-gray-600 sm:leading-4 ">Home > Cart >  Checkout</p>
                </div>
                
    
                <div class="flex flex-col justify-center w-full space-y-6 xl:flex-row xl:justify-between xl:space-y-0 xl:space-x-6">
                    <div class="w-full h-full">
                        <div class="h-full p-6 mt-6 bg-white rounded-lg md:mt-0 ">
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
                        </div>
                        <div class="h-[400px] w-full overflow-y-scroll rounded-lg no-scrollbar">
                            <?php foreach ($_SESSION['cart'] as $product): ?>
                                <form method="POST">
                                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                    <div class="justify-between p-6 mb-6 bg-white rounded-lg shadow-md sm:flex sm:justify-start">
                                        <a href="productDetail.php?id=<?= $product['id'] ?>"><img src="<?= $product['productImg'] ?>" alt="product-image" class="w-full h-16 rounded-lg sm:w-40" /></a>
                                        <div class="items-start sm:ml-4 sm:flex sm:w-full sm:justify-between">
                                            <div class="mt-5 sm:mt-0">
                                                <h2 class="text-lg font-bold text-gray-900"><?= $product['name'] ?></h2>
                                                <p class="mt-1 text-xs text-gray-700"><?= $product['description'] ?></p>
                                            </div>
                                            <div class="flex justify-between mt-4 sm:space-y-6 sm:mt-0 sm:block sm:space-x-6">
                                                <div class="flex items-center justify-center ">
                                                    <div class="w-16 text-xs text-center outline-none">Qty :<?= $product['qty'] ?></div>
                                                </div>
                                                <div class="flex items-center space-x-4">
                                                    <p class="text-sm">$<?= $product['price'] ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            <?php
                            endforeach;
                            ?>
                        </div>
                    </div>
                    <div class="flex flex-col p-8 bg-gray-100 lg:w-full xl:w-3/5">
                        <button class="flex flex-row items-center justify-center w-full py-4 space-x-2 text-white bg-gray-900 border border-transparent rounded hover:border-gray-300 hover:bg-white hover:text-gray-900">
                            <div>
                                <svg class="fill-current" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10.9099 4.27692C9.6499 4.27692 9.1174 4.87817 8.2399 4.87817C7.34021 4.87817 6.65396 4.28129 5.56208 4.28129C4.49333 4.28129 3.35365 4.93379 2.6299 6.04535C1.61365 7.61285 1.78615 10.565 3.43208 13.08C4.02083 13.9804 4.80708 14.99 5.83833 15.001H5.85708C6.75333 15.001 7.01958 14.4141 8.25302 14.4072H8.27177C9.48677 14.4072 9.73052 14.9975 10.623 14.9975H10.6418C11.673 14.9866 12.5015 13.8679 13.0902 12.971C13.514 12.326 13.6715 12.0022 13.9965 11.2725C11.6155 10.3688 11.233 6.99348 13.5877 5.69942C12.869 4.79942 11.859 4.27817 10.9068 4.27817L10.9099 4.27692Z"
                                        fill="currentColor"
                                    />
                                    <path d="M10.6338 1C9.88379 1.05094 9.00879 1.52844 8.49629 2.15188C8.03129 2.71688 7.64879 3.555 7.79879 4.36781H7.85879C8.65754 4.36781 9.47504 3.88688 9.95254 3.27063C10.4125 2.68406 10.7613 1.85281 10.6338 1V1Z" fill="currentColor" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-base leading-4">Pay</p>
                            </div>
                        </button>
    
                        <div class="flex flex-row items-center justify-center mt-6">
                            <hr class="w-full border" />
                            <p class="flex flex-shrink-0 px-4 text-base leading-4 text-gray-600 ">or pay with card</p>
                            <hr class="w-full border" />
                        </div>
    
                        <div class="mt-8">
                            <input class="w-full p-4 text-base leading-4 text-gray-600 placeholder-gray-600 border border-gray-300 rounded" type="email" name="" id="" placeholder="Email" />
                        </div>
    
                        <label class="mt-8 text-base leading-4 text-gray-800 ">Card details</label>
                        <div class="flex-col mt-2">
                            <div>
                                <input class="w-full p-4 text-base leading-4 text-gray-600 placeholder-gray-600 border border-gray-300 rounded-tl rounded-tr" type="email" name="" id="" placeholder="0000 1234 6549 15151" />
                            </div>
                            <div class="flex flex-row">
                                <input class="w-full p-4 text-base leading-4 text-gray-600 placeholder-gray-600 border border-gray-300 rounded-bl" type="email" name="" id="" placeholder="MM/YY" />
                                <input class="w-full p-4 text-base leading-4 text-gray-600 placeholder-gray-600 border border-gray-300 rounded-br" type="email" name="" id="" placeholder="CVC" />
                            </div>
                        </div>
    
                        <label class="mt-8 text-base leading-4 text-gray-800 ">Name on card</label>
                        <div class="flex-col mt-2">
                            <div>
                                <input class="w-full p-4 text-base leading-4 text-gray-600 placeholder-gray-600 border border-gray-300 rounded" type="email" name="" id="" placeholder="Name on card" />
                            </div>
                        </div>
    
                        <label class="mt-8 text-base leading-4 text-gray-800 ">Country or region</label>
                        <div class="flex-col mt-2">
                            <div class="relative ">
                                <button id="changetext" class="w-full p-4 text-base leading-4 text-left text-gray-600 placeholder-gray-600 bg-white border border-gray-300 rounded-tl rounded-tr" type="email" name="" id="">Yangon</button>    
                                   <img onclick="showMenu(true)" id="closeIcon" class="absolute cursor-pointer top-4 right-4 " src="https://tuk-cdn.s3.amazonaws.com/can-uploader/checkouts-1-svg1.svg" alt="Dropdown">
                                    <img onclick="showMenu(true)" id="openIcon" class="absolute hidden transform rotate-180 cursor-pointer top-4 right-4 " src="https://tuk-cdn.s3.amazonaws.com/can-uploader/checkouts-1-svg1.svg" alt="Dropdown">
                                <div id="dropdown" class="z-10 flex-col justify-start hidden w-full text-gray-600 bg-gray-50">
                                    <div onclick="changeText('Mandalay')" class="px-4 py-2 cursor-pointer hover:bg-gray-800 hover:text-white">Mandalay</div>
                                    <div onclick="changeText('Taunggyi')" class="px-4 py-2 cursor-pointer hover:bg-gray-800 hover:text-white">Taunggyi</div>
                                    <div onclick="changeText('MuSe')" class="px-4 py-2 cursor-pointer hover:bg-gray-800 hover:text-white">Muse</div>
                                </div>
                            </div>
                            <input class="w-full p-4 text-base leading-4 text-gray-600 placeholder-gray-600 border border-gray-300 rounded-bl rounded-br" type="text" name="" id="" placeholder="ZIP" />
                        </div>
    
                        <form method="POST">
                            <button name="createorder" class="flex items-center justify-center w-full py-4 mt-8 text-white bg-gray-900 border border-transparent rounded hover:border-gray-300 hover:bg-white hover:text-gray-900">
                                    <p  class="text-base leading-4">Order</p>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    let closeIcon = document.getElementById("closeIcon");
let openIcon = document.getElementById("openIcon");
let dropdown = document.getElementById("dropdown");
let text = document.getElementById("changetext");

const showMenu = (flag) => {
    if (flag) {
        closeIcon.classList.toggle("hidden");
        openIcon.classList.toggle("hidden");
        dropdown.classList.toggle("hidden");
    } else {
        closeIcon.classList.toggle("hidden");
        openIcon.classList.toggle("hidden");
        dropdown.classList.toggle("hidden");
    }
};

const changeText = (country) => {
    text.innerHTML = country;
    closeIcon.classList.toggle("hidden");
    openIcon.classList.toggle("hidden");
    dropdown.classList.toggle("hidden");
};

</script>