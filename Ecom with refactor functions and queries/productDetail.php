<?php
require('core/bootstrap.php');
//header
require('./components/header.php');

$id = $_GET['id'];

$product = getProductById($id);
if (!$product) {
    redirect("/ecomAssignment");
    exit();
}

if(isset($_POST['submit'])){
    addToCart($product, $_POST['quantity']);
    redirect("cart.php");
}
?>

<style>
    .clip-pentagonlanbg {
        background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="90" height="40" viewBox="0 0 158 62" fill="none"><path d="M0 56V6C0 2.68629 2.68629 0 6 0H152C155.314 0 158 2.68629 158 6V28.626C158 30.1511 157.419 31.6191 156.376 32.7313L130.693 60.1053C129.559 61.3142 127.975 62 126.317 62H6C2.68629 62 0 59.3137 0 56Z" fill="%23374151"/></svg>');
        
        @media (min-width: 640px) {
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="158" height="62" viewBox="0 0 158 62" fill="none"><path d="M0 56V6C0 2.68629 2.68629 0 6 0H152C155.314 0 158 2.68629 158 6V28.626C158 30.1511 157.419 31.6191 156.376 32.7313L130.693 60.1053C129.559 61.3142 127.975 62 126.317 62H6C2.68629 62 0 59.3137 0 56Z" fill="%23374151"/></svg>');
        }
    }
</style>

<div class="items-start justify-center px-4 py-12 md:flex 2xl:px-20 md:px-6">
    <div class="hidden xl:w-2/6 lg:w-2/5 w-80 md:block">
        <img class="w-full" alt="Product Image" src="<?= $product->productImg; ?>" />
    </div>

    <div class="md:hidden">
        <img class="w-full" alt="Product Image" src="<?= $product->productImg; ?>" />
        <!-- Rest of the code for small screens -->
    </div>

    <!-- Product Details -->
    <div class="mt-6 xl:w-2/5 md:w-1/2 lg:ml-8 md:ml-6 md:mt-0">
        <!-- Product Category and Name -->
        <div class="pb-6 border-b border-gray-200">
            <p class="text-sm leading-none text-gray-300"><?= getCategoryName($product->category_id); ?></p>
            <div class="flex items-end justify-between">
                <h1 class="mt-2 text-xl font-semibold leading-7 text-gray-800 lg:text-2xl lg:leading-6 "><?= $product->name; ?></h1>
                <p class="text-sm leading-none text-gray-500">$<?= $product->price; ?></p>
            </div>
        </div>

        <div class="flex items-center justify-between py-4 border-b border-gray-200">
            <p class="text-base leading-4 text-gray-800">Tag Color</p>
            <div class="flex items-center justify-center">
                <div class="w-6 h-6 ml-3 mr-4 cursor-pointer <?= $product->category_id ? $productColors[$product->category_id % count($productColors) + 1 ] : 'bg-purple-700'  ?>"></div>
                <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/productDetail3-svg2.svg" alt="next">
            </div>
        </div>

        <!-- Product Category -->
        <div class="flex items-center justify-between py-4 border-b border-gray-200">
            <p class="text-base leading-4 text-gray-800">Category</p>
            <div class="flex items-center justify-center">
                <p class="mr-3 text-sm leading-none text-gray-600"><?= getCategoryName($product->category_id); ?></p>
                <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/productDetail3-svg2.svg" alt="next">
            </div>
        </div>

        <!-- Quantity Input -->
            <div class="flex justify-between my-4">
                        <div class="flex items-center justify-center clip-pentagonlanbg md:w-[158px] md:h-[62px] w-[90px] h-[40px]">
                            <i class="text-2xl text-gray-200 fa-solid fa-bars"></i>
                            <div class="ml-2 text-base font-bold leading-loose text-gray-200 font-space">
                                Quantity : <span id="quantity"><?= $product->quantity ?></span>
                            </div>
                        </div>
                        <div class="w-32 h-10 custom-number-input">
            <div class="relative flex flex-row w-full h-10 mt-1 bg-transparent rounded-lg">
                    <button data-action="decrement" class="w-20 h-full text-gray-300 bg-gray-800 rounded-l outline-none cursor-pointer hover:text-gray-700 hover:bg-gray-400">
                        <span class="m-auto text-2xl font-thin">−</span>
                    </button>
                    <input type="number" min="0" id="custom-input-number" class="flex items-center w-full font-semibold text-center text-gray-300 bg-gray-800 outline-none cursor-default focus:outline-none text-md hover:text-black focus:text-black md:text-base" value="1"></input>
                    <button data-action="increment" class="w-20 h-full text-gray-300 bg-gray-800 rounded-r cursor-pointer hover:text-gray-700 hover:bg-gray-400">
                        <span class="m-auto text-2xl font-thin">+</span>
                    </button>
                </div>
            </div>
            </div>
        <form   method="POST">
            <!-- Checkout Button -->
            <input type="number" min="0" id="hiiden-number" hidden name="quantity" value="1"></input>
            <button name="submit" class="w-[70%] md:h-[62px] h-[40px] rounded-xl flex items-center justify-center text-base leading-none text-white bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 hover:bg-gray-700">
                <i class="mr-3 fa-solid fa-cart-shopping"></i>
                Check out
            </button>
       </form>

        <!-- Product Description -->
        <div>
            <p class="text-base leading-normal text-gray-600 xl:pr-48 lg:leading-tight mt-7">Description: <?= $product->description ?></p>
        </div>

        <!-- Shipping and Returns -->
        <div data-menu class="py-4 border-t border-b border-gray-200 mt-7">
            <div  class="flex items-center justify-between cursor-pointer">
                <p class="text-base leading-4 text-gray-800 ">Shipping and returns</p>
                <button class="rounded cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400" role="button" aria-label="show or hide">
                    <img class="transform" src="https://tuk-cdn.s3.amazonaws.com/can-uploader/productDetail3-svg4.svg" alt="dropdown">
                </button>
            </div>
            <div class="hidden pt-4 pr-12 mt-4 text-base leading-normal text-gray-600 " id="sect">You will be responsible for paying for your own shipping costs for returning your item. Shipping costs are nonrefundable</div>
        </div>

        <!-- Contact Us -->
        <div data-menu class="py-4 border-b border-gray-200">
            <div  class="flex items-center justify-between cursor-pointer">
                <p class="text-base leading-4 text-gray-800 ">Contact us</p>
                <button class="rounded cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400" role="button" aria-label="show or hide">
                    <img class="transform " src="https://tuk-cdn.s3.amazonaws.com/can-uploader/productDetail3-svg4.svg" alt="dropdown">
                </button>
            </div>
            <div class="hidden pt-4 pr-12 mt-4 text-base leading-normal text-gray-600 " id="sect">If you have any questions on how to return your item to us, contact us.</div>
        </div>

    </div>
