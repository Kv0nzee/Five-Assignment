<?php 
  require_once("Connect.php");

  $product_sql = "SELECT * FROM products";

  $stmt = $pdo -> prepare($product_sql);
  $stmt -> execute();

  $products = $stmt -> fetchAll(PDO::FETCH_ASSOC);

  // if(isset($_POST["product_create"])){
  //   header("Location: productCreate.php");
  // }else{
  //     echo "not exist";
  // }

  if(isset($_POST["view"])){
    $id = $_POST["product_id"];
    header("Location: adminproductdetailview.php?id=$id");
    
  }

  if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete"])) {
    $id = $_POST["product_id"];
    $delete_sql = "DELETE FROM products WHERE id = $id";

    $stmt = $pdo->prepare($delete_sql);

    if ($stmt->execute()) {
        header("Location: adminProductView.php");
        exit();
    } else {
        echo "Error deleting product.";
    }
}

require('sidebar.php')
?>

<div class="container">
  <div class="mb-3">
    <form action="adminproductCreate.php">
      <h2>Product View</h2>
        <button class="btn btn-outline-primary" type="submit" >
          Create
        </button>
          <!-- <a class="blue text-decoration-none btn btn-outline-warning"  href="productCreat.php">Created by a</a> -->
    </form>
  </div>
  <!-- <form method="POST" action="adminProductView.php">
    <button class="btn btn-outline-dark" name="product_create">Create</button>
  </form> -->
  <table class="table table-striped  p-5">
    <thead>
      <tr>
        <th scope="col">Product ID</th>
        <th scope="col">Product Name</th>
        <th scope="col">Category</th>
        <th scope="col">Price</th>
        <th scope="col">Stock</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($products as $product) { ?>
        <tr>
          <form method="POST">
            <?php $product_id = $product["id"]?>
            <td scope="row"><?= $product_id; ?></td>
            <td><?php echo $product['name']; ?></td>
            <td><?php echo $product['category']; ?></td>
            <td><?php echo $product['price']; ?></td>
            <td><?php echo $product['stockQuantity']; ?></td>
            <td>
              <input type="hidden" name="product_id" value=<?= $product_id?> >
              <button class="btn btn-outline-info" name="view"> View Detail</button>
              <button class="btn btn-outline-danger" name="delete">Delete</button>
            </td>
          </tr>
          </form>
            <?php
          }
        ?> 
    </tbody>
  </table>
</div>  
</main>
  </div>
</div>