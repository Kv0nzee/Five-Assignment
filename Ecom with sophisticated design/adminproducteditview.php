<?php
require_once("./components/AdminNavber.php");

// Check if the product ID is provided and is numeric
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

// Fetch categories from the database
$categories_sql = "SELECT * FROM categories";
$categories_stmt = $pdo->query($categories_sql);
$categories = $categories_stmt->fetchAll(PDO::FETCH_ASSOC);

// Check if the form is submitted for updating
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['inputName'];
    $categoryID = $_POST['inputCategory'];
    $price = $_POST['inputPrice'];
    $qty = $_POST['inputQty'];

    // Process image upload
    $imageName = $_FILES['inputImage']['name'];
    $imageTmpName = $_FILES['inputImage']['tmp_name'];
    $imagePath = "image/" . $imageName; // Path to move the uploaded image

    // Move the uploaded image to the "image" folder
    move_uploaded_file($imageTmpName, $imagePath);

    // Check if a new image is uploaded, if not, use the existing image path from the database
    $finalImagePath = !empty($imageName) ? $imagePath : $product['imagePath'];

    try {
        // Update product data in the database
        $update_sql = "UPDATE products SET productName = :name, categoryID = :categoryID, productPrice = :price, productStock = :stock, imagePath = :imagePath WHERE productID = :productID";
        $stmt = $pdo->prepare($update_sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':categoryID', $categoryID, PDO::PARAM_INT);
        $stmt->bindParam(':price', $price, PDO::PARAM_INT);
        $stmt->bindParam(':stock', $qty, PDO::PARAM_INT);
        $stmt->bindParam(':imagePath', $finalImagePath, PDO::PARAM_STR);
        $stmt->bindParam(':productID', $productID, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: AdminProductView.php?success=ok");
        exit();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
?>

    <div class="container mt-3">
        <a class="btn btn-primary mb-3" href="AdminProductView.php"><<< Back to Product List</a>

        <div class="card">
            <div class="card-header bg-dark  text-center">
                <h4 class="text-white">Edit Product</h4>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="inputName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="inputName" required name="inputName" value="<?= $product['productName'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="inputCategory" class="form-label">Product Category</label>
                        <select class="form-control" id="inputCategory" name="inputCategory" required>
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?= $category['categoryID']; ?>" <?= ($category['categoryID'] == $product['categoryID']) ? 'selected' : ''; ?>>
                                    <?= $category['categoryName']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="inputPrice" class="form-label">Product Price</label>
                        <input type="number" class="form-control" id="inputPrice" step="2" required name="inputPrice" value="<?= $product['productPrice'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="inputQty" class="form-label">Stock Quantity</label>
                        <input type="number" class="form-control" id="inputQty" required name="inputQty" value="<?= $product['productStock'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="inputImage" class="form-label">Product Image</label>
                        <br>
                        <?php if (!empty($product['imagePath'])) : ?>
                            <img id="image-preview" src="<?= $product['imagePath'] ?>" alt="<?= $product['productName'] ?>" style="max-width: 100%; max-height: 200px; margin-top: 10px;">
                            <br>
                            <button type="button" class="btn btn-change-image" onclick="document.getElementById('inputImage').click()">Change Image</button>
                        <?php endif; ?>
                        <br>
                        <input type="file" class="form-control" id="inputImage" name="inputImage" accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-primary float-end">Update</button>
                </form>
            </div>
        </div>
    </div>
