  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link text-center">
    <i class="fas fa-user-shield"></i>
      <span class="brand-text font-weight-light">Quản Trị Viên</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="./assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Quyennqph54332</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="../widgets.html" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <!-- danh mục -->
          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN . '?act=danh-muc'?>" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>Danh mục sản phẩm</p>
            </a>
          </li>
          <!-- sản phẩm -->
          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN . '?act=san-pham'?>" class="nav-link">
            <i class="nav-icon fas fa-tshirt"></i>
              <p> Sản phẩm</p>
            </a>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>