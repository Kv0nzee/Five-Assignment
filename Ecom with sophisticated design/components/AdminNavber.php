<?php
require_once("Connect.php");

if (isset($_SESSION['user'])) {
    $loggedInUser = $_SESSION['user'];
}
?>
<link href="css/styles.min.css" rel="stylesheet">

<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid justify-content-center">
        <a class="navbar-brand" href="AdminDashboard.php">Admin Panel</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-muted" href="AdminProductView.php">
                        <i class="fas fa-box"></i> Products
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link text-muted" href="AdminUserView.php">
                        <i class="fas fa-users"></i> Users
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link text-muted" href="AdminOrdersView.php">
                        <i class="fas fa-shopping-cart"></i> Orders
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav">
                <?php if (isset($loggedInUser)): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-muted" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle"></i> <?= $loggedInUser['userName']; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <!-- You can customize the styles here -->
                            <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

