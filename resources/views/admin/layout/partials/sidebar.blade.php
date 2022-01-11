<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <!-- <li class="nav-item">
    <a id="dashboard" class="nav-link sidebar-link collapsed" href="{{ route('admin.dashboard') }}">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li> -->
  <!-- End Dashboard Nav -->

  <li class="nav-item">
    <a id="profile" class="nav-link sidebar-link collapsed" href="{{ route('admin.dashboard') }}">
      <i class="bi bi-person"></i>
      <span>Members</span>
    </a>
  </li><!-- End Profile Page Nav -->

</ul>

</aside><!-- End Sidebar-->


<!-- Select active tab on the sidebar -->
<script>
    $(document).ready( function() {
        var pageTitle = ("{{ $page_title }}").toString();
        var sidebarLinks = document.getElementsByClassName("sidebar-link");
          for(var i = 0; i < sidebarLinks.length; i++)
          {
              var id = sidebarLinks[i].getAttribute('id');
              if (id == pageTitle.toLowerCase()) {
                  console.log(id);
                  console.log(pageTitle);
                  sidebarLinks[i].removeAttribute('collapsed')
              }
          }
      })
</script>