
@extends('member.layout.default')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Member</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">

            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
              <img src="{{asset('admin')}}/assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
              <a href="#" class="btn btn-primary mt-3">Edit Profile</a>
            </div>
            
          </div>
        </div>

        <div class="col-xl-4">
          <div class="card">

            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
              <img src="{{asset('admin')}}/assets/img/icons/payment.png" alt="Profile" class="rounded-circle">
              <a href="#" class="btn btn-primary mt-3">Make Payment</a>
            </div>

          </div>
        </div>

        <div class="col-xl-4">
          <div class="card">

            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
              <img src="{{asset('admin')}}/assets/img/icons/event.png" alt="Profile" class="rounded-circle">
              <a href="#" class="btn btn-primary mt-3">See Events</a>
            </div>

          </div>
        </div>

      </div>
    </section>

  </main><!-- End #main -->
@endsection