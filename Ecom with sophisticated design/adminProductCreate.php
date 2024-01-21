<?php
require_once("./components/AdminNavber.php");

// Fetch categories from the database
$categories_sql = "SELECT * FROM categories";
$categories_stmt = $pdo->query($categories_sql);
$categories = $categories_stmt->fetchAll(PDO::FETCH_ASSOC);

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

    try {
        // Insert product data into the database
        $insert_sql = "INSERT INTO products (productName, categoryID, productPrice, productStock, imagePath) VALUES (:name, :categoryID, :price, :stock, :imagePath)";
        $stmt = $pdo->prepare($insert_sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':categoryID', $categoryID, PDO::PARAM_INT);
        $stmt->bindParam(':price', $price, PDO::PARAM_INT);
        $stmt->bindParam(':stock', $qty, PDO::PARAM_INT);
        $stmt->bindParam(':imagePath', $imagePath, PDO::PARAM_STR);
        $stmt->execute();

        header("Location: adminProductCreate.php?success=ok");
        exit();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
?>

    <div class="container mt-3">
        <a class="btn btn-primary mb-3" href="AdminProductView.php"><<< Back to Product List</a>

        <div class="card">
            <div class="card-header bg-dark text-center">
                <h4 class="text-white ">Create A New Product</h4>
            </div>
            <div class="card-body">
                <?php if (isset($_GET['success']) && $_GET['success'] == 'ok') : ?>
                    <div class="alert alert-success" role="alert">
                        Product created successfully!
                    </div>
                <?php endif; ?>

                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="inputName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="inputName" required name="inputName">
                    </div>
                    <div class="mb-3">
                        <label for="inputCategory" class="form-label">Product Category</label>
                        <select class="form-control" id="inputCategory" name="inputCategory" required>
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?= $category['categoryID']; ?>"><?= $category['categoryName']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="inputPrice" class="form-label">Product Price</label>
                        <input type="number" class="form-control" id="inputPrice" step="2" required name="inputPrice">
                    </div>
                    <div class="mb-3">
                        <label for="inputQty" class="form-label">Stock Quantity</label>
                        <input type="number" class="form-control" id="inputQty" required name="inputQty">
                    </div>
                    <div class="mb-3">
                        <label for="inputImage" class="form-label">Product Image</label>
                        <input type="file" class="form-control" id="inputImage" name="inputImage" accept="image/*" required onchange="previewImage(this)">
                        <img id="image-preview" src="" alt="Image Preview" style=" max-width: 100%;  max-height: 200px;  margin-top: 10px;">
                    </div>
                    <button type="submit" class="btn btn-primary float-end">Create</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage(input) {
            var preview = document.getElementById('image-preview');
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = '';
            }
        }
    </script>
