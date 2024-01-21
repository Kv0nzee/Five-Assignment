<?php
require_once("Connect.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["create"])) {
    $name = $_POST['product_name'];
    $cat = $_POST['product_category'];
    $price = $_POST['product_price'];
    $stock = $_POST['product_stock'];
    $description = $_POST['product_description'];

    $productImage = ''; // Initialize with an empty string

    if (isset($_FILES['product_img'])) {
        $uploadFile = 'img/' . basename($_FILES['product_img']['name']);

        if (move_uploaded_file($_FILES['product_img']['tmp_name'], $uploadFile)) {
            $productImage = $uploadFile;
        } else {
            echo 'Error uploading file.';
        }
    }

    $insert_sql = "INSERT INTO products (name, category, price, stockQuantity, img, description) VALUES (:name, :cat, :price, :stock, :img, :description)";
    $insert_stmt = $pdo->prepare($insert_sql);
    $insert_stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $insert_stmt->bindParam(':cat', $cat, PDO::PARAM_STR);
    $insert_stmt->bindParam(':price', $price, PDO::PARAM_STR);
    $insert_stmt->bindParam(':stock', $stock, PDO::PARAM_INT);
    $insert_stmt->bindParam(':img', $productImage, PDO::PARAM_STR);
    $insert_stmt->bindParam(':description', $description, PDO::PARAM_STR);

    if ($insert_stmt->execute()) {
        echo "<script>alert('Product created successfully!')</script>";
        header('location: adminproductview.php');
    } else {
        echo "Error creating product.";
    }
}
require('sidebar.php')
?>

<div class="container">
    <h4 class="mb-5">Create Product</h4>
    <form class="container-fluid" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label class="form-label" for="product_img">Product Image</label>
            <input type="file" class="form-control" id="product_img" name="product_img">
        </div>
        <div class="form-group">
            <label class="form-label" for="product_name">Product Name</label>
            <input type="text" class="form-control" id="product_name" name="product_name"
                placeholder="Enter product name">
        </div>
        <div class="form-group">
            <label class="form-label" for="product_description">Product Description</label>
            <textarea class="form-control" id="product_description" name="product_description"
                placeholder="Enter product description"></textarea>
        </div>
        <div class="form-group">
            <label class="form-label" for="product_category">Category</label>
            <select class="form-control" id="product_category" name="product_category">
                <option value="Electronics">Electronics</option>
                <option value="Cloths">Cloths</option>
                <option value="Foods">Foods</option>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label" for="product_price">Price</label>
            <input type="number" step=0.01 class="form-control" min=0.50 id="product_price" name="product_price"
                placeholder="Enter product price">
        </div>
        <div class="form-group">
            <label class="form-label" for="product_stock">Stock</label>
            <input type="number" class="form-control" id="product_stock" min=1 name="product_stock"
                placeholder="Enter product stock">
        </div>
        <div class="d-flex mt-5 justify-content-between">
            <a class="text-decoration-none btn btn-outline-primary" href="adminProductView.php"><<< Back</a>
            <button type="submit" class="btn btn-outline-primary" name="create">Create</button>
        </div>
    </form>
</div>
