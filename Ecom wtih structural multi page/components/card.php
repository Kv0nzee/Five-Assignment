<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ensure that the productID is set in the POST request
    if (isset($_POST['productID'])) {
        $id = $_POST['productID'];  
    
        if (!isset($_SESSION['cart'][$id])) {
            // Assuming you have a $pdo connection and getProductCatName function
            $product = getProductDetails($id); // You need to define this function
            $_SESSION['cart'][$id] = [
                'productID'             => $id,
                'productName'           => $product['productName'],
                'productDescription'    => $product['productDescription'],
                'catId'                 => getProductCatName($product['catId']),
                'productPrice'          => $product['productPrice'],
                'productStock'          => $product['productStock'],
                'productImg'            => $product['productImg'],
                'qty'                   => 1
            ];
        } else {
            $_SESSION['cart'][$id]["qty"] += 1;
        }
        header("Location:shop.php");
        exit();
    }
}
?>

<div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
    <a class="product-item" href="productDetailView.php?id=<?= $product['productID']?>">
        <img src="<?= $product['productImg']?>" class="img-fluid product-thumbnail" style="height:250px;">
        <h3 class="product-title"><?= $product['productName']?></h3>
        <strong class="product-price">$<?= $product['productPrice']?></strong>
        <form method="POST">
            <!-- Include a hidden input to submit the product ID -->
            <input type="hidden" name="productID" value="<?= $product['productID'] ?>">
            <button name="add_to_cart" type="submit" class="icon-cross">
                <img src="images/cross.svg" class="img-fluid">
            </button>
        </form>
    </a>
</div>
