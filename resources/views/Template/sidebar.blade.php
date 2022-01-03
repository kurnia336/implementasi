<!-- Sidebar user panel (optional) -->
<meta name="google-signin-client_id" content="358137896602-u9dge97qt6p7p3vi2clai9m6n97mgrkq.apps.googleusercontent.com">
<div class="user-panel mt-3 pb-3 mb-3 d-flex">
  
        <div class="image">
        @if (Auth::guest())
            <img src="{{asset('AdminLTE/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        @else
            <img src="{{Auth::user()->image}}" class="img-circle elevation-2" alt="User Image">
        @endif 
        </div>
        <div class="info">
        @if (Auth::guest())
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        @else
            <a href="#" class="d-block">Hi, {{Auth::user()->name}}</a>
            <a href="#" class="d-block">{{Auth::user()->provider_id}}</a>
        @endif 
         
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
                <a href="/" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                  Dashboard
                  </p>
                </a>
              </li>
          <li class="nav-item menu">
            <a href="#" class="nav-link {{ request()->is('customer') ? 'active' : '' }}">
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
                <a href="/barang" class="nav-link {{ request()->is('barang') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                  Data Barang
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/scanner" class="nav-link {{ request()->is('scanner') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                  Barcode Scanner
                  </p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="/toko" class="nav-link">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                  Toko
                  </p>
                </a>
              </li> -->
              
          <li class="nav-item menu">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-store"></i>
              <p>
                Toko
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/toko" class="nav-link {{ request()->is('toko') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Toko</p>
                </a>
                <a href="/scan_toko" class="nav-link {{ request()->is('scan_toko') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Scan Toko</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item menu">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-store"></i>
              <p>
                Score Board Menu
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/scoreboard-view" class="nav-link {{ request()->is('scoreboard-view') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Score Board</p>
                </a>
                <a href="/scoreboard-console" class="nav-link {{ request()->is('scoreboard-console') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Console</p>
                </a>
              </li>
            </ul>
          </li>
          @if (Auth::guest())
            
          @else
              <li class="nav-item">
                <a href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();" class="nav-link">
                  <i class="nav-icon fas fa-power-off"></i>
                    <!-- <i class="fas fa-sign-out-alt"></i> -->
                  <p>
                  {{ __('Logout') }}
                  </p>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                </a>
          </li>
          @endif 
          
      </nav>
      <!-- /.sidebar-menu -->