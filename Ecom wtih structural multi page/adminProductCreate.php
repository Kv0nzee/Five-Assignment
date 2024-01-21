<?php
require('./components/sidebar.php'); 

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {
    // Retrieve form data
    $productName = $_POST["productName"];
    $productCategory = $_POST["productCategory"];
    $productDescription = $_POST["productDescription"];
    $productPrice = $_POST["productPrice"];
    $productStock = $_POST["productStock"];

    // File upload handling
    $targetDir = "images/"; // Specify your upload directory
    $targetFile = $targetDir . basename($_FILES["productImg"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the image file is a actual image or fake image
    $check = getimagesize($_FILES["productImg"]["tmp_name"]);
    if ($check !== false) {
        // File is an image
        $uploadOk = 1;
    } else {
        // File is not an image
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size (you can adjust the size as needed)
    if ($_FILES["productImg"]["size"] > 500000) {
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
        echo "Sorry, your file was not uploaded.";
    } else {
        // If everything is ok, try to upload file
        if (move_uploaded_file($_FILES["productImg"]["tmp_name"], $targetFile)) {
            // File uploaded successfully, now insert data into the database
            $insert_sql = "INSERT INTO products (productName, catId, productDescription, productPrice, productStock, productImg) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($insert_sql);

            // You may need to adjust the bind parameters based on your database schema
            if ($stmt->execute([$productName, $productCategory, $productDescription, $productPrice, $productStock, $targetFile])) {
                // Database operation successful
                header("Location: adminProductView.php"); // Redirect to success page
                exit();
            } else {
                // Error inserting data into the database
                echo "Error creating product.";
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>
<div class="body-wrapper">
    <div class="col-lg-8 d-flex align-items-stretch w-100">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Create Product</h5>
                <div class="card">
                    <div class="card-body">
                        <form method="POST"  enctype="multipart/form-data"> <!-- Updated the form tag -->
                            <div class="mb-3">
                                <label for="productName" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="productName" name="productName" required>
                            </div>
                            <div class="mb-3">
                                <label for="productCategory" class="form-label">Product Category</label>
                                <!-- Assuming you have a category dropdown, adjust as needed -->
                                <select class="form-control" id="productCategory" name="productCategory" required>
                                    <?php 
                                        foreach(getAllCategories() as $cat){
                                    ?>
                                    <option value="<?= $cat['catID'] ?>"><?= $cat['productCat'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="productDescription" class="form-label">Product Description</label>
                                <textarea class="form-control" id="productDescription" name="productDescription" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="productPrice" class="form-label">Product Price</label>
                                <input type="number" class="form-control" id="productPrice" name="productPrice" step="0.01" required>
                            </div>
                            <div class="mb-3">
                                <label for="productStock" class="form-label">Product Stock</label>
                                <input type="number" class="form-control" id="productStock" name="productStock" required>
                            </div>
                            <div class="mb-3">
                                <label for="productImg" class="form-label">Product Image</label>
                                <input type="file" class="form-control" id="productImg" name="productImg" accept="image/*" required>
                            </div>
                            <button type="submit" class="btn btn-primary" name="submit">Create Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
