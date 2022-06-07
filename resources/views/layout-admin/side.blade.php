<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex justify-content-center">
        <div class="image text-center">
          <img src="https://www.jing.fm/clipimg/full/71-716621_transparent-clip-art-open-book-frame-line-art.png" class="img-circle elevation-2" width="100%" alt="User Image">
          <h5 style="color: white" class="mt-2">APP LIBRARY</h5>
          <br>
          <h3 style="color:aliceblue">Hi {{Auth::user()->name}}</h3>
        </div>
        <div class="info">
          <a href="#" class="d-block"></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item has-treeview menu-open">
                <a href="{{ url('/') }}" class="nav-link @yield('dashboard') ">
                    <i class="nav-icon fas fa-dekstop"></i>
                    <p>
                    Dashboard
                    </p>
                </a>
            </li>
          <li class="nav-item has-treeview menu-open">
            <a href="{{ url('/profile') }}" class="nav-link @yield('profile') ">
                <i class="nav-icon fas fa-user"></i>
                <p>
                Profile
                </p>
            </a>
          </li>
          @if(Auth::user()->level == 'admin')
            <li class="nav-item has-treeview menu-open">
                <a href="{{ url('/profile/list') }}" class="nav-link @yield('member') ">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    Member
                </p>
                </a>
            </li>
          @endif
          <li class="nav-item has-treeview menu-open">
            <a href="{{ url('/book') }}" class="nav-link @yield('book') ">
              <i class="nav-icon fas fa-book"></i>
              <p>
                List Book
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
