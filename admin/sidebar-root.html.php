<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar sticky">
  <div class="form-inline mr-auto">
    <ul class="navbar-nav mr-3">
      <li>
        <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn">
          <i data-feather="align-justify"></i>
        </a>
      </li>
      <li>
        <a href="#" class="nav-link nav-link-lg fullscreen-btn">
          <i data-feather="maximize"></i>
        </a>
      </li>
    </ul>
  </div>
  <ul class="navbar-nav navbar-right">
    <li class="dropdown">
      <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
        <img alt="image" src="../assets/images/user.png" class="user-img-radious-style"/>
        <span class="d-sm-none d-lg-inline-block"></span>
      </a>
      <div class="dropdown-menu dropdown-menu-right pullDown">
        <div class="dropdown-title">Hello Admin</div>
        <a href="profile.html" class="dropdown-item has-icon">
          <i class="far fa-user"></i> Profile
        </a>
        <div class="dropdown-divider"></div>
        <a href="../logout/" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
          Logout
        </a>
      </div>
    </li>
  </ul>
</nav>
<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="../dashboard/">
        <img alt="image" src="../assets/img/logo.png" class="header-logo" />
        <span class="logo-name">Wedding</span>
      </a>
    </div>
    <ul class="sidebar-menu">
      <li class="dropdown">
        <a href="../dashboard/" class="nav-link">
          <i data-feather="home"></i><span>Dashboard</span>
        </a>
      </li>
      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown">
          <i data-feather="image"></i><span>Gallery</span>
        </a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="../gallery/view-images/">View All</a></li>
          <li><a class="nav-link" href="../gallery/add-image/">Add New</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown">
          <i data-feather="image"></i><span>Slider</span>
        </a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="../slider/view-sliders/">View All</a></li>
          <li><a class="nav-link" href="../slider/add-slider/">Add New</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="../event/update-details/" class="nav-link">
          <i data-feather="home"></i><span>Event Details</span>
        </a>
      </li>
      <li class="dropdown">
        <a href="../date/update-image/" class="nav-link">
          <i data-feather="home"></i><span>Save the Date</span>
        </a>
      </li>
    </ul>
  </aside>
</div>
