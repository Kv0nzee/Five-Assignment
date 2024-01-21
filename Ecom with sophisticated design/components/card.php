<div class="col my-3">
    <div class="card h-100 shadow-sm">
        <a href="productDetailView.php?id=<?= $product['productID'] ?>"><img src="<?= $product['imagePath'] ?>" class="card-img-top" alt="Product Image" style="height:200px;"></a>
        <div class="card-body">
            <div class="clearfix mb-3">
                <span class="float-start badge rounded-pill bg-primary"><?= $product['categoryName'] ?></span>
                <span class="float-end price-hp">$<?= $product['productPrice'] ?></span>
            </div>
            <h5 class="card-title"><?= $product['productName'] ?></h5>
            <div class="text-center my-4">
                <form method="POST" action="addToCart.php">
                    <input type="hidden" name="productID" value="<?= $product['productID'] ?>">
                    <button name="add_to_cart" class="btn btn-primary">Add to Cart</button>
                </form>
            </div>
        </div>
    </div>
</div>