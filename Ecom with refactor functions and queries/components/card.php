<?php
$products = getAllProduct();
$maxProductprice = 0;
$minProductPrice = 1130;

foreach($products as $product) {
  if ($maxProductprice < (float) $product->price) {
    $maxProductprice = (float) $product->price;
  }
  if ($minProductPrice > (float) $product->price) {
    $minProductPrice = (float) $product->price;
  }
} 
if (isset($_GET['category'])) {
    $products = getProductByFilter($_GET['category']);
}

if(isset($_GET['search'])){
  $products = showSearchResult($_GET['search']);
}

if (isset($_GET['max']) && isset($_GET['min'])) {
  $products = findByPriceMinMax($_GET['max'], $_GET['min']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $productId = $_POST['id'];
    if (isset($products[$productId - 1])) {
        addToCart($products[$productId - 1]);
        redirect("/ecomAssignment");
    } else {
        echo "Error: Product not found.";
    }
}
?>


<div class="flex items-center pt-16 bg-indigo-100 ">
  <div class="container flex flex-wrap items-start ml-auto mr-auto">
    <div class="w-full pt-4 pl-5 mt-4 mb-4 lg:pl-2">
      <h1 class="text-3xl font-extrabold text-gray-700 lg:text-4xl">
        Rangoon Super Center Products

      </h1>
      <?php if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['search'])){ ?>
      <h1 class="text-3xl font-extrabold text-gray-700 lg:text-4xl">
              Result of <?= $_GET['search'] ?>:
      </h1>
      <?php } ?>
      <h2 class="text-xl font-extrabold text-center text-gray-700 lg:text-2xl">Price Range</h2>
        <form method="GET" class="flex items-center justify-center space-x-4">
        <input type="number" step="0.01" min="<?= $minProductPrice ?>" max="<?= $maxProductprice ?>" name="min" class="flex items-center font-semibold text-center text-gray-300 bg-gray-800 outline-none cursor-default focus:outline-none text-md md:text-base" 
          value="<?= $minProductPrice; ?>">
        <input type="number" step="0.01" min="<?= $minProductPrice ?>" max="<?= $maxProductprice ?>" name="max" class="flex items-center font-semibold text-center text-gray-300 bg-gray-800 outline-none cursor-default focus:outline-none text-md md:text-base" 
          value="<?= $maxProductprice; ?>">
          <button type="submit">submit</button>
        </form> 
    </div>
    <?php 
    
    if($products){
      foreach($products as $product) {
    ?> 
      <div class="w-full pl-5 pr-5 mb-5 md:w-1/2 lg:w-1/4 lg:pl-2 lg:pr-2">
            <div class="h-[450px] flex flex-col justify-between  p-2 transition duration-300 transform bg-white rounded-lg m-h-64 hover:translate-y-2 hover:shadow-xl">
                <figure class="h-[65%] mb-2">
                  <a href="productDetail.php?id=<?= $product->id ?>">
                  <img src="<?php echo $product->productImg; ?>" alt="" class="w-full h-full ml-auto mr-auto rounded-lg" />
                  </a>
                </figure>
                <div class="h-[35%] flex flex-col p-4 <?= $product->category_id ? $productColors[$product->category_id % count($productColors) + 1 ] : 'bg-purple-700'  ?> rounded-lg">
                    <div>
                        <h5 class="text-2xl font-bold leading-none text-white">
                            <?php echo $product->name; ?>
                        </h5>
                        <span class="text-xs leading-none text-gray-400"><?php echo $product->description; ?></span>
                    </div>
                    <div class="flex justify-between items-bottom">
                        <div class="text-lg font-light text-white">
                            $<?php echo $product->price; ?>
                        </div>
                        <form method="POST">
                            <input type="text" hidden name="id" value="<?= $product->id ?>">
                            <button name="submit"  class="flex w-10 h-10 ml-auto text-white transition duration-300 bg-purple-900 rounded-full hover:bg-white hover:text-purple-900 hover:shadow-xl focus:outline-none">
                                <i class="m-auto fa-solid fa-plus rotateButton"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
      </div>

    <?php } } else{
        require('./components/error.php');
      } ?>
  </div>
</div>
<!-- <input type="number" min="0" id="hiiden-number" hidden name="quantity" value="1"></input> lo at -->

<script>
  const rotateButtons = document.getElementsByClassName('rotateButton');

  for (const rotateButton of rotateButtons) {
    rotateButton.addEventListener('click', () => {
      rotateButton.classList.toggle('fa-plus');
      rotateButton.classList.toggle('fa-check');


      rotateButton.classList.add('rotate-animation');

      setTimeout(() => {
        rotateButton.classList.remove('rotate-animation');
        rotateButton.classList.toggle('fa-check');
        rotateButton.classList.toggle('fa-plus');

      }, 3000);
    });
  }
</script>