<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["addBanner_to_cart"])) {
    $id = $heroBanner['productID'];
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (!isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id] = [
            'productID'             => $id,
            'productName'           => $heroBanner['productName'],
            'productDescription'    => $heroBanner['productDescription'],
            'catId'       => getProductCatName($heroBanner['catId']),
            'productPrice'          => $heroBanner['productPrice'],
            'productStock'  => $heroBanner['productStock'],
            'productImg'            => $heroBanner['productImg'],
            'qty'            => 1
        ];
    } else {
        $_SESSION['cart'][$id]["qty"] += 1;
    }
    header("Location: ./");
    exit();
}
?>

<div class="hero">
		<div class="container">
			<div class="row justify-content-between">
				<div class="col-lg-5">
					<div class="intro-excerpt">
						<h1><?= $heroBanner['productName']?><br/> <p clsas="d-block">Rangoon Super Center</p></h1>
						<p class="mb-4"><?= $heroBanner['productDescription']?></p>
						<form method="post">
						<p><button name="addBanner_to_cart" type="submit" class="btn btn-secondary me-2">Add Now</button>
						<a href="productDetailView.php?id=<?= $heroBanner['productID']?>" class="btn btn-white-outline">Explore</a></p>
						</form>
					</div>
				</div>
				<div class="col-lg-7">
					<div class="hero-img-wrap">
						<img src="<?= $heroBanner['productImg']?>" class="img-fluid">
					</div>
				</div>
			</div>
		</div>
	</div>