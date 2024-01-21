<?php
// require_once("./sql/categorysql.php");
// require_once("./sql/productSql.php");
// require_once("./sql/userSql.php");
// require_once("./sql/orderSql.php");
require_once("./components/navbar.php");

// Fetch all categories from the database
$sqlCategories = "SELECT * FROM categories";
$statementCategories = $pdo->prepare($sqlCategories);
$statementCategories->execute();
$categories = $statementCategories->fetchAll(PDO::FETCH_ASSOC);

// Handle search query
$min_price = isset($_GET['min_price']) ? $_GET['min_price'] : null;
$max_price = isset($_GET['max_price']) ? $_GET['max_price'] : null;
$category = isset($_GET['category']) ? $_GET['category'] : null;
$search = isset($_GET['search']) ? $_GET['search'] : null;

$sql = "SELECT p.*, c.categoryName FROM products p
        LEFT JOIN categories c ON p.categoryID = c.categoryID";

// Add conditions to the SQL query based on the selected category
if (!empty($category)) {
    $sql .= " WHERE p.categoryID = :category";
}
if (!empty($min_price)) {
    $sql .= (!empty($category) ? " AND" : " WHERE") . " p.productPrice >= :min_price";
}
if (!empty($max_price)) {
    $sql .= (!empty($min_price) || !empty($category) ? " AND" : " WHERE") . " p.productPrice <= :max_price";
}
if (!empty($search)) {
    $sql .= (!empty($min_price) || !empty($max_price) || !empty($category) ? " AND" : " WHERE") . " p.productName LIKE :search";
}

$statement = $pdo->prepare($sql);

// Bind values for conditions
if (!empty($category)) {
    $statement->bindValue(':category', $category, PDO::PARAM_INT);
}
if (!empty($min_price)) {
    $statement->bindValue(':min_price', $min_price, PDO::PARAM_INT);
}
if (!empty($max_price)) {
    $statement->bindValue(':max_price', $max_price, PDO::PARAM_INT);
}
if (!empty($search)) {
    $searchTerm = "%$search%";
    $statement->bindValue(':search', $searchTerm, PDO::PARAM_STR);
}

$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container w-100 p-5 flex-wrap">
    <div class="d-flex justify-content-between align-items-center my-4">
        <h2>User Product View</h2>
    </div>

    <!-- Filter Form -->
    <?php require('./components/filterform.php') ?>

    <!-- Product List -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-320 ">
        <?php foreach ($result as $product) :
            require('./components/card.php');
        endforeach; ?>
    </div>
</div>
<br><br>
