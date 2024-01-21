<?php
    require_once("Connect.php");


    $id = $_GET["id"];

    $get_product = "SELECT * FROM products WHERE id = '$id'";

   
    try {
        $stmt = $pdo->prepare($get_product);
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        if (!isset($_SESSION['cart'][$id])) {
            
            $_SESSION['cart'][$id] = [
                'id'    => $id,
                'name'  => $product['name'],
                'description'  => $product['description'],
                'category'   => $product['category'],
                'price' => $product['price'],
                'stockQuantity' => $product['stockQuantity'],
                'img'   => $product['img'],
                'qty'          => 1
            ];
        } else {
            $_SESSION['cart'][$id]["qty"] += 1;
        }

        header('Location: userProductView.php');
        
        
    } catch (PDOException $e) {
        // Handle the exception, e.g., log or display an error message
        echo "Error: " . $e->getMessage();
    }
    
?>