

<?php 
	require('./components/header.php');

	$heroBanner = getHeroBannerProduct();
	$threeProducts = getThreeProducts();
?>

		
	<?php require("./components/heroBanner.php") ?>
		<!-- End Hero Section -->

		<!-- Start Product Section -->
		<div class="product-section">
			<div class="container">
				<div class="row">

					<!-- Start Title -->
					<div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
						<h2 class="mb-4 section-title">Crafted with excellent material.</h2>
						<p class="mb-4">Premium materials for exceptional home appliance performance.</p>
						<p><a href="shop.html" class="btn">Explore</a></p>
					</div> 
					<!-- End Title  -->

					<!-- Start Product  -->
					<?php foreach($threeProducts as $product){?>
						<?php require("./components/card.php") ?>
					<?php }?>
					<!-- End Product  -->
				</div>
			</div>
		</div>
		<!-- End Product Section -->

		<!-- Start Why Choose Us Section -->
		<div class="why-choose-section">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-6">
                <h2 class="section-title">Why Choose Us</h2>
                <p>Top reasons to choose our services:</p>

                <div class="row my-5">
                    <div class="col-6 col-md-6">
                        <div class="feature">
                            <h3>Fast &amp; Free Shipping</h3>
                            <p>Quick and free shipping for your convenience.</p>
                        </div>
                    </div>

                    <div class="col-6 col-md-6">
                        <div class="feature">
                            <h3>Easy to Shop</h3>
                            <p>User-friendly shopping experience for simplicity.</p>
                        </div>
                    </div>

                    <div class="col-6 col-md-6">
                        <div class="feature">
                            <h3>24/7 Support</h3>
                            <p>Always available support for your assistance.</p>
                        </div>
                    </div>

                    <div class="col-6 col-md-6">
                        <div class="feature">
                            <h3>Hassle-Free Returns</h3>
                            <p>No worries with our easy and hassle-free returns.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="img-wrap">
                    <img src="images/why-choose-us-img.jpg" alt="Image" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>

		<!-- End Why Choose Us Section -->

		<!-- Start We Help Section -->
		<div class="we-help-section">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-7 mb-5 mb-lg-0">
                <div class="imgs-grid">
                    <div class="grid grid-1"><img src="images/img-grid-1.jpg" alt="Untree.co"></div>
                    <div class="grid grid-2"><img src="images/img-grid-2.jpg" alt="Untree.co"></div>
                    <div class="grid grid-3"><img src="images/img-grid-3.jpg" alt="Untree.co"></div>
                </div>
            </div>
            <div class="col-lg-5 ps-lg-5">
                <h2 class="section-title mb-4">We Help You Create Modern Interior Designs</h2>
                <p>Effortless modern interior design with our expert assistance. Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique. Pellentesque habitant morbi tristique senectus et netus et malesuada</p>

                <ul class="list-unstyled custom-list my-4">
                    <li>Effortless modern interior design assistance</li>
                    <li>Expert guidance for your interior projects</li>
                    <li>Enhance your living spaces with our help</li>
                    <li>Create stylish and modern home interiors</li>
                </ul>
                <p><a href="#" class="btn">Explore</a></p>
            </div>
        </div>
    </div>
</div>

		<!-- End We Help Section -->
        <?php require('./components/testimonial.php') ?>

		<!-- Start Testimonial Slider -->
		

		<!-- End Testimonial Slider -->

		<!-- Start Footer Section -->
<?php require('./components/footer.php') ?>
