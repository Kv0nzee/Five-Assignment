<?php
session_start();
ob_start();
require_once("function.php");
require('App.php'); 
require('database/Connection.php'); 
require('database/queryBuilder.php'); 

App::bind("config", require "config.php");
App::bind("pdo", Connection::getConnection(App::get("config")["database"]));
App::bind("query", new QueryBuilder(App::get("pdo")));
?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">  
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

  <title>Your Company</title>
  <style>
    /* Custom styles for dropdown */
    .dropdown {
      display: none;
    }

    .group:focus-within .dropdown {
      display: block;
    }

    .rotate-animation {
      transform: rotate(360deg);
    }

    
.container {
  padding: 5px;
  position: static;
  width: 100%;
  @media (min-width: 640px) {
    position: relative;
    width: 50%;
  }
}

.container.left .container_clip{
  background: none;
  right: 15%;
  @media (min-width: 640px) {
    background: linear-gradient(to right, #fff 30%,  #A855F7 60%, #15BFFD 90%, #374151 100%);
  }
}

.container.right .container_clip{
  background: none;
  left: 15%;
  @media (min-width: 640px) {
    background: linear-gradient(to left, #fff 30%,  #A855F7 60%, #15BFFD 90%, #374151 100%);
  }
}

.container.left {
  right: 0%;
  display: flex;
  justify-content: flex-end;
}

.container.right {
  left: 50%;
}

.container::after {
  content: '';
  position: absolute;
  width: 0px;
  height: 0px;
  top: calc(50% - 8px);
  right: -8px;
  background: transparent;
  border: 0px;
  border-radius: 16px;
  z-index: 1;
  @media (min-width: 640px) {
    width: 16px;
    height: 16px;
    border: 2px solid #15BFFD;
    background: #15BFFD;
  }
}

.container.right::after {
  left: -8px;
}

.container::before {
  content: '';
  position: absolute;
  width: 56px;
  height: 6px;
  top: calc(50% - 1px);
  right: 8px;
  z-index: 1;
}

.container.container.left::before{
  background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="56" height="6" viewBox="0 0 56 6" fill="none"><path d="M0.181641 2.92163L5.18164 5.80838L5.18164 0.0348803L0.181641 2.92163ZM4.8172 3.42163L7.90757 3.42163L7.90757 2.42163L4.8172 2.42163L4.8172 3.42163ZM10.9979 3.42163L14.0883 3.42163L14.0883 2.42163L10.9979 2.42163L10.9979 3.42163ZM17.1787 3.42163L20.269 3.42163L20.269 2.42163L17.1787 2.42163L17.1787 3.42163ZM23.3594 3.42164L26.4498 3.42164L26.4498 2.42164L23.3594 2.42164L23.3594 3.42164ZM29.5402 3.42164L32.6305 3.42164L32.6305 2.42164L29.5402 2.42164L29.5402 3.42164ZM35.7209 3.42164L38.8113 3.42164L38.8113 2.42164L35.7209 2.42164L35.7209 3.42164ZM41.9016 3.42164L44.992 3.42164L44.992 2.42164L41.9016 2.42164L41.9016 3.42164ZM48.0824 3.42164L51.1728 3.42164L51.1728 2.42164L48.0824 2.42164L48.0824 3.42164ZM54.2631 3.42164L55.8083 3.42164L55.8083 2.42164L54.2631 2.42164L54.2631 3.42164Z" fill="url(%23paint0_linear_188_4747)" fill-opacity="0.7"/><defs><linearGradient id="paint0_linear_188_4747" x1="6.30057" y1="3.01576" x2="6.31365" y2="4.39196" gradientUnits="userSpaceOnUse"><stop stop-color="%2315BFFD"/><stop offset="1" stop-color="%239C37FD"/></linearGradient></defs></svg>');
}

.container.right::before {
  background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="57" height="7" viewBox="0 0 57 7" fill="none"><path d="M56.2949 3.51721L51.2949 0.63046L51.2949 6.40396L56.2949 3.51721ZM51.6594 3.01721L48.569 3.01721L48.569 4.01721L51.6594 4.01721L51.6594 3.01721ZM45.4786 3.01721L42.3883 3.01721L42.3883 4.01721L45.4786 4.01721L45.4786 3.01721ZM39.2979 3.01721L36.2075 3.01721L36.2075 4.01721L39.2979 4.01721L39.2979 3.01721ZM33.1171 3.01721L30.0268 3.01721L30.0268 4.01721L33.1171 4.01721L33.1171 3.01721ZM26.9364 3.01721L23.846 3.01721L23.846 4.01721L26.9364 4.01721L26.9364 3.01721ZM20.7557 3.01721L17.6653 3.01721L17.6653 4.01721L20.7557 4.01721L20.7557 3.01721ZM14.5749 3.01721L11.4846 3.01721L11.4846 4.01721L14.5749 4.01721L14.5749 3.01721ZM8.39418 3.01721L5.30381 3.01721L5.30381 4.01721L8.39418 4.01721L8.39418 3.01721ZM2.21344 3.01721L0.668255 3.01721L0.668255 4.01721L2.21344 4.01721L2.21344 3.01721Z" fill="%231286B0"/></svg>');
  left: 8px;
}

    
  </style>
</head>
<body>