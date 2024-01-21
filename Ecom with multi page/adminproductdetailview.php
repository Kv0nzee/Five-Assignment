<?php
require_once("./components/AdminNavber.php");

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    // Redirect to an error page or product list if the ID is not valid
    header("Location: AdminProductView.php");
    exit();
}

$productID = $_GET['id'];

// Fetch product details from the database
$sql = "SELECT * FROM products WHERE productID = :productID";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':productID', $productID, PDO::PARAM_INT);
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if the product exists
if (!$product) {
    // Redirect to an error page or product list if the product is not found
    header("Location: AdminProductView.php");
    exit();
}

// Fetch category name using the categoryID
$categoryID = $product['categoryID'];
$categorySql = "SELECT categoryName FROM categories WHERE categoryID = :categoryID";
$categoryStmt = $pdo->prepare($categorySql);
$categoryStmt->bindParam(':categoryID', $categoryID, PDO::PARAM_INT);
$categoryStmt->execute();
$category = $categoryStmt->fetch(PDO::FETCH_ASSOC);
$categoryName = $category ? $category['categoryName'] : "N/A"; // Use "N/A" if category not found
?>

    <div class="container mt-3 ">
        <a class="btn btn-primary mb-3" href="AdminProductView.php"><<< Back to Product List</a>

        <div class="card  mx-auto" style="max-width: 700px">
            <div class="card-body d-flex justify-content-between  ">
                <img src="<?= $product['imagePath'] ?>" alt="<?= $product['productName'] ?>" class="img-thumbnail mb-3" style=" max-width: 350px;">

                <div class="d-flex flex-column justify-content-between">
                    <div>
                    <h2 class="mb-5"><?= $product['productName'] ?></h2>
                    <p class="card-text">Category: <?= $categoryName ?></p>
                    <p class="card-text">Price: <?= $product['productPrice'] ?></p>
                    <p class="card-text">Stock Quantity: <?= $product['productStock'] ?></p>
                    </div>
                    <a href="adminproducteditview.php?id=<?= $productID ?>" class="btn btn-warning">Edit</a>
                </div>

            </div>
        </div>
    </div>