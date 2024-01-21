<?php
require_once("Connect.php");

$product_sql = "SELECT * FROM products";

$stmt = $pdo->query($product_sql);
$productsc = $stmt->fetchAll(PDO::FETCH_ASSOC);


$max = 0;
$min = 20;
$groupedCats = [];
foreach ($productsc as $product) {
    if (!isset($groupedCats[$product['category']])) {
        $groupedCats[$product['category']] = $product;
    }
    if($product['price'] > $max){
      $max = $product['price']; 
    }
    if($product['price'] < $min){
      $min = $product['price']; 
    }
}
  
?>
<div class=" bg-light  p-3">
  <nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="userProductview.php">Rangoon Super Center</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse d-flex justify-content-between items-center" id="navbarNav">
      <ul class="navbar-nav ml-3">
      <li class="nav-item active">
          <?php
          // Check if the user is logged in
          if (isset($_SESSION['user'])) {
            echo '<span class="nav-link">Welcome, ' . $_SESSION['user']['name'] . '!</span>';
          } else {
            echo '<a class="nav-link" href="auth.php">Login/Register</a>';
          }
          ?>
        </li>
          <?php
          if (isset($_SESSION['user'])) {
            echo '<li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>';;
            if ($_SESSION['user']['type'] == 'admin') {
              echo '<li class="nav-item"><a class="nav-link" href="adminproductview.php">Admin</a></li>';
            } 
          } 
          ?>
      </ul>
        <div class="dropdown ml-3">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Category Filter
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <?php foreach ($groupedCats as $category => $value) { ?>
                        <a class="dropdown-item" href="userProductview.php?cat=<?= $category ?>">
                            <?= $category ?></a>
                    <?php } ?>
                </div>
            </div>
      <div class="d-flex justify-content-between w-25">
        <div class="me-3">
          <a href="cart.php" class="btn btn-outline-primary p-3">
            <?php
            $qty = 0;
            if (isset($_SESSION['cart'])) {
              foreach ($_SESSION['cart'] as $value) {
                $qty += $value['qty'];
              }
            }
            ?>
            <i class="fa-2xl fa-solid fas fa-shopping-cart"></i>
            <span><sup class="fs-5"><?php echo $qty ?></sup></span>
          </a>
        </div>
      </div>
    </div>
  </nav>
  <form action="" method="GET" class="d-flex">
          <div class="input-group rounded">
              <input name="search" type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
                  aria-describedby="search-addon" />
              <button class="input-group-text border-0" id="search-addon">
                  <i class="fas fa-search"></i>
              </button>
          </div>
          <div class="form-outline mx-3 me-1" style="width: 300px;">
              <input type="number" step="0.01" name="min" min="<?= $min ?>" max="<?= $max ?>" value="<?= $min ?>" class=" form-control text-center" />
          </div>
          <div class="form-outline me-1" style="width: 300px;">
              <input type="number" step="0.01" name="max"min="<?= $min ?>" max="<?= $max ?>" value="<?= $max ?>" class="form-control text-center" />
          </div>
          <button class="input-group-text border-0 ml-3 " type="submit"  id="search-addon">
              Submit
          </button>
      </form>
</div>