<?php 
  if(isset($_POST['logout'])){
    unset($_SESSION['user']);
    unset($_SESSION['cart']);
    redirect('./');
  }


?>
<header class="bg-white">
    <nav class="flex items-center justify-between p-2 mx-auto max-w-7xl lg:px-8" aria-label="Global">
      <div class="flex lg:flex-1">
        <a href="/ecomAssignment" class="-m-1.5 p-1.5 flex items-center ">
          <img class="bg-gray-900 rounded-full" src="https://tuk-cdn.s3.amazonaws.com/can-uploader/sidebar2-svg1.svg" alt="logo" />
          <p class="ml-2 text-2xl leading-6 text-gray-900">Rangoon Super Center</p> 
        </a>
      </div>
      <div class="flex lg:hidden">
        <button
          type="button"
          class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700"
        >
          <span class="sr-only">Open main menu</span>
          <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7"></path>
          </svg>
        </button>
      </div>
      <div class="hidden lg:flex lg:gap-x-12">
        <div class="relative group">
          <button
            type="button"
            class="flex items-center text-sm font-semibold leading-6 text-gray-900 gap-x-1 focus:outline-none focus:border-indigo-600 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
          >
            Product
            <svg class="flex-none w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
              <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"></path>
            </svg>
          </button>
          <div class="absolute z-10 w-screen max-w-md mt-3 overflow-hidden bg-white shadow-lg -left-8 top-full rounded-3xl ring-1 ring-gray-900/5 dropdown">
            <div class="p-4">
              <?php foreach(getAllCategories() as $category): ?>
              <div class="relative flex items-center p-4 text-sm leading-6 rounded-lg group gap-x-6 hover:bg-gray-50">
                <div class="flex items-center justify-center flex-none rounded-lg h-11 w-11 bg-gray-50 group-hover:bg-white">
                  <svg class="w-6 h-6 text-gray-600 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z"></path>
                  </svg>
                </div>
                <div class="flex-auto">
                  <a href="index.php?category=<?= $category->id ?>" class="block font-semibold text-gray-900"><?= $category->name ?></a>
                </div>
              </div>
              <?php endforeach; ?>

            </div>
            
          </div>
        </div>
        

        <a href="about.php" class="text-sm font-semibold leading-6 text-gray-900">About Us</a>
        <a href="cart.php" >
              <?php
                $qty =0;
                if (isset($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $value) {
                        $qty += $value['qty'];
                    }
                }
              ?>
              <i class="fa-base fa-solid fas fa-shopping-cart"></i>
              <span><sup class="fs-5"><?php echo $qty ?></sup></span>
        </a>
        
      </div>

      <form method="GET" action="" class="mb-0">
        <div class="flex items-center justify-center ml-6 overflow-hidden bg-white rounded-lg focus-within:shadow-none">
            <div class="grid w-12 h-full text-gray-300 place-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>

            <input
            class="w-full h-full pr-2 text-sm text-gray-700 outline-none peer"
            type="text"
            name="search"
            id="search"
            placeholder="Search Product Name" /> 
        </div>
      </form>

      <div class="items-center hidden lg:flex lg:flex-1 lg:justify-end">
    <?php if (isset($_SESSION['user'])): ?>
        <div class="relative group">
            <button
                type="button"
                class="flex items-center justify-center text-sm font-semibold leading-6 text-gray-900 gap-x-1 focus:outline-none focus:border-indigo-600 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            >
                <?= $_SESSION['user']->username ?>
                <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"></path>
                </svg>
            </button>
            <div class="absolute z-10 mt-3 overflow-hidden bg-white shadow-lg rounded-s top-full ring-gray-900/5 dropdown">
                    <!-- Logout button -->
                    <form method="post" action="login.php">
                        <button name="logout" class=" p-3 text-end text#-gray-900 hover:bg-gray-100">
                            Logout
                        </button>
                    </form>
                    <?php
                    // Check if the user type session is set and is equal to 'admin'

                    if (isset($_SESSION['user']->type) && $_SESSION['user']->type === 'admin') {
                        echo '<a href="admin/" class="p-3 text-gray-900 text-end hover:bg-gray-100">Admin</a>';
                    }
                    ?>

            </div>
        </div>
    <?php else: ?>
        <a href="login.php" class="text-sm font-semibold leading-6 text-gray-900">Log in <span aria-hidden="true">&rarr;</span>/</a>
        <a href="register.php" class="text-sm font-semibold leading-6 text-gray-900">register <span aria-hidden="true">&rarr;</span></a>
    <?php endif; ?>
</div>
    </nav>
  </header>