</div>
    <script>
        let elements = document.querySelectorAll("[data-menu]");
        for (let i = 0; i < elements.length; i++) {
            let main = elements[i];
            main.addEventListener("click", function () {
                let element = main.parentElement.parentElement;
                let andicators = main.querySelectorAll("img");
                let child = main.querySelector("#sect");
                child.classList.toggle("hidden");
                andicators[0].classList.toggle("rotate-180");
            });
        }

    var quantityElement = document.getElementById('quantity');
    var inputElement = document.getElementById('custom-input-number');
    var forminputElement = document.getElementById('hiiden-number');
    var quantity = parseInt(quantityElement.innerText);

    var incrementButton = document.querySelector('[data-action="increment"]');
    var decrementButton = document.querySelector('[data-action="decrement"]');
    
    incrementButton.addEventListener('click', function () {
        var currentQuantity = parseInt(inputElement.value);
        var newQuantity = Math.min(currentQuantity + 1, quantity);
        inputElement.value = newQuantity;
        forminputElement.value =newQuantity
        quantityElement.innerText = quantity - newQuantity;
    });

    decrementButton.addEventListener('click', function () {
        var currentQuantity = parseInt(inputElement.value);
        var newQuantity = Math.max(1, currentQuantity - 1); 
        inputElement.value = newQuantity;
        forminputElement.value =newQuantity
        quantityElement.innerText = quantity - newQuantity;
    });
    
    </script>


<?php require('./components/footer.php') ?>