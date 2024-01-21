<?php
require_once("./components/AdminNavber.php");

// Check if the user is logged in as an admin
if (isset($_SESSION['user']) && $_SESSION['user']['userType'] === 'admin') {
    $loggedInUser = $_SESSION['user'];

    // Fetch some statistics for the dashboard (customize based on your needs)
    $totalUsers_sql = "SELECT COUNT(*) as totalUsers FROM users";
    $totalAdmins_sql = "SELECT COUNT(*) as totalAdmins FROM users WHERE userType = 'admin'";
    $totalProducts_sql = "SELECT COUNT(*) as totalProducts FROM products";
    $totalOrders_sql = "SELECT COUNT(*) as totalOrders FROM orders";

    // Fetching statistics data
    $totalUsers = $pdo->query($totalUsers_sql)->fetch(PDO::FETCH_ASSOC)['totalUsers'];
    $totalAdmins = $pdo->query($totalAdmins_sql)->fetch(PDO::FETCH_ASSOC)['totalAdmins'];
    $totalProducts = $pdo->query($totalProducts_sql)->fetch(PDO::FETCH_ASSOC)['totalProducts'];
    $totalOrders = $pdo->query($totalOrders_sql)->fetch(PDO::FETCH_ASSOC)['totalOrders'];

    // Fetch data for the line chart from the orders table
    $orderChartData_sql = "SELECT orderDate, COUNT(*) as orderCount FROM orders GROUP BY orderDate";
    $totalOrdersByDateData = $pdo->query($orderChartData_sql)->fetchAll(PDO::FETCH_ASSOC);

    // Fetch total sales by month from the orders table
    $totalSalesByMonth_sql = "
        SELECT DATE_FORMAT(orderDate, '%Y-%m') as month, SUM(totalPrice) as totalSales
        FROM orders
        GROUP BY month
    ";

    $totalSalesByMonthData = $pdo->query($totalSalesByMonth_sql)->fetchAll(PDO::FETCH_ASSOC);

    // Fetch data for the pie chart from the users table
    $totalUsersData_sql = "SELECT userType, COUNT(*) as userCount FROM users GROUP BY userType";
    $totalUsersData = $pdo->query($totalUsersData_sql)->fetchAll(PDO::FETCH_ASSOC);

    // Fetch total sales by category from the orders and products tables
    $totalSalesByCategory_sql = "
    SELECT c.categoryName, SUM(oi.quantity) as totalSales
    FROM orders o
    JOIN order_items oi ON o.orderID = oi.orderID
    JOIN products p ON oi.productID = p.productID
    JOIN categories c ON p.categoryID = c.categoryID
    GROUP BY c.categoryID
";

    $totalSalesByCategoryData = $pdo->query($totalSalesByCategory_sql)->fetchAll(PDO::FETCH_ASSOC);

} else {
    // If the user is not logged in or not an admin, redirect to the login page
    header("Location: login.php");
    exit();
}
?>

<!-- Add Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<body>
    <div class="container mt-3">
        <h2>Welcome, <?= $loggedInUser['userName']; ?>!</h2>

        <div class="row mt-4">
            <!-- Total Users Card -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Users</h5>
                        <p class="card-text"><?= $totalUsers; ?></p>
                        <canvas id="totalUsersChart" width="200" height="200"></canvas>
                    </div>
                </div>
            </div>

            <!-- Total Sales by Category Card -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Sales by Category</h5>
                        <canvas id="salesByCategoryChart" width="300" height="150"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <!-- Total Sales by Month Card -->
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Sales by Month</h5>
                        <canvas id="salesByMonthChart" width="300" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <!-- Links to other admin pages -->
            <div class="col-md-12">
                <a href="AdminOrdersView.php" class="btn btn-primary mt-3">View Orders</a>
                <a href="AdminProductView.php" class="btn btn-success mt-3">Manage Products</a>
                <a href="AdminUserView.php" class="btn btn-info mt-3">Manage Users</a>
                <a href="logout.php" class="btn btn-danger mt-3">Logout</a>
            </div>
        </div>
        <br><br>
    </div>

    <script>
        // User and Admin Count Chart
        var userAdminData = {
            labels: ['Admins', 'Customers'],
            datasets: [{
                data: [<?= $totalAdmins; ?>, <?= $totalUsers - $totalAdmins; ?>],
                backgroundColor:['#3282B8 ', '#BBE1FA'],
                hoverBackgroundColor: ['#1B262C', '#0F4C75', '#3282B8 ', '#BBE1FA'],
            }]
        };

        var userAdminChart = new Chart(document.getElementById('totalUsersChart').getContext('2d'), {
            type: 'pie',
            data: userAdminData
        });

        // Total Sales by Category Chart Data
        var salesByCategoryLabels = <?= json_encode(array_column($totalSalesByCategoryData, 'categoryName')); ?>;
        var totalSalesByCategoryData = <?= json_encode(array_column($totalSalesByCategoryData, 'totalSales')); ?>;

        var salesByCategoryData = {
            labels: salesByCategoryLabels,
            datasets: [{
                label: 'Total Sales',
                data: totalSalesByCategoryData,
                backgroundColor: ['#1B262C', '#0F4C75', '#3282B8 ', '#BBE1FA'],
                borderWidth: 1
            }]
        };

        var salesByCategoryChartOptions = {
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    beginAtZero: true
                }
            }
        };

        var salesByCategoryChart = new Chart(document.getElementById('salesByCategoryChart').getContext('2d'), {
            type: 'bar',
            data: salesByCategoryData,
            options: salesByCategoryChartOptions
        });

        // Total Sales by Month Chart Data
        var salesByMonthLabels = <?= json_encode(array_column($totalSalesByMonthData, 'month')); ?>;
        var totalSalesData = <?= json_encode(array_column($totalSalesByMonthData, 'totalSales')); ?>;

        var salesByMonthData = {
            labels: salesByMonthLabels,
            datasets: [{
                label: 'Total Sales',
                data: totalSalesData,
                fill: false,
                borderColor:  ['#1B262C', '#0F4C75', '#3282B8 ', '#BBE1FA'],
                borderWidth: 2,
                tension: 0.1
            }]
        };

        var salesByMonthChartOptions = {
            scales: {
                x: {
                    type: 'category',
                    labels: salesByMonthLabels,
                },
                y: {
                    beginAtZero: true
                }
            }
        };

        var salesByMonthChart = new Chart(document.getElementById('salesByMonthChart').getContext('2d'), {
            type: 'line',
            data: salesByMonthData,
            options: salesByMonthChartOptions
        });
    </script>
</body>
