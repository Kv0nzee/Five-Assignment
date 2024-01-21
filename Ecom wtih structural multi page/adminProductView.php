<?php 
    require('./components/sidebar.php');
    $products = getAllProducts();

    if(isset($_POST["update"])){
        $id = $_POST["product_id"];
        header("Location: adminproductupdate.php?id=$id");
        exit(); // Add exit to stop further execution
    }
    
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete"])) {
        $id = $_POST["product_id"];
        $delete_sql = "DELETE FROM products WHERE productID = $id";
    
        $stmt = $pdo->prepare($delete_sql);
    
        if ($stmt->execute()) {
            header("Location: adminproductView.php");
            exit();
        } else {
            echo "Error deleting product.";
        }
    } 
?>
<div class="body-wrapper">  
    <div class="col-lg-8 d-flex align-items-stretch w-100">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Products View</h5>
                <a href="adminProductCreate.php" class="btn btn-primary m-1">Product Create</a>
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle w-100">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Product ID</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Product Name</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Category ID</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Description</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Price</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Stock</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Image</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Action</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($products as $product) {
                            ?>
                                <tr>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0"><?= $product['productID'] ?></h6></td>
                                    <td class="border-bottom-0 text-center">
                                        <h6 class="fw-semibold mb-1"><?= $product['productName'] ?></h6>
                                    </td>
                                    <td class="border-bottom-0 text-center">
                                        <p class="mb-0 fw-normal"><?= $product['catId'] ?></p>
                                    </td>
                                    <td class="border-bottom-0 ">
                                        <p class="mb-0 fw-normal" style="text-wrap: wrap;"><?= $product['productDescription'] ?></p>
                                    </td>
                                    <td class="border-bottom-0 text-center">
                                        <p class="mb-0 fw-normal"><?= $product['productPrice'] ?></p>
                                    </td>
                                    <td class="border-bottom-0 text-center">
                                        <p class="mb-0 fw-normal"><?= $product['productStock'] ?></p>
                                    </td>
                                    <td class="border-bottom-0 text-center">
                                        <img src="<?= $product['productImg'] ?>" alt="Product Image" class="img-fluid">
                                    </td>
                                    <td class="border-bottom-0 text-center">
                                        <form method="POST">
                                            <input type="hidden" name="product_id" value="<?= $product['productID'] ?>" >
                                            <button class="btn btn-outline-info" name="update">Update</button>
                                            <button class="btn btn-outline-danger" name="delete">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
