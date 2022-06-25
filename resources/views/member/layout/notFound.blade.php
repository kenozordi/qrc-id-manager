@extends('member.layout.noSidebar')

@section('content')
    <main>
        <div class="container">

        <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
            <h1>Invalid Code</h1>
            <h2>The member you are looking for doesn't exist.</h2>
            <a class="btn" href="{{route('member.login')}}">Back to home</a>
            <img src="{{asset('admin')}}/assets/img/not-found.svg" class="img-fluid py-5" alt="Page Not Found">
        </section>

        </div>
    </main><!-- End #main -->
  @endsection