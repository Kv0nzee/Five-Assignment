<?php
require_once("Connect.php");

// Check if the form is submitted
$productId = $_GET['id'];

$product_sql = "SELECT * FROM products WHERE id = :productId";
$stmt = $pdo->prepare($product_sql);
$stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
$stmt->execute();

$product = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["update"])) {
    $name = $_POST['product_name'];
    $cat = $_POST['product_category'];
    $price = $_POST['product_price'];
    $stock = $_POST['product_stock'];
    $description = $_POST['product_description'];

    $productImage = ''; // Initialize with the existing image path or an empty string

    if (isset($_FILES['product_img'])) {
        $uploadFile = 'img/' . basename($_FILES['product_img']['name']);

        if (move_uploaded_file($_FILES['product_img']['tmp_name'], $uploadFile)) {
            $productImage = $uploadFile;
        } else {
            echo 'Error uploading file.';
        }
    }


    $update_sql = "UPDATE products SET name = :name, category = :cat, price = :price, stockQuantity = :stock, img = :img, description = :description WHERE id = :productId";
    $update_stmt = $pdo->prepare($update_sql);
    $update_stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $update_stmt->bindParam(':cat', $cat, PDO::PARAM_STR);
    $update_stmt->bindParam(':price', $price, PDO::PARAM_STR);
    $update_stmt->bindParam(':stock', $stock, PDO::PARAM_INT);
    $update_stmt->bindParam(':img', $productImage, PDO::PARAM_STR);
    $update_stmt->bindParam(':description', $description, PDO::PARAM_STR);
    $update_stmt->bindParam(':productId', $productId, PDO::PARAM_INT);

    if ($update_stmt->execute()) {
        echo "<script>alert('Product updated successfully!')</script>";
        header("Location: adminProductView.php");
        exit();
    } else {
        echo "Error updating product.";
    }
}
require('sidebar.php')
?>

<div class="container p-5 ">
    <h4 class="mb-5">Update Product</h4>
    <form class="container-fluid" method="POST" enctype="multipart/form-data">
        <!-- Input field for the image filename -->
        <div class="form-group">
            <label class="form-label" for="product_img">Product Image</label>
            <input type="file" class="form-control" id="product_img" name="product_img">
        </div>
        <!-- Input field for the product description -->
        <div class="form-group">
            <label class="form-label" for="product_description">Product Description</label>
            <textarea class="form-control" id="product_description" name="product_description"
                placeholder="Enter product description"><?php echo $product['description']; ?></textarea>
        </div>
        <div class="form-group">
            <label class="form-label" for="product_name">Product Name</label>
            <input type="text" class="form-control" id="product_name" name="product_name"
                placeholder="Enter product name" value="<?php echo $product['name']; ?>">
        </div>
        <div class="form-group">
            <label class="form-label" for="product_category">Category</label>
            <select class="form-control" id="product_category" name="product_category">
                <option value="Electronics" <?php echo ($product['category'] === 'Electronics') ? 'selected' : ''; ?>>
                    Electronics</option>
                <option value="Cloths" <?php echo ($product['category'] === 'Cloths') ? 'selected' : ''; ?>>Cloths
                </option>
                <option value="Foods" <?php echo ($product['category'] === 'Foods') ? 'selected' : ''; ?>>Foods</option>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label" for="product_price">Price</label>
            <input type="number" step=0.01 class="form-control" min=0.50 id="product_price" name="product_price"
                placeholder="Enter product price" value="<?php echo $product['price']; ?>">
        </div>
        <div class="form-group">
            <label class="form-label" for="product_stock">Stock</label>
            <input type="number" class="form-control" id="product_stock" min=1 name="product_stock"
                placeholder="Enter product stock" value="<?php echo $product['stockQuantity']; ?>">
        </div>
        <div class="d-flex mt-5 justify-content-between">
            <a class="text-decoration-none btn btn-outline-primary" href="adminProductView.php"><<< Back</a>
            <button type="submit" class="btn btn-outline-primary" name="update">Update</button>
        </div>
    </form>
</div>
