<style>
    body {
      padding-top: 20px; /* Adjust based on your navbar height */
      overflow-x: hidden;
    }

    .sidebar {
      position: fixed;
      top: 0;
      bottom: 0;
      left: 0;
      z-index: 1000;
      padding-top: 56px; /* Adjust based on your navbar height */
      overflow-x: hidden;
    }

    .sidebar-sticky {
      position: relative;
      top: 56px; /* Adjust based on your navbar height */
      padding-top: 20px;
    }

    .main-content {
      margin-left: 220px; /* Adjust based on your sidebar width */
    }
</style>

<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <!-- Dashboard -->
          <li class="nav-item">
            <a class="nav-link" href="userProductView.php">
              <i class="fas fa-home menu-icon"></i>
              <span class="menu-title">Home</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-elements">
              <span class="menu-title">Products</span>
            </a>
            <div class="collapse" id="ui-elements">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="adminproductview.php"><i class="fas fa-eye"></i> Product View</a></li>
                <li class="nav-item"><a class="nav-link" href="adminproductcreate.php"><i class="fas fa-plus"></i> Create Product</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#sample-pages">
              <i class="fas fa-medical-bag menu-icon"></i>
              <span class="menu-title">User</span>
            </a>
            <div class="collapse" id="sample-pages">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="adminuserView.php"><i class="fas fa-users"></i> User View</a></li>
                <li class="nav-item"><a class="nav-link" href="adminusercreate.php"><i class="fas fa-user-plus"></i> User Create</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </div>
    </nav>

    <!-- Main content -->
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 main-content">