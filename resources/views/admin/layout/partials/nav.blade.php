<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

@if(Auth::guard('admin')->check())
<div class="d-flex align-items-center justify-content-between">
  <a href="{{ route('admin.login') }}" class="logo d-flex align-items-center">
    <img src="{{asset('img')}}/qr-code.png" alt="Logo">
    <span class="d-none d-lg-block">Admin Portal</span>
  </a>
  <i class="bi bi-list toggle-sidebar-btn"></i>
</div><!-- End Logo -->

<div class="search-bar">
  <form class="search-form d-flex align-items-center" method="GET" action="#">
    <input type="text" name="query" placeholder="Search" title="Enter search keyword">
    <button type="submit" title="Search"><i class="bi bi-search"></i></button>
  </form>
</div><!-- End Search Bar -->

@else

<div class="d-flex align-items-center justify-content-between">
  <a href="index.html" class="logo d-flex align-items-center">
    <img src="{{asset('img')}}/qr-code.png" alt="Logo">
    <span class="d-none d-lg-block">QR Admin</span>
  </a>
</div><!-- End Logo -->
@endif

<nav class="header-nav ms-auto">
  <ul class="d-flex align-items-center">

    <li class="nav-item d-block d-lg-none">
      <a class="nav-link nav-icon search-bar-toggle " href="#">
        <i class="bi bi-search"></i>
      </a>
    </li><!-- End Search Icon-->
  @if(Auth::guard('admin')->check())
    <li class="nav-item dropdown">

      <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
        <i class="bi bi-bell"></i>
        <span class="badge bg-primary badge-number">0</span>
      </a><!-- End Notification Icon -->

    </li><!-- End Notification Nav -->

    <li class="nav-item dropdown">

      <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
        <i class="bi bi-chat-left-text"></i>
        <span class="badge bg-success badge-number">0</span>
      </a><!-- End Messages Icon -->

    </li><!-- End Messages Nav -->

    <li class="nav-item dropdown pe-3">

      <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
        <img src="{{asset('admin')}}/assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
        <span class="d-none d-md-block dropdown-toggle ps-2">{{Auth::guard('admin')->user()->name}}</span>
      </a><!-- End Profile Iamge Icon -->

      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
        <li class="dropdown-header">
          <h6>{{Auth::guard('admin')->user()->name}}</h6>
          <span>Admin</span>
        </li>

        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.logout') }}">
            <i class="bi bi-box-arrow-right"></i>
            <span>Sign Out</span>
          </a>
        </li>

      </ul><!-- End Profile Dropdown Items -->
    </li><!-- End Profile Nav -->
  @else

    <li class="nav-item dropdown">

      <button type="button" class="btn btn-primary m-4"> Login <i class="bx bxs-right-arrow-circle me-1"></i></button>

    </li><!-- End Messages Nav -->
  @endif

  </ul>
</nav><!-- End Icons Navigation -->

</header><!-- End Header -->