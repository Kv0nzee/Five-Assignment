<?php require("connect.php") ?>

<nav class="custom-navbar navbar navbar-expand-md navbar-dark bg-dark px-5" arial-label="Rangoon Super Center navigation bar">
    <div class="container" style="margin:0">
        <a class="navbar-brand" href="./">Rangoon Super Center<span>.</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsRangoon" aria-controls="navbarsRangoon" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsRangoon">
            <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                <?php
                $pages = array(
                    'Home' => './',
                    'Shop' => 'shop.php',
                    'About us' => 'about.php',
                    'Contact us' => 'contact.php',
                );

                foreach ($pages as $label => $url) {
                    echo '<li class="nav-item">';
                    echo '<a class="nav-link" href="' . $url . '">' . $label . '</a>';
                    echo '</li>';
                }
                ?>
                
            </ul>
            <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
    <?php
    if (!isset($_SESSION['user'])) {
        echo '<li><a class="nav-link" href="auth.php">Login/Register</a></li>';
    } else {
        echo '<li class="nav-item dropdown">';
        echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">' . $_SESSION['user']['userName'] . '</a>';
        echo '<ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="background:#3B5D50">';
        echo '<li><a class="dropdown-item" href="orderHistory.php   ">Order History</a></li>';
        if ($_SESSION['user']['userType'] == "admin") {
        echo '<li><a class="dropdown-item" href="admindashboard.php"><img style="background:#3B5D50" src="images/user.svg">Admin</a></li>';
        }
        echo '<li><a class="dropdown-item" href="logout.php">Logout</a></li>';
        echo '</ul>';
        echo '</li>';
    }
    $qty = 0;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $value) {
            $qty += $value['qty'];
        }
    }
    ?>
    <li><a class="nav-link" href="cart.php"><img src="images/cart.svg"><span><sup class="fs-5"><?php echo $qty ?></sup></span></a></li>
</ul>
        </div>
    </div>
    
</nav>
