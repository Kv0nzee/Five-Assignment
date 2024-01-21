<?php 
require_once("navbar.php");

$search = "";
$products = [];

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete"])) {
    $id = $_POST["product_id"];
    $delete_sql = "DELETE FROM products WHERE productID = :id";
    
    $stmt = $pdo->prepare($delete_sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        header("Location: adminProductView.php");
        exit();
    } else {
        echo "Error deleting product.";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['search']) && isset($_GET['min']) && isset($_GET['max'])) {
        $min = $_GET['min'];
        $max = $_GET['max'];
        $search = $_GET['search'];
        $sql = "SELECT * FROM products WHERE name LIKE :search AND price BETWEEN :min AND :max";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        $stmt->bindValue(':min', $min, PDO::PARAM_INT);
        $stmt->bindValue(':max', $max, PDO::PARAM_INT);
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    if (isset($_GET['cat'])) {
        $cat = $_GET['cat'];
        $sql = "SELECT * FROM products WHERE category = :cat";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':cat', $cat, PDO::PARAM_STR);
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    if (!isset($_GET['search']) && !isset($_GET['cat'])) {
        $product_sql = "SELECT * FROM products";
        
        $stmt = $pdo->query($product_sql);
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

<main>
    <div class="container-fluid bg-transparent my-4 p-3 " style="position: relative;">
        <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
            <?php foreach ($products as $product) { ?>
                <form method="POST" action="addToCart.php?id=<?= $product['id'] ?>">
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <a href="prdocutdetailview.php?id=<?= $product['id']  ?>">
                             <img src=<?= $product['img'] ?>  class="card-img-top" alt="...">
                            </a>
                            <div class="card-body">
                                <div class="clearfix mb-3">
                                    <span class="float-start badge rounded-pill bg-light text-dark"><?= $product['category']; ?></span>
                                    <span class="float-end price-hp"><?= $product['price']; ?>&euro;</span>
                                </div>
                               <div class="d-flex justify-content-between">
                               <h5 class="card-title"><?= $product['name']; ?></h5>
                                <span class="">Stock: <?= $product['stockQuantity']; ?></span>
                               </div>
                                <button class="text-center my-4 btn btn-light" type="submit" name="buy" >
                                  <i class="fas fa-shopping-cart"></i> Check offer
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            <?php } ?>
        </div>
    </div>
</main>
