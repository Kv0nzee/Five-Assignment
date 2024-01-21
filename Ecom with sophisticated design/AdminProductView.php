<?php
require_once("./components/AdminNavber.php");

$sql = "SELECT * FROM products";
$statement = $pdo->prepare($sql);
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['product_create'])) {
    header("Location: adminProductCreate.php");
    exit();
}

if (isset($_POST['view'])) {
    $id = $_POST['product_id'];
    header("Location: adminproductdetailview.php?id=$id");
    exit();
}

if (isset($_POST['delete'])) {
    $id = $_POST['product_id'];
    // Perform delete action here
    header("Location: adminProductDelete.php?id=$id");
    exit();
}

if (isset($_GET['delete']) && $_GET['delete'] == true) {
    echo "<script>alert('Product Deleted.')</script>";
}
?>

    <div class="container mt-5">
        <div class="mb-3">
            <form method="POST">
                <button class="btn btn-primary" type="submit" name="product_create">Create New Product</button>
            </form>
        </div>
        <table class="table  text-muted table-bordered table-hover table-striped">
            <thead class="table-primary">
                <tr>
                    <th scope="col">Product ID</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Product Category</th>
                    <th scope="col">Product Price</th>
                    <th scope="col">Product Stock</th>
                    <th scope="col">Product Image</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $product) : ?>
                    <form method="POST">
                        <?php $product_id = $product['productID']; ?>
                        <tr>
                            <th scope="row"><?= $product_id ?></th>
                            <td><?= $product['productName'] ?></td>
                            <td><?= getCategoryName($pdo, $product['categoryID']) ?></td>
                            <!-- Change the above line to get the category name using a function -->
                            <td>$<?= $product['productPrice'] ?></td>
                            <td><?= $product['productStock'] ?></td>
                            <td>
                                <img src="<?= $product['imagePath'] ?>" alt="Product Image" class="product-image"  style=" max-width: 100px;">
                            </td>
                            <td>
                                <input type="hidden" name="product_id" value=<?= $product_id ?>>
                                <button class="btn btn-info btn-sm" type="submit" name="view">View</button>
                                <button class="btn btn-danger btn-sm" type="submit" name="delete">Delete</button>
                            </td>
                        </tr>
                    </form>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</body>

</html>

<?php
function getCategoryName($pdo, $categoryID)
{
    $category_sql = "SELECT categoryName FROM categories WHERE categoryID = :categoryID";
    $category_stmt = $pdo->prepare($category_sql);
    $category_stmt->bindParam(':categoryID', $categoryID, PDO::PARAM_INT);
    $category_stmt->execute();
    $category = $category_stmt->fetch(PDO::FETCH_ASSOC);

    return $category['categoryName'];
}
?>
