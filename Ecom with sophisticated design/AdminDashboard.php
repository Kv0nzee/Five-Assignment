<?php
require('./components/sidebar.php');

$products = getAllProducts();
$users = getAllUsers();
$categories = getAllCategories();

$productCountArr = array();
foreach ($products as $product) {
    $productCountArr[] = array("label" => $product['productName'], "y" => $product['productStock'], "price" => $product['productPrice']);
};

$sql = "SELECT * FROM order_items";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$orderItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

$orderCountbyProduct = array();
foreach ($orderItems as $item) {
    if (!isset($orderCountbyProduct[$item['product_id']])) {
        $orderCountbyProduct[$item['product_id']] = 1 * $item['quantity'];
    } else {
        $orderCountbyProduct[$item['product_id']] += 1 * $item['quantity'];
    }
}

$barchartdata = array();
foreach ($orderCountbyProduct as $id => $count) {
    $cat = getCat(getProductById($id)['catId']);
    if (!isset($barchartdata[$cat['productCat']])) {
        $barchartdata[$cat['productCat']] = $count;
    } else {
        $barchartdata[$cat['productCat']] += $count;
    }
}

$barchartDatajs = array();
foreach ($barchartdata as $data => $count) {
    $barchartDatajs[] = array("label" => $data, "y" => $count);
};

