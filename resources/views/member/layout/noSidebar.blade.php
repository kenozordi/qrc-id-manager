<!DOCTYPE html>
<html lang="en">

<head>
  @include('admin.layout.partials.header')
</head>

<body class="toggle-sidebar">
    @include('admin.layout.partials.nav')

    @yield('content')

    @include('admin.layout.partials.footerScripts')

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


</body>

</html>