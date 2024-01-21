<?php
    require_once("Connection.php");
    session_start();

    $host = "localhost";
    $dbname = "mysql";
    $user = "root";
    $password = "";
    $createDb = "zyl";

    $connection = new Connection($host,$dbname,$user,$password); //host can either be IP or localhost 
    $pdo = $connection->getConnection();

    if($pdo){
        // echo "Connection ok ";

        $create_db = "CREATE DATABASE IF NOT EXISTS $createDb"; //Creating ecommerce_81 Database
        //Same as below but prepare first b4 execution
        // $stmt = $pdo->prepare("$create_db");
        // $stmt->execute();
        
        $pdo->exec($create_db);                                 //execution of database creation
        $pdo->exec("USE $createDb");                            //switch database from mysql to ecommerce_81
    }
    else{
        echo "Connection failed";
    }
?>
<!doctype html>
<html lang="en">
<head>
		<!-- Bootstrap CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
		<link href="css/tiny-slider.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
<!-- Start Header/Navigation -->
<?php require("function.php");
ob_start();
?>
<!-- End Header/Navigation -->
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>