function getCat($id)
{
    global $pdo;
    $sql = "SELECT * FROM category WHERE catID = $id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getProductById($id)
{
    global $pdo;
    $sql = "SELECT * FROM products WHERE productID = $id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<div class="body-wrapper">
<div class="row">
<div class="d-flex justify-content-between">
    <div class="col-md-3 p-3 bg-white border rounded-sm border-stroke shadow-default">
        <div class="d-flex justify-content-between rounded-full bg-meta-2 p-3">
            <h6 class="text-dark">Number of products</h6>
            <img width="25" height="25" src="https://img.icons8.com/ios/50/product--v2.png" alt="product--v2"/>
        </div>
        <div class="d-flex justify-content-between mt-4">
            <div>
                <span class="text-sm font-medium">Total:</span>
            </div>
            <span class="d-flex align-items-center gap-1 text-sm font-medium text-meta-3">
                <?= count($products); ?>    
                <svg class="fill-meta-3" width="10" height="11" viewBox="0 0 10 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.35716 2.47737L0.908974 5.82987L5.0443e-07 4.94612L5 0.0848689L10 4.94612L9.09103 5.82987L5.64284 2.47737L5.64284 10.0849L4.35716 10.0849L4.35716 2.47737Z" fill=""></path>
                </svg>
            </span>
        </div>
    </div>

    <div class="col-md-3 p-3 bg-white border rounded-sm border-stroke shadow-default">
        <div class="d-flex justify-content-between rounded-full bg-meta-2 p-3">
            <h6 class="text-dark">Number of Orders</h6>
            <img width="25" height="25" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADwAAAA8CAYAAAA6/NlyAAAACXBIWXMAAAsTAAALEwEAmpwYAAABX0lEQVR4nO2aQS4EQRSGP2J2EzfBTuYKjLDgRCJscQPiSBJiR7sAFqw8qaQ30xlGT1XXq+n+v+TtpjLv6/dX1aZACCFEv5gCr4AVVhWw14VwVYDcb/XShbAVXhKOpfMvWlo/JmFfNOHUmCLtSzGRtgW/S3W/Sjg1pgnPZ3CRzoWEU2OasC/FRNqGdmiZhGfRhFnxSOdCwqkxTdiXYiJtupZm0bXEil9LNrRI50LCqTFN2BdFOjXW10hPM7/lWPaNRjLhKqNszBuNZMLvDsKhxi163GysfYsRfnQS3m3R46SxNvS8NHdOwpcterxurL2NET5xEv4Etv7R3w7w1Vh7HCM8Ap6cpJ8XSG/XB1wzzhtEcgR8O0mH6V3V+3Rc16SOcXOyoccDEnHhJNymzkjIOnDuOOm/KvR0CqzRAYeOe3pehT27T8eM6tM7XFkPwEdGwfBf98BN/fFDL0IIIegTPyCBA/t9/1/6AAAAAElFTkSuQmCC">
        </div>
        <div class="d-flex justify-content-between mt-4">
            <div>
                <span class="text-sm font-medium">Total:</span>
            </div>
            <span class="d-flex align-items-center gap-1 text-sm font-medium text-meta-3">
                <?= count($orderItems); ?>    
                <svg class="fill-meta-3" width="10" height="11" viewBox="0 0 10 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.35716 2.47737L0.908974 5.82987L5.0443e-07 4.94612L5 0.0848689L10 4.94612L9.09103 5.82987L5.64284 2.47737L5.64284 10.0849L4.35716 10.0849L4.35716 2.47737Z" fill=""></path>
                </svg>
            </span>
        </div>
    </div>

    <div class="col-md-3 p-3 bg-white border rounded-sm border-stroke shadow-default">
        <div class="d-flex justify-content-between rounded-full bg-meta-2 p-3">
            <h6 class="text-dark">Number of Users</h6>
            <img width="25" height="25" src="https://img.icons8.com/windows/32/user.png" alt="user"/>
        </div>
        <div class="d-flex justify-content-between mt-4">
            <div>
                <span class="text-sm font-medium">Total:</span>
            </div>
            <span class="d-flex align-items-center gap-1 text-sm font-medium text-meta-3">
                <?= count($users); ?>    
                <svg class="fill-meta-3" width="10" height="11" viewBox="0 0 10 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.35716 2.47737L0.908974 5.82987L5.0443e-07 4.94612L5 0.0848689L10 4.94612L9.09103 5.82987L5.64284 2.47737L5.64284 10.0849L4.35716 10.0849L4.35716 2.47737Z" fill=""></path>
                </svg>
            </span>
        </div>
    </div>

    <div class="col-md-3 p-3 bg-white border rounded-sm border-stroke shadow-default">
        <div class="d-flex justify-content-between rounded-full bg-meta-2 p-3">
            <h6 class="text-dark">Number of categories</h6>
            <img width="25" height="25" src="https://img.icons8.com/ios/50/diversity.png" alt="diversity"/>
        </div>
        <div class="d-flex justify-content-between mt-4">
            <div>
                <span class="text-sm font-medium">Total:</span>
            </div>
            <span class="d-flex align-items-center gap-1 text-sm font-medium text-meta-3">
                <?= count($categories); ?>    
                <svg class="fill-meta-3" width="10" height="11" viewBox="0 0 10 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.35716 2.47737L0.908974 5.82987L5.0443e-07 4.94612L5 0.0848689L10 4.94612L9.09103 5.82987L5.64284 2.47737L5.64284 10.0849L4.35716 10.0849L4.35716 2.47737Z" fill=""></path>
                </svg>
            </span>
        </div>
    </div>
</div>

</div>
              <!-- Chart Containers -->
       <div class="d-flex">
       <div class="col-lg-6">
            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
        </div>
        <div class="col-lg-6">
            <div id="barchartContainer" style="height: 370px; width: 100%;"></div>
        </div>
       </div>
    </div>
</div>

<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
<script>
    window.onload = function () {

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light1",
            title: {
                text: "Products By Quantity"
            },
            axisY: {
                includeZero: true
            },
            data: [{
                type: "column",
                indexLabelFontColor: "#5A5757",
                indexLabelPlacement: "outside",
                dataPoints: <?php echo json_encode($productCountArr, JSON_NUMERIC_CHECK); ?>
            }]
        });

        var barchart = new CanvasJS.Chart("barchartContainer", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light1",
            title: {
                text: "Order By Category"
            },
            axisY: {
                includeZero: true
            },
            data: [{
                type: "bar",
                indexLabelFontColor: "#5A5757",
                indexLabelPlacement: "outside",
                dataPoints: <?php echo json_encode($barchartDatajs, JSON_NUMERIC_CHECK); ?>
            }]
        });

        chart.render();
        barchart.render();
    }
</script>