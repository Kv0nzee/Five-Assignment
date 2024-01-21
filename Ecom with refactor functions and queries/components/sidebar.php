<?php 
    require('../core/bootstrap.php');

    if (!$_SESSION['user']->type == 'admin') {
        redirect("/ecomAssignment");
        exit();
    }
    
    $menuItems = [
        [
            'label' => 'Dashboard',
            'icon' => 'https://tuk-cdn.s3.amazonaws.com/can-uploader/sidebar2-svg4.svg',
            'route' => 'index.php', 
        ],
        [
            'label' => 'UserView',
            'icon' => 'https://tuk-cdn.s3.amazonaws.com/can-uploader/sidebar2-svg5.svg',
            'route' => '../', 
        ],
    ];

    $userAndProduct = [
        [
            'sectionLabel' => 'USER',
            'items' => [
                [
                    'label' => 'User View',
                    'icon' => '<i class="fa-solid fa-eye"></i>', 
                    'route' => 'adminuserview.php', 
                ],
                [
                    'label' => 'User Create',
                    'icon' => '<i class="fa-solid fa-plus"></i>', 
                    'route' => 'adminusercreate.php', 
                ],
            ],
        ],
        [
            'sectionLabel' => 'Products',
            'items' => [
                [
                    'label' => 'Product View',
                    'icon' => '<i class="fa-solid fa-eye"></i>', 
                    'route' => 'adminproductview.php', 
                ],
                [
                    'label' => 'Product Create',
                    'icon' => '<i class="fa-solid fa-plus"></i>', 
                    'route' => 'adminproductcreate.php', 
                ],
            ],
        ],
        [
            'sectionLabel' => 'Order',
            'items' => [
                [
                    'label' => 'Order View',
                    'icon' => '<i class="fa-solid fa-eye"></i>', 
                    'route' => 'adminOrderview.php', 
                ],
            ],
        ],
    ];
?>

<style>
    .menu-dropdown {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-out;
    }
</style>

<div class="flex items-start justify-between p-6 bg-gray-900 rounded-r xl:hidden">
    <div class="flex items-center justify-between space-x-3">
        <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/sidebar2-svg1.svg" alt="logo" />
        <p class="text-2xl leading-6 text-white">Rangoon Super Center</p>
    </div>
    <div aria-label="toggler" class="flex items-center justify-center">
        <button aria-label="open" id="open" onclick="showNav(true)" class="hidden focus:outline-none focus:ring-2">
            <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/sidebar2-svg2.svg" alt="menu" />
        </button>
        <button aria-label="close" id="close" onclick="showNav(false)" class="focus:outline-none focus:ring-2">
            <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/sidebar2-svg3.svg" alt="close" />
        </button>
    </div>
</div>

<div id="Main" class="flex-col items-start justify-start hidden h-auto px-6 transition duration-500 ease-in-out transform bg-gray-900 xl:flex xl:rounded-r xl:translate-x-0 w-80">
    <div class="items-center justify-start hidden py-6 space-x-3 xl:flex">
        <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/sidebar2-svg1.svg" alt="logo" />
        <p class="text-2xl leading-6 text-white">Rangoon Super Center</p>
    </div>

    <?php
        foreach ($menuItems as $menuItem) {
            echo '<a href="' . $menuItem['route'] . '" class="flex items-center justify-start w-full mt-2 space-x-6 text-white rounded focus:outline-none focus:text-indigo-400">';
            echo '<img class="fill-stroke" src="' . $menuItem['icon'] . '" alt="' . $menuItem['label'] . '" />';
            echo '<p class="text-base leading-4 ">' . $menuItem['label'] . '</p>';
            echo '</a>';
        }
    ?>

    <?php
        foreach ($userAndProduct as $section) {
            echo '<div class="flex flex-col items-center justify-start w-full transition-all border-b border-gray-600">';
        ?>
            <button data-menu="<?= strtolower(str_replace(' ', '', $section['sectionLabel'])) ?>" onclick="toggleMenu('<?= strtolower(str_replace(' ', '', $section['sectionLabel'])) ?>')" class="flex items-center justify-between w-full py-5 text-white focus:outline-none focus:text-indigo-400 space-x-14">
                <p class="text-sm leading-5 uppercase"><?= $section['sectionLabel'] ?></p>
                <img  class="transition-all transform" src="https://tuk-cdn.s3.amazonaws.com/can-uploader/sidebar2-svg6.svg" alt="profile overview" />
            </button>
        <?php
            echo '<div id="' . strtolower(str_replace(' ', '', $section['sectionLabel'])) . '" class="flex-col items-start justify-start hidden pb-1 md:w-auto">';
            
            foreach ($section['items'] as $item) {
                echo '<a href="' . $item['route'] . '" class="flex items-center justify-start w-full px-3 py-2 space-x-6 text-gray-400 transition-all rounded hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 md:w-52">';
                echo $item['icon'];
                echo '<p class="text-base leading-4 ">' . $item['label'] . '</p>';
                echo '</a>';
            }

            echo '</div>';
            echo '</div>';
        }
    ?>
</div>

<script>
    function toggleMenu(menuId) {
        var menu = document.getElementById(menuId);
        var transformIcon = document.querySelector(`[data-menu="${menuId}"] .transform`);
        
        if (menu.style.display === 'none' || menu.style.display === '') {
            menu.style.display = 'flex';
            menu.style.display = 'opacity-100';
            transformIcon.style.transform = 'rotate(180deg)';
        } else {
            menu.style.display = 'none';
            menu.style.display = 'opacity-0';
            transformIcon.style.transform = 'rotate(0deg)';
        }
    }
</script>
