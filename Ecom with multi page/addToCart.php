<?php
require_once('Connect.php');

$id = $_POST['productID'];
// echo $id . "<br>";

$get_product = "SELECT * FROM products WHERE productID = '$id'";

try {
    $stmt = $pdo->query($get_product);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);


    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (!isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id] = [
            'productID' => $id,
            'productName' => $product['productName'],
            'productCat' => $product['productCat'],
            'productPrice' => $product['productPrice'],
            'productStock' => $product['productStock'],
            'imagePath' => $product['imagePath'],
            'qty' => 1,
        ];
    } else {
        $_SESSION['cart'][$id]['qty'] += 1;
    }

    header("Location: ./");
    
} catch (PDOException $e) {
    $e->getMessage();
}
?>