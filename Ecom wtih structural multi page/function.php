<?php 

function getHeroBannerProduct(){
    global $pdo;

    $get_product = "SELECT * FROM products ORDER BY productPrice DESC LIMIT 1";

    $stmt = $pdo->query($get_product);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    return $product;
}

function getThreeProducts(){
    global $pdo;

    $get_product = "SELECT * FROM products  LIMIT 3";

    $stmt = $pdo->query($get_product);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $products;
}

function getAllProducts(){
    global $pdo;

    $get_product = "SELECT * FROM products";

    $stmt = $pdo->query($get_product);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $products;
}

function getAllUsers(){
    global $pdo;

    $get_users= "SELECT * FROM users ";

    $stmt = $pdo->query($get_users);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $users;
}

function getAllCategories(){
    global $pdo;

    $get_cats= "SELECT * FROM category ";

    $stmt = $pdo->query($get_cats);
    $cats = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $cats;
}

function getAllOrders(){
    global $pdo;

    $get_orders="SELECT orders.id AS order_id, orders.paymentType, order_items.product_id, orders.user_id, orders.order_date,  order_items.quantity
    FROM orders
    JOIN order_items ON orders.id = order_items.order_id";

    $stmt = $pdo->query($get_orders);
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $orders;
}

function getAllOrdersbyUser($id){
    global $pdo;

    $get_orders="SELECT orders.id AS order_id, orders.paymentType, order_items.product_id, orders.user_id, orders.order_date,  order_items.quantity
    FROM orders
    JOIN order_items ON orders.id = order_items.order_id
    WHERE orders.user_id = $id
    ";

    $stmt = $pdo->query($get_orders);
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $orders;
}

function getAllOrdersbyorder_item($id){
    global $pdo;

    $get_orders="SELECT orders.id AS order_id, orders.paymentType, order_items.product_id, orders.user_id, orders.order_date,  order_items.quantity
    FROM orders
    JOIN order_items ON orders.id = order_items.order_id
    WHERE order_items.id = $id
    ";

    $stmt = $pdo->query($get_orders);
    $orders = $stmt->fetch(PDO::FETCH_ASSOC);

    return $orders;
}
function getProductDetails($productId){
    global $pdo;

    $get_product = "SELECT * FROM products WHERE productID = '$productId'";

    $stmt = $pdo->query($get_product);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    return $product;
}

function getUserDetails($userId){
    global $pdo;

    $get_user = "SELECT * FROM users WHERE userID = '$userId'";

    $stmt = $pdo->query($get_user);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    return $user;
}

function getProductCatName($id){
    global $pdo;

    $get_cat = "SELECT * FROM category WHERE catID = '$id'";

    $stmt = $pdo->query($get_cat);
    $cat = $stmt->fetch(PDO::FETCH_ASSOC);

    return $cat['productCat'];
}

