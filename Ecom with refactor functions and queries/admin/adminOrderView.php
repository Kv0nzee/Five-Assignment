<div class="flex w-full h-full">
    <?php
    require('../components/sidebar.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
        $orderIdToDelete = $_POST['id'];

        // Delete associated order items
        deleteOrderItems($orderIdToDelete);

        // Delete the order
        deleteOrder($orderIdToDelete);

        // Redirect to a page or take further actions as needed
        header("Location: adminOrderView.php");
        exit();
    }

    $orders = getAllOrders();
    
    // Group orders by order ID
    $groupedOrders = [];
    foreach ($orders as $order) {
        $orderId = $order->order_id;
        if (!isset($groupedOrders[$orderId])) {
            $groupedOrders[$orderId] = [];
        }
        $groupedOrders[$orderId][] = $order;
    }
    ?>
    <div class="w-full rounded-sm border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">
        <div class="max-w-full overflow-x-auto">
            <table class="w-full table-auto">
                <thead>
                    <tr class="text-left bg-gray-2 dark:bg-meta-4">
                        <th class="py-4 font-medium text-center text-black ">
                            Order ID
                        </th>
                        <th class="py-4 font-medium text-black ">
                            Product Image
                        </th>
                        <th class="py-4 font-medium text-black ">
                            User Name
                        </th>
                        <th class="py-4 font-medium text-black ">
                            Order Date
                        </th>
                        <th class="py-4 font-medium text-black ">
                            Product Name
                        </th>
                        <th class="py-4 font-medium text-black ">
                            Category
                        </th>
                        <th class="py-4 font-medium text-black ">
                            Quantity
                        </th>
                        <th class="py-4 font-medium text-black ">
                            Cancel
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($groupedOrders as $orderId => $groupedOrder) {
                        foreach ($groupedOrder as $index => $order) {
                            $user = getUserById($order->user_id);
                            $product = getProductById($order->product_id);
                            $category = getCategoryName($product->category_id);
                    ?>
                            <tr>
                                <?php if ($index === 0) { ?>
                                    <td rowspan="<?php echo count($groupedOrder); ?>" class="border-b  border-[#eee] py-5 dark:border-strokedark">
                                        <h5 class="font-medium text-center text-gray-600 max-w-44 "><?php echo $order->order_id; ?></h5>
                                    </td>
                                <?php } ?>
                                <td  class="border-b border-[#eee] py-5 dark:border-strokedark">
                                    <img src="../<?php echo $product->productImg; ?>" alt="<?php echo $product->name; ?>" class="h-16 rounded-lg " />
                                </td>
                                <?php if ($index === 0) { ?>
                                <td rowspan="<?php echo count($groupedOrder); ?>" class="border-b border-[#eee] py-5 dark:border-strokedark">
                                    <h5 class="font-medium text-gray-600 max-w-44 "><?php echo $user->username; ?></h5>
                                </td>
                                <?php } ?>
                                <?php if ($index === 0) { ?>
                                <td rowspan="<?php echo count($groupedOrder); ?>" class="border-b border-[#eee] py-5 dark:border-strokedark">
                                    <h5 class="font-medium text-gray-600 max-w-44 "><?php echo time_elapsed_string(strtotime($order->order_date)); ?></h5>
                                </td>
                                <?php } ?>
                                <td class="border-b border-[#eee] py-5 dark:border-strokedark">
                                    <h5 class="font-medium text-gray-600 "><?php echo $product->name; ?></h5>
                                </td>
                                <td  class="border-b border-[#eee] py-5 dark:border-strokedark">
                                    <h5 class="font-medium text-gray-600 max-w-44 "><?php echo $category; ?></h5>
                                </td>
                                <td class="border-b border-[#eee] py-5 dark:border-strokedark">
                                    <h5 class="font-medium text-gray-600 max-w-44 "><?php echo $order->quantity; ?></h5>
                                </td>
                                <?php if ($index === 0) { ?>
                                    <td rowspan="<?php echo count($groupedOrder); ?>" class="border-b  border-[#eee] py-5 dark:border-strokedark text-center">
                                        <form method="POST">
                                            <input type="text" hidden name="id" value="<?php echo $order->order_id; ?>">
                                            <button name="delete" class="hover:text-red-700">
                                                <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.7535 2.47502H11.5879V1.9969C11.5879 1.15315 10.9129 0.478149 10.0691 0.478149H7.90352C7.05977 0.478149 6.38477 1.15315 6.38477 1.9969V2.47502H4.21914C3.40352 2.47502 2.72852 3.15002 2.72852 3.96565V4.8094C2.72852 5.42815 3.09414 5.9344 3.62852 6.1594L4.07852 15.4688C4.13477 16.6219 5.09102 17.5219 6.24414 17.5219H11.7004C12.8535 17.5219 13.8098 16.6219 13.866 15.4688L14.3441 6.13127C14.8785 5.90627 15.2441 5.3719 15.2441 4.78127V3.93752C15.2441 3.15002 14.5691 2.47502 13.7535 2.47502ZM7.67852 1.9969C7.67852 1.85627 7.79102 1.74377 7.93164 1.74377H10.0973C10.2379 1.74377 10.3504 1.85627 10.3504 1.9969V2.47502H7.70664V1.9969H7.67852ZM4.02227 3.96565C4.02227 3.85315 4.10664 3.74065 4.24727 3.74065H13.7535C13.866 3.74065 13.9785 3.82502 13.9785 3.96565V4.8094C13.9785 4.9219 13.8941 5.0344 13.7535 5.0344H4.24727C4.13477 5.0344 4.02227 4.95002 4.02227 4.8094V3.96565ZM11.7285 16.2563H6.27227C5.79414 16.2563 5.40039 15.8906 5.37227 15.3844L4.95039 6.2719H13.0785L12.6566 15.3844C12.6004 15.8625 12.2066 16.2563 11.7285 16.2563Z"
                                                    fill="" />
                                                <path
                                                    d="M9.00039 9.11255C8.66289 9.11255 8.35352 9.3938 8.35352 9.75942V13.3313C8.35352 13.6688 8.63477 13.9782 9.00039 13.9782C9.33789 13.9782 9.64727 13.6969 9.64727 13.3313V9.75942C9.64727 9.3938 9.33789 9.11255 9.00039 9.11255Z"
                                                    fill="" />
                                                <path
                                                    d="M11.2502 9.67504C10.8846 9.64692 10.6033 9.90004 10.5752 10.2657L10.4064 12.7407C10.3783 13.0782 10.6314 13.3875 10.9971 13.4157C11.0252 13.4157 11.0252 13.4157 11.0533 13.4157C11.3908 13.4157 11.6721 13.1625 11.6721 12.825L11.8408 10.35C11.8408 9.98442 11.5877 9.70317 11.2502 9.67504Z"
                                                    fill="" />
                                                <path
                                                    d="M6.72245 9.67504C6.38495 9.70317 6.1037 10.0125 6.13182 10.35L6.3287 12.825C6.35683 13.1625 6.63808 13.4157 6.94745 13.4157C6.97558 13.4157 6.97558 13.4157 7.0037 13.4157C7.3412 13.3875 7.62245 13.0782 7.59433 12.7407L7.39745 10.2657C7.39745 9.90004 7.08808 9.64692 6.72245 9.67504Z"
                                                    fill="" />
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                <?php } ?>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
