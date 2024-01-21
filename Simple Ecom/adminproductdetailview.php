<?php
require_once("Connect.php");

$productId = $_GET['id'];

$product_sql = "SELECT * FROM products WHERE id = $productId";

$stmt = $pdo->prepare($product_sql);
$stmt->execute();

$product = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["update"])) {
    header("Location: productupdate.php?id=$productId");
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete"])) {
    $delete_sql = "DELETE FROM products WHERE id = $productId";
    $stmt = $pdo->prepare($delete_sql);

    if ($stmt->execute()) {
        header("Location: adminProductView.php");
        exit();
    } else {
        echo "Error deleting product.";
    }
}

// Assuming you have fetched product details from the database
$productName = $product['name']; 
$productImage = $product['img']; 
$productPrice = $product['price']; 
$productQuantity = $product['stockQuantity']; 
$productCategory = $product['category']; 
$productDescription = $product['description']; 
require('sidebar.php')
?>
<div class="container mt-2">
    <a class="text-decoration-none btn btn-outline-primary  " href="adminProductView.php"><<< Back</a>
    <h1>Product Details</h1>
    <div class="row mt-5">
        <div class="col-md-6">
            <img src="<?php echo $productImage; ?>" alt="<?php echo $productName; ?>" class="img-fluid ">
            <form method="POST" class="d-flex mt-2 justify-content-between">
                <button class="btn btn-outline-danger" name="delete">Delete</button>
                <button class="btn btn-outline-info" name="update">Update</button>
            </form>
        </div>
        <div class="col-md-6">
            <h1><?php echo $productName; ?></h1>
            <p class="text-light"><span >Price:</span> <?= $productPrice?></p>
            <p class="text-light"><span >Quantity:</span> <?= $productQuantity?></p>
            <p class="text-light"><span >Category:</span> <?= $productCategory?></p>
            <h2 class="">Description</h2>
            <p><?php echo $productDescription; ?></p>
        </div>
    </div>
</div>

<script>
    function addToCart() {
        // Implement your add to cart logic here
        alert('Product added to cart!');
    }

    function buyNow() {
        // Implement your buy now logic here
        alert('Redirecting to checkout...');
    }
</script>