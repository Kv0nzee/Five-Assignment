<?php
$host = "localhost";
$dbname = "mysql"; // Corrected variable name
$dbuser = "root";
$password = "";
$createdb = "Assignment_NEW";

require_once("Connection.php");
session_start();
$connection = new Connection($host, $dbname, $dbuser, $password);
$pdo = $connection->getConnection();

if ($pdo) {
    // Connection is successful

    $create_db = "CREATE DATABASE IF NOT EXISTS $createdb";

    try {
        $pdo->exec($create_db); // Direct execute

        $pdo->exec("USE $createdb"); // Switch database from mysql
        // echo "Database connection and creation successful.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    // echo "Connection Fail";
}
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>

<head>
<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Poppins:wght@200;600;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>

<body style="width:100vw; overflow-x:hidden;">