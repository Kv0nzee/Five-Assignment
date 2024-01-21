<div class="flex w-auto">

<?php
require('../components/sidebar.php');

$products = getAllProduct();
$ordes = getAllOrders();
$users = getAllUsers();
$categories = getAllCategories();
$orderItems = getAllOrderItems();

$dataPoints = array();
$productCountByCategory = array();

foreach ($products as $product) {
    $dataPoints[] = array("label" => $product->name, "y" => $product->quantity, "price"=>$product->price);
    $categoryId = $product->category_id;
    if (!isset($productCountByCategory[$categoryId])) {
        $productCountByCategory[$categoryId] = 1;
    } else {
        $productCountByCategory[$categoryId]++;
    }
}

$categoryCountByOrder = array();
foreach ($orderItems as $item) {
  $productId = $item->product_id;
  if (!isset($categoryCountByOrder[getProductById($productId)->category_id])) {
    $categoryCountByOrder[getProductById($productId)->category_id] = 1 * $item->quantity ;
  } else {
    $categoryCountByOrder[getProductById($productId)->category_id] += 1 * $item->quantity;
  }
}

$dataPointsByOrder = array();
$dataPointsByCategory = array();
foreach ($categoryCountByOrder as $categoryId => $count) {
  $categoryName = getCategoryName($categoryId);
  $dataPointsByOrder[] = array("label" => $categoryName, "y" => $count);
}


foreach ($productCountByCategory as $categoryId => $count) {
     $categoryName = getCategoryName($categoryId); 
    $dataPointsByCategory[] = array("label" => $categoryName, "y" => $count);
}


?>  
<div class="w-full">
<div class="flex justify-between ">
	<div class="w-1/4 p-5 bg-white border rounded-sm border-stroke shadow-default ">
        <div class="flex  w-11.5   justify-between rounded-full bg-meta-2 ">
			<h2>Number of products</h2>
		<img width="25" height="25" src="https://img.icons8.com/ios/50/product--v2.png" alt="product--v2"/>
        </div>
        <div class="flex items-end justify-between mt-4">
          <div>
            <span class="text-sm font-medium">Total:</span>
          </div>
          <span class="flex items-center gap-1 text-sm font-medium text-meta-3">
          <?= count($products); ?>	
            <svg class="fill-meta-3" width="10" height="11" viewBox="0 0 10 11" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M4.35716 2.47737L0.908974 5.82987L5.0443e-07 4.94612L5 0.0848689L10 4.94612L9.09103 5.82987L5.64284 2.47737L5.64284 10.0849L4.35716 10.0849L4.35716 2.47737Z" fill=""></path>
            </svg>
          </span>
        </div>
    </div>
	<div class="w-1/4 p-5 bg-white border rounded-sm border-stroke shadow-default ">
        <div class="flex  w-11.5   justify-between rounded-full bg-meta-2 ">
			<h2>Number of Orders</h2>
      <img  width="25" height="25" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADwAAAA8CAYAAAA6/NlyAAAACXBIWXMAAAsTAAALEwEAmpwYAAABX0lEQVR4nO2aQS4EQRSGP2J2EzfBTuYKjLDgRCJscQPiSBJiR7sAFqw8qaQ30xlGT1XXq+n+v+TtpjLv6/dX1aZACCFEv5gCr4AVVhWw14VwVYDcb/XShbAVXhKOpfMvWlo/JmFfNOHUmCLtSzGRtgW/S3W/Sjg1pgnPZ3CRzoWEU2OasC/FRNqGdmiZhGfRhFnxSOdCwqkxTdiXYiJtupZm0bXEil9LNrRI50LCqTFN2BdFOjXW10hPM7/lWPaNRjLhKqNszBuNZMLvDsKhxi163GysfYsRfnQS3m3R46SxNvS8NHdOwpcterxurL2NET5xEv4Etv7R3w7w1Vh7HCM8Ap6cpJ8XSG/XB1wzzhtEcgR8O0mH6V3V+3Rc16SOcXOyoccDEnHhJNymzkjIOnDuOOm/KvR0CqzRAYeOe3pehT27T8eM6tM7XFkPwEdGwfBf98BN/fFDL0IIIegTPyCBA/t9/1/6AAAAAElFTkSuQmCC">
        </div>
        <div class="flex items-end justify-between mt-4">
          <div>
            <span class="text-sm font-medium">Total:</span>
          </div>
          <span class="flex items-center gap-1 text-sm font-medium text-meta-3">
            <?= count($ordes); ?>	
            <svg class="fill-meta-3" width="10" height="11" viewBox="0 0 10 11" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M4.35716 2.47737L0.908974 5.82987L5.0443e-07 4.94612L5 0.0848689L10 4.94612L9.09103 5.82987L5.64284 2.47737L5.64284 10.0849L4.35716 10.0849L4.35716 2.47737Z" fill=""></path>
            </svg>
          </span>
        </div>
    </div>
	<div class="w-1/4 p-5 bg-white border rounded-sm border-stroke shadow-default ">
        <div class="flex  w-11.5   justify-between rounded-full bg-meta-2 ">
			<h2>Number of Users</h2>
    <img  width="25" height="25" src="https://img.icons8.com/windows/32/user.png" alt="user"/>
        </div>
        <div class="flex items-end justify-between mt-4">
          <div>
            <span class="text-sm font-medium">Total:</span>
          </div>
          <span class="flex items-center gap-1 text-sm font-medium text-meta-3">
          <?= count($users); ?>	
            <svg class="fill-meta-3" width="10" height="11" viewBox="0 0 10 11" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M4.35716 2.47737L0.908974 5.82987L5.0443e-07 4.94612L5 0.0848689L10 4.94612L9.09103 5.82987L5.64284 2.47737L5.64284 10.0849L4.35716 10.0849L4.35716 2.47737Z" fill=""></path>
            </svg>
          </span>
        </div>
    </div>
	<div class="w-1/4 p-5 bg-white border rounded-sm border-stroke shadow-default ">
        <div class="flex  w-11.5   justify-between rounded-full bg-meta-2 ">
			<h2>Number of categories</h2>
      <img width="25" height="25" src="https://img.icons8.com/ios/50/diversity.png" alt="diversity"/>
        </div>
        <div class="flex items-end justify-between mt-4">
          <div>
            <span class="text-sm font-medium">Total:</span>
          </div>
          <span class="flex items-center gap-1 text-sm font-medium text-meta-3">
          <?= count($categories); ?>	
            <svg class="fill-meta-3" width="10" height="11" viewBox="0 0 10 11" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M4.35716 2.47737L0.908974 5.82987L5.0443e-07 4.94612L5 0.0848689L10 4.94612L9.09103 5.82987L5.64284 2.47737L5.64284 10.0849L4.35716 10.0849L4.35716 2.47737Z" fill=""></path>
            </svg>
          </span>
        </div>
    </div>
