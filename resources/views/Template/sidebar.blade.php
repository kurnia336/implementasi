<!-- Sidebar user panel (optional) -->
<div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('AdminLTE/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
                <a href="/" class="nav-link">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                  Dashboard
                  </p>
                </a>
              </li>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Customer
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/customer" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Customer</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="/tambahCust1" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Customer 1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/tambahCust2" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Customer 2</p>
                </a>
              </li> -->
            </ul>
          </li>
          
          <li class="nav-item">
                <a href="/barang" class="nav-link">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                  Data Barang
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/scanner" class="nav-link">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                  Barcode Scanner
                  </p>
                </a>
              </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->