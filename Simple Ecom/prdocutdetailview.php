<?php
require_once("Connect.php");

$productId = $_GET['id'];

$product_sql = "SELECT * FROM products WHERE id = $productId";

$stmt = $pdo->prepare($product_sql);
$stmt->execute();

$product = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["add_to_cart"])) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    if (!isset($_SESSION['cart'][$id])) {
        
        $_SESSION['cart'][$id] = [
            'id'    => $id,
            'name'  => $product['name'],
            'description'  => $product['description'],
            'category'   => $product['category'],
            'price' => $product['price'],
            'stockQuantity' => $product['stockQuantity'],
            'img'   => $product['img'],
            'qty'          => $_POST['quantity']
        ];
    } else {
        $_SESSION['cart'][$id]["qty"] += 1;
    }
    header("Location: userProductView.php");
    exit();
}

// Assuming you have fetched product details from the database
$productName = $product['name'];
$productImage = $product['img'];
$productPrice = $product['price'];
$productQuantity = $product['stockQuantity'];
$productCategory = $product['category'];
$productDescription = $product['description'];
require('navbar.php'); 
?>
<div class="container mt-2">
    <a class="text-decoration-none btn btn-outline-primary" href="userProductView.php"> Back to Products</a>
    <h1>Product Details</h1>
    <div class="row mt-5">
        <div class="col-md-6">
            <img src="<?php echo $productImage; ?>" alt="<?php echo $productName; ?>" class="img-fluid">
            <div class="input-group ">
                <span class="input-group-btn">
                <button type="button" class="btn btn-danger" id="minus-btn">-</button>
                </span>
                <input  type="number" class="form-control text-center" id="quantity" value="1" min="1">
                <span class="input-group-btn">
                <button type="button" class="btn btn-success" id="plus-btn">+</button>
                </span> 
            </div>
                   
            <form method="POST" class="d-flex mt-2 justify-content-between">
                <input type="number" min="0" id="hiiden-number" hidden name="quantity" value="1"></input>
                <button class="btn btn-outline-primary" name="add_to_cart">Add to Cart</button>
            </form>
        </div>
        <div class="col-md-6">
            <h1><?php echo $productName; ?></h1>
            <p><span>Price:</span> <?= $productPrice ?></p>
            <p><span>Quantity:</span> <?= $productQuantity ?></p>
            <p><span>Category:</span> <?= $productCategory ?></p>
            <h2 class="">Description</h2>
            <p><?php echo $productDescription; ?></p>
            <ul>
                <li>100% Quality</li>
                <li>Free Shipping</li>
                <li>Easy Returns</li>
                <li>12 Months Warranty</li>
                <li>EMI Starting from (On Credit Cards)</li>
                <li>Normal Delivery : 4-5 Days</li>
                <li>Express Delivery : 2-3 Days</li>
                <li>COD Available</li>
            </ul>
        </div>
    </div>
</div>

<script>
var forminputElement = document.getElementById('hiiden-number');
var quantityInputElement = document.getElementById('quantity');

$(document).ready(function() {
    $('#plus-btn').click(function(){
        quantityInputElement.value = parseInt(quantityInputElement.value) + 1;
        updateHiddenInput();
    });

    $('#minus-btn').click(function(){
        var value = parseInt(quantityInputElement.value);
        if(value > 1) {
            quantityInputElement.value = value - 1;
            updateHiddenInput();
        }
    });

    // Update hidden input when the visible quantity input changes
    quantityInputElement.addEventListener('input', function() {
        updateHiddenInput();
    });

    function updateHiddenInput() {
        forminputElement.value = quantityInputElement.value;
    }
});
</script>