</div>
<div id="chartContainer"  class="w-full h-96"></div>
<div class="flex w-full">
<div id="chartContainerByCategory"  class="w-1/4 h-96 "></div>
<div id="chartContainerByOrder"  class="w-3/4 h-96"></div>
</div>
</div>

<script>window.onload = function () {
    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        exportEnabled: true,
        theme: "light2",
        title: {
            text: "Product By Quantity"
        },
        axisY: {
            title: "Stock Quantity"
        },
        axisX: {
            title: "Product Name"
        },
        data: [{
            type: "column",
            indexLabel: "${price}",
            indexLabelPlacement: "outside",
            indexLabelFontColor: "black",
            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }]
    });
    
    var chartByCategory = new CanvasJS.Chart("chartContainerByCategory", {
        animationEnabled: true,
        exportEnabled: true,
        theme: "light2",
        title: {
            text: "Categories By Product  "
        },
        data: [{
            type: "pie",
            showInLegend: true,
            legendText: "{label}",
            dataPoints: <?php echo json_encode($dataPointsByCategory, JSON_NUMERIC_CHECK); ?>
        }]
    });

    var orderChart = new CanvasJS.Chart("chartContainerByOrder", {
        animationEnabled: true,
        exportEnabled: true,
        theme: "light2",
        title: {
            text: "Categories By Order Count"
        },
        axisY: {
            title: "Orders Count"
        },
        axisX: {
            title: "Category Name"
        },
        data: [{
            type: "bar",
            dataPoints: <?php echo json_encode($dataPointsByOrder, JSON_NUMERIC_CHECK); ?>
        }]
    });

    chart.render();
    chartByCategory.render();
    orderChart.render();
}

</script>
