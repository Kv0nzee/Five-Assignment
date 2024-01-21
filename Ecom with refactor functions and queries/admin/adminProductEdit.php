<div class="flex w-full h-full">
<?php
    require('../components/sidebar.php');

$productId = $_GET['id'];

$product = getProductById($productId); 

$categories = getAllCategories();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

    // Handle product image upload
    $productImage = ''; // Initialize with the existing image path or an empty string

    if (isset($_FILES['product_image'])) {
        $uploadDir = '../core/img/'; 
        $uploadFile = $uploadDir . basename($_FILES['product_image']['name']);

        if (move_uploaded_file($_FILES['product_image']['tmp_name'], $uploadFile)) {
            $productImage = 'core/img/' .basename($_FILES['product_image']['name']);
        } else {
            echo 'Error uploading file.';
        }
    }

    $productData = [
        'id' => $productId,
        'name' => $_POST['name'],
        'description' => $_POST['description'],
        'price' => $_POST['price'],
        'quantity' => $_POST['quantity'],
        'category_id' => $_POST['category'],
        'productImg' => $productImage, 
    ];

    // Update product data in the database
    $success = updateProduct($productData, $productId);

    if ($success) {
        // Product updated successfully
        // You can redirect to a success page or do other post-submission actions
        header('Location: adminproductview.php');
        exit();
    } else {
        // Product update failed
        // You may want to redirect back to the form or show an error message
        echo 'Error updating product in the database.';
    }
}
?>


<div class="w-full p-5 bg-white border rounded-sm border-stroke shadow-default ">
    <div class="px-6 py-4 border-b border-stroke ">
        <h3 class="font-semibold text-black ">
            Edit Product
        </h3>
    </div>
    <form  method="post" enctype="multipart/form-data">
        <div class="p-6">
            <div class="mb-4">
                <label class="block mb-2 text-black ">
                    Product Name
                </label>
                <input type="text" name="name" placeholder="Enter product name"
                    value="<?php echo $product->name; ?>"
                    class="w-full rounded border-b-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
            </div>
            <div class="mb-4">
                <label class="block mb-2 text-black ">
                    Description
                </label>
                <textarea name="description" rows="6" placeholder="Enter product description"
                    class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"><?php echo $product->description; ?></textarea>
            </div>

            <div class="mb-4">
                <label class="block mb-2 text-black ">
                    Price
                </label>
                <input type="text" name="price" placeholder="Enter product price"
                    value="<?php echo $product->price; ?>"
                    class="w-full rounded border-b-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
            </div>

            <div class="mb-4">
                <label class="block mb-2 text-black ">
                    Quantity
                </label>
                <input type="text" name="quantity" placeholder="Enter product quantity"
                    value="<?php echo $product->quantity; ?>"
                    class="w-full rounded border-b-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
            </div>

            <div class="mb-4">
                <label class="block mb-2 text-black ">
                    Category
                </label>
                <select name="category" class="w-full rounded border-b-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                    <?php foreach ($categories as $category) { ?>
                        <option value="<?php echo $category->id; ?>" <?php echo ($product->category_id == $category->id) ? 'selected' : ''; ?>>
                            <?php echo $category->name; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-4">
                <label class="block mb-2 text-black">
                    Product Image
                </label>
                <input type="file" name="product_image" accept="image/*" class="px-4 py-2 border rounded">
            </div>

            <button name="submit" class="flex justify-center w-full p-3 font-medium text-white rounded bg-zinc-600 bg-primary text-gray">
                Update Product
            </button>
        </div>
    </form>
</div>
</div>