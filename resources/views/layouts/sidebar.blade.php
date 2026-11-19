<div class="sidebar-wrapper" id="sidebar">
  <!-- Brand Logo / Identity -->
  <a href="index.html" class="sidebar-brand">
    <i class="bi bi-asterisk"></i>
    <span>EQMS Admin</span>
  </a>
  <div class="flex-grow-1 overflow-y-auto">
    <!-- Group: Menu -->
    <div class="sidebar-menu-section">
      <div class="sidebar-menu-title">Menu</div>
      <ul class="sidebar-menu-list">
        <li class="sidebar-menu-item">
          <a href="{{route('dashboard')}}" class="sidebar-menu-link active" id="menu-overview"
            title="Overview">
            <i class="bi bi-grid-fill"></i>
            <span>Dashboard</span>
          </a>
        </li>
      </ul>
    </div>

    <!-- Group: Components -->
    <div class="sidebar-menu-section">
      <div class="sidebar-menu-title">Master</div>
      <ul class="sidebar-menu-list">
        <li class="sidebar-menu-item">
          <a href="{{url('document-type')}}" class="sidebar-menu-link" id="menu-basictables"
            title="Basic Tables">
            <i class="bi bi-table"></i>
            <span>Document Type</span>
          </a>
        </li>
        <li class="sidebar-menu-item">
          <a href="{{ url('document-category') }}" class="sidebar-menu-link" id="menu-uiforms"
            title="Forms and Input">
            <i class="bi bi-input-cursor-text"></i>
            <span>Category</span>
          </a>
        </li>
        <li class="sidebar-menu-item">
          <a href="{{url('department')}}" class="sidebar-menu-link" id="menu-uibuttons" title="Buttons">
            <i class="bi bi-menu-button-wide-fill"></i>
            <span>Department</span>
          </a>
        </li>
      </ul>
    </div>

    <!-- Group: Pages -->
    <div class="sidebar-menu-section">
      <div class="sidebar-menu-title">Activity</div>
      <ul class="sidebar-menu-list">
        <li class="sidebar-menu-item">
          <a href="{{ route('documents.index') }}" class="sidebar-menu-link" id="menu-blankpage"
            title="Blank Page">
            <i class="bi bi-file-earmark"></i>
            <span>Document</span>
          </a>
        </li>
        <!-- <li class="sidebar-menu-item">
            <a href="page-login.html" class="sidebar-menu-link" id="menu-loginpage" title="Login Page">
              <i class="bi bi-box-arrow-in-right"></i>
              <span>Login Screen</span>
            </a>
          </li> -->
        <!-- <li class="sidebar-menu-item">
            <a href="page-404.html" class="sidebar-menu-link" id="menu-404" title="404 Page">
              <i class="bi bi-slash-circle"></i>
              <span>Error 404</span>
            </a>
          </li> -->
      </ul>
    </div>
  </div>

  <!-- Sidebar Profile Card (Dynamic Footer) -->
  <div class="sidebar-profile">
    <img src="{{asset('assets/images/avatar.png')}}" alt="Administrator" class="sidebar-profile-img"
      onerror="this.src='https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=256&auto=format&fit=crop'">
    <div class="sidebar-profile-info">
      <div class="sidebar-profile-name">{{ Auth::user()->name }}</div>
      <div class="sidebar-profile-email" title="{{ Auth::user()->email}}">{{ Auth::user()->email}} </div>

    </div>
  </div>
</div>