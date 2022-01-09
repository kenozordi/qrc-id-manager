<!DOCTYPE html>
<html lang="en">

<head>
  @include('admin.layout.partials.header')
</head>

<body>
      
    @yield('content')

    @include('admin.layout.partials.footer')

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


</body>

</html>