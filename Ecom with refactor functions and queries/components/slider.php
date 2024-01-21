<div class="w-full splide-container ">
    <div class="splide">
      <div class="splide__track">
        <ul class="splide__list">
          <?php foreach (showThreeProducts() as $product):?>
          <li class="splide__slide">
            <div class="relative w-full h-full pl-5 pr-5 ">
              <div class="flex flex-col justify-between h-full p-2 transition duration-300 transform bg-white rounded-lg m-h-64 ">
                  <figure class="object-cover w-full h-full mb-2">
                    <a href="productDetail.php?id=<?= $product->id ?>">
                      <img src="<?php echo $product->productImg; ?>" alt="" class="w-auto h-full ml-auto mr-auto bg-auto rounded-lg" />
                    </a>
                  </figure>
                  <div class="absolute  bottom-0 flex flex-col p-4 <?= array_key_exists($product->category_id, $productColors) ? $productColors[$product->category_id] : 'bg-purple-700'  ?> rounded-lg">
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
                      </div>
                  </div>
              </div>
      </div>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      new Splide('.splide', {
        type: 'fade',
        arrows:false,
        fixedHeight :'400px',
        heightRatio: 0.5,
        autoplay: true,
        interval: 2000,
        type   : 'loop',
      }).mount();
    });
  </script>