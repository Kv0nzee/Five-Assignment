<?php 
require('./components/header.php');
$products = [];


    if (isset($_GET['search']) && isset($_GET['min']) && isset($_GET['max'])) {
        $min = $_GET['min'];
        $max = $_GET['max'];
        $search = $_GET['search'];
        $sql = "SELECT * FROM products WHERE productName LIKE :search AND productPrice BETWEEN :min AND :max";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        $stmt->bindValue(':min', $min, PDO::PARAM_INT);
        $stmt->bindValue(':max', $max, PDO::PARAM_INT);
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    if (isset($_GET['catId'])) {
        $cat = $_GET['catId'];
        $sql = "SELECT * FROM products WHERE catId = :cat";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':cat', $cat, PDO::PARAM_INT);
		$stmt->execute();
		$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    if (!isset($_GET['search']) && !isset($_GET['catId'])) {
        $products = getAllProducts();
    }
	$max = 0;
	$min =10000;
	foreach ($products as $product) {
		if($product['productPrice'] > $max){
		$max = $product['productPrice']; 
		}
		if($product['productPrice'] < $min){
		$min = $product['productPrice']; 
		}
	}

?>
		<!-- Start Hero Section -->
			<div class="hero">
				<div class="container">
					<div class="row justify-content-between">
						<div class="col-lg-5">
							<div class="intro-excerpt">
								<h1>All Product</h1>
							</div>
						</div>
						<div class="col-lg-7">
							<div class="dropdown ml-3">
								<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
    								data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Category Filter
								</button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
									<?php foreach (getAllCategories() as $category) { ?>
										<a class="dropdown-item" href="shop.php?catId=<?= $category['catID'] ?>">
											<?= $category['productCat'] ?></a>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
					<form action="" method="GET" class="d-flex">
						<div class="input-group rounded">
							<input name="search" type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
								aria-describedby="search-addon" />
							<button class="input-group-text border-0" id="search-addon">
								<i class="fas fa-search"></i>
							</button>
						</div>
						<div class="form-outline mx-3 me-1" style="width: 300px;">
							<input type="number" step="0.01" name="min" min="1"  value="<?= $min ?>" class=" form-control text-center" />
						</div>
						<div class="form-outline me-1" style="width: 300px;">
							<input type="number" step="0.01" name="max" min="1"  value="<?= $max ?>" class="form-control text-center" />
						</div>
						<button class="input-group-text border-0 ml-3 " type="submit"  id="search-addon">
							Submit
						</button>
					</form>
				</div>
			</div>
		<!-- End Hero Section -->

		

		<div class="untree_co-section product-section before-footer-section">
		    <div class="container">
		      	<div class="row">
					<?php
						foreach($products as $product){
							require('./components/card.php');
						}
					?>
		      	</div>
		    </div>
		</div>


		<!-- Start Footer Section -->
		<?php require('./components/footer.php') ?>
		<!-- End Footer Section -->	