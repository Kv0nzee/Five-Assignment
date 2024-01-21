<?php

require_once("./components/navbar.php");

$quantity = 1;

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    // Redirect to an error page or product list if the ID is not valid
    header("Location: ./");
    exit();
}

$productID = $_GET['id'];

// Fetch product details from the database
$sql = "SELECT * FROM products WHERE productID = :productID";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':productID', $productID, PDO::PARAM_INT);
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC);

$categoryID = $product['categoryID'];
$categorySql = "SELECT categoryName FROM categories WHERE categoryID = :categoryID";
$categoryStmt = $pdo->prepare($categorySql);
$categoryStmt->bindParam(':categoryID', $categoryID, PDO::PARAM_INT);
$categoryStmt->execute();
$category = $categoryStmt->fetch(PDO::FETCH_ASSOC);
$categoryName = $category ? $category['categoryName'] : "N/A"; // Use "N/A" if category not found


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["add_to_cart"])) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    if (!isset($_SESSION['cart'][$productID])) {
        $_SESSION['cart'][$productID] = [
            'productID'             => $productID,
            'productName'           =>  $product['productName'],
            'productCat'       => $product['productCat'],
            'productPrice'          => $product['productPrice'],
            'productStock'  => $product['productStock'],
            'imagePath'            => $product['imagePath'],
            'qty'            => $_POST['quantity']
        ];
    } else {
        $_SESSION['cart'][$productID]["qty"] += $_POST['quantity'];
    }
    header("Location: ./");
    exit();
}
?>
    <div class="container mt-3 ">
        <a class="btn btn-primary mb-3" href="./"><<< Back to Product List</a>

        <div class="card  mx-auto" style="max-width: 700px">
            <div class="card-body d-flex justify-content-between">
                <img src="<?= $product['imagePath'] ?>" alt="<?= $product['productName'] ?>" class="img-thumbnail mb-3" style=" max-width: 350px;">

                <div class="d-flex flex-column justify-content-between">
                    <div>
                        <h2 class="mb-5"><?= $product['productName'] ?></h2>
                        <p class="card-text">Category: <?= $categoryName ?></p>
                        <p class="card-text">Price: <?= $product['productPrice'] ?></p>
                        <p class="card-text">Stock Quantity: <?= $product['productStock'] ?></p>
                        <div class="input-group mb-3 d-flex align-items-center quantity-container" style="max-width: 220px;">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-black decrease" type="button">&minus;</button>
                            </div>
                            <input type="text" class="form-control text-center quantity-amount" min="1" name="quantity" id="quantity" value="<?= $quantity ?>" placeholder="" aria-label="Example text with a button addon" aria-describedby="button-addon1">
                            <div class="input-group-append">
                                <button class="btn btn-outline-black increase" type="button">&plus;</button>
                            </div>
                        </div>
                    </div>
                    <form method="post">
                        <input type="hidden" name="quantity" id="hiiden-number" value="<?= $quantity ?>">
                        <button name="add_to_cart" type="submit" class="btn btn-primary text-center" style="height:70px; font:10px">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    var forminputElement = document.getElementById('hiiden-number');
    var quantityInputElement = document.getElementById('quantity');

    $(document).ready(function () {
        $('.increase').click(function () {
            quantityInputElement.value = parseInt(quantityInputElement.value) + 1;
            updateHiddenInput();
        });

        $('.decrease').click(function () {
            var value = parseInt(quantityInputElement.value);
            if (value > 1) {
                quantityInputElement.value = value - 1;
                updateHiddenInput();
            }
        });

        // Update hidden input when the visible quantity input changes
        quantityInputElement.addEventListener('input', function () {
            updateHiddenInput();
        });

        function updateHiddenInput() {
            forminputElement.value = quantityInputElement.value;
        }
    });
</script>