<!DOCTYPE html>
<html lang="en">

<head>
  @include('member.layout.partials.header')
</head>

<body>
    
    @include('member.layout.partials.nav')

    @include('member.layout.partials.sidebar')
  
    @yield('content')


    @include('member.layout.partials.footerScripts')

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

</body>

</html>