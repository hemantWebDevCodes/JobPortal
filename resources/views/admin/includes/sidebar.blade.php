  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
 
      <!-- Sidebar Logo -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-2 mb-3 d-flex">
        <div class="image">
          {{-- <img src="{{ asset('assets/images/logo.png') }}" class="w-100 bg-white" alt="User Image" width="600"> --}}
        </div>
        <div class="info">
          <a href="home.php" class="d-block"><h4>Job Finder<h4></a>
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
          <li class="nav-item menu-open">
            <a href="{{ route('dashboard_content') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p> dashboard</p>
            </a>
         </li>
          <li class="nav-item">
            <a href="{{ route('userList') }}" class="nav-link">
            <i class='fas fa-user mr-2'></i>
              <p>Users</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('Show.AdminJob') }}" class="nav-link">
            <i class='fas fa-dot-circle mr-2'></i>
              <p>Jobs</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.JobApplication') }}" class="nav-link">
            <i class='fas fa-dot-circle mr-2'></i>
              <p>Job Applications</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('show.JobCategory') }}" class="nav-link">
              <i class="fa-solid fa-list mr-2"></i>
              <p>Job Categories</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('display.JobTypeTime') }}" class="nav-link">
            <i class='fas fa-dot-circle mr-2'></i>
              <p>Job Type</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('teamMember.show') }}" class="nav-link">
            <i class='fas fa-dot-circle mr-2'></i>
              <p>Team Member</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('Show.Contact') }}" class="nav-link">
              <i class="fa-solid fa-address-book mr-2"></i>
              <p>Contact</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('Account.logout') }}" class="nav-link">
              <i class="fas fa-dot-circle mr-2"></i>
              <p>Logout</p>
            </a>
          </li>
            </ul>
          </nav>
        </div>
      </aside>
    <!-- /.sidebar -->
