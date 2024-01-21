<?php
require('./components/sidebar.php');

// Function to get all product categories (replace with your actual implementation)


// Check if the form is submitted for creating or updating a product
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {
    // Function to handle file upload and return the uploaded file path
    function handleFileUpload($file, $targetDir) {
        $targetFile = $targetDir . basename($file["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if the image file is a valid image
        $check = getimagesize($file["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size
        if ($file["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        $allowedFormats = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($imageFileType, $allowedFormats)) {
            echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            return false;
        } else {
            // If everything is ok, try to upload file
            if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                return $targetFile;
            } else {
                echo "Sorry, there was an error uploading your file.";
                return false;
            }
        }
    }

    // Retrieve form data
    $productName = $_POST["productName"];
    $productCategory = $_POST["productCategory"];
    $productDescription = $_POST["productDescription"];
    $productPrice = $_POST["productPrice"];
    $productStock = $_POST["productStock"];

    // Check if updating an existing product (productID is set)
    $updatingProduct = isset($_POST["product_id"]);
    $productID = $updatingProduct ? $_POST["product_id"] : null;

    // File upload handling
    $targetDir = "images/";
    $productImg = handleFileUpload($_FILES["productImg"], $targetDir);

    if ($productImg !== false) {
        // Insert or update data in the database based on the operation
        if ($updatingProduct) {
            // Update an existing product
            $update_sql = "UPDATE products SET productName=?, catId=?, productDescription=?, productPrice=?, productStock=?, productImg=? WHERE productID=?";
            $stmt = $pdo->prepare($update_sql);

            if ($stmt->execute([$productName, $productCategory, $productDescription, $productPrice, $productStock, $productImg, $productID])) {
                // Database operation successful
                header("Location: adminProductView.php"); // Redirect to success page
                exit();
            } else {
                // Error updating data in the database
                echo "Error updating product.";
            }
        } else {
            // Create a new product
            $insert_sql = "INSERT INTO products (productName, catId, productDescription, productPrice, productStock, productImg) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($insert_sql);

            if ($stmt->execute([$productName, $productCategory, $productDescription, $productPrice, $productStock, $productImg])) {
                // Database operation successful
                header("Location: adminProductView.php"); // Redirect to success page
                exit();
            } else {
                // Error inserting data into the database
                echo "Error creating product.";
            }
        }
    }
}

// Display the form for creating or updating product information
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"])) {
    $productID = $_GET["id"];

    $select_sql = "SELECT * FROM products WHERE productID = ?";
    $stmt = $pdo->prepare($select_sql);

    if ($stmt->execute([$productID])) {
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($product) {
            ?>
            <div class="body-wrapper">
                <div class="col-lg-8 d-flex align-items-stretch w-100">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold mb-4"><?= $product ? 'Update' : 'Create' ?> Product</h5>
                            <div class="card">
                                <div class="card-body">
                                <form method="POST" enctype="multipart/form-data">
                                    <?php if ($product) : ?>
                                        <input type="hidden" name="product_id" value="<?= $product['productID'] ?>">
                                    <?php endif; ?>

                                    <div class="mb-3">
                                        <label for="productName" class="form-label">Product Name</label>
                                        <input type="text" class="form-control" id="productName" name="productName" value="<?= $product ? $product['productName'] : '' ?>" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="productCategory" class="form-label">Product Category</label>
                                        <select class="form-control" id="productCategory" name="productCategory" required>
                                            <?php
                                            $categories = getAllCategories();
                                            foreach ($categories as $cat) {
                                                $selected = ($product && $product['catId'] == $cat['catID']) ? 'selected' : '';
                                                echo "<option value='{$cat['catID']}' {$selected}>{$cat['productCat']}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="productDescription" class="form-label">Product Description</label>
                                        <textarea class="form-control" id="productDescription" name="productDescription" rows="3" required><?= $product ? $product['productDescription'] : '' ?></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="productPrice" class="form-label">Product Price</label>
                                        <input type="number" class="form-control" id="productPrice" name="productPrice" step="0.01" value="<?= $product ? $product['productPrice'] : '' ?>" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="productStock" class="form-label">Product Stock</label>
                                        <input type="number" class="form-control" id="productStock" name="productStock" value="<?= $product ? $product['productStock'] : '' ?>" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="productImg" class="form-label">Product Image</label>
                                        <input type="file" class="form-control" id="productImg" name="productImg" accept="image/*" required>
                                    </div>

                                    <button type="submit" class="btn btn-primary" name="submit"><?= $product ? 'Update' : 'Create' ?> Product</button>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        } else {
            echo "Product not found";
        }
    } else {
        echo "Error fetching product data: " . $stmt->errorInfo()[2];
    }
}
?>
