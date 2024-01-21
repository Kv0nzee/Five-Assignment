<?php
require_once("./components/AdminNavber.php");

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    // Redirect to a error page or product list if the ID is not valid
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
    // Redirect to a error page or product list if the product is not found
    header("Location: AdminProductView.php");
    exit();
}

// Delete the product if the user confirms
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $delete_sql = "DELETE FROM products WHERE productID = :productID";
        $delete_stmt = $pdo->prepare($delete_sql);
        $delete_stmt->bindParam(':productID', $productID, PDO::PARAM_INT);
        $delete_stmt->execute();

        // Redirect to the product list with a success message
        header("Location: AdminProductView.php?delete=true");
        exit();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
?>

    <div class="container">
        <a class="btn btn-primary my-5" href="AdminProductView.php"><<< Back to Product List</a>
        <div class="card">
            <div class="card-header">
                <h4>Delete Product</h4>
            </div>
            <div class="card-body">
                <p class="card-text">Are you sure you want to delete the product: <?= $product['productName'] ?>?</p>
                <form method="POST">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
