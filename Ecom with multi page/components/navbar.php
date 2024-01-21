<?php
    require_once("Connect.php");
    if (!isset($_SESSION['user'])) {
        header("Location:login.php");
        exit(); // Make sure to exit after sending the header
    }
    if (isset($_SESSION['user'])) {
        $loggedInUser = $_SESSION['user'];
    }
?>
<!-- UserNavBar.php -->
<!-- UserNavBar.php -->
<nav class="navbar navbar-expand-lg navbar-light bg-light py-4">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="./">
            <img src="image\Logo.png" alt="Rangoon Supercenter Logo" height="80">
        </a>

        <form class="d-flex me-auto" method="GET" action="./">
            <!-- Search Bar -->
            <input class="form-control me-3 ms-5" type="search" placeholder="Search" aria-label="Search" style="width: 250px;" name="search">
            <button class="btn btn-outline-dark px-3" type="submit">Search</button>
        </form>

        <!-- Navigation Links -->
        <ul class="navbar-nav ms-auto">
            <li class="nav-item ms-auto me-5">
                <a class="nav-link text-dark" href="./">Products</a>
            </li>
            <li class="nav-item ms-auto me-5">
                <a class="nav-link text-dark" href="Cart.php">
                    <i class="fa-solid fa-cart-shopping fa-2xl"></i>
                    <?php
                    $qty = 0;
                    if (isset($_SESSION['cart'])) {
                        foreach ($_SESSION['cart'] as $item) {
                            $qty += $item['qty'];
                        }
                    }
                    echo '<span class="badge bg-danger ms-1">' . $qty . '</span>';
                    ?>
                </a>
            </li>
            <li class="nav-item dropdown ms-auto me-5">
                <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user-circle"> </i> <?= $loggedInUser['userName']; ?>
                </a>
                <!-- User Dropdown Menu -->
                
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="OrderHistory.php"><i class="fas fa-history"></i> Order History</a></li>
                    <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
