
@extends('member.layout.noSidebarAndNav')

@section('content')

<main>
  <div class="container">

    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6 col-md-6 d-flex flex-column align-items-center justify-content-center">

            <div class="d-flex justify-content-center py-4">
              <a href="#" class="logo d-flex align-items-center w-auto">
                <img src="{{asset('img')}}/qr-code.png" alt="">
              </a>
            </div><!-- End Logo -->

            {{-- Success Alert --}}
              @if(session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-1"></i>
                    {{session('status')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Error Alert --}}
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-octagon me-1"></i>
                    {{session('error')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card mb-3">

              <div class="card-body">

                <div class="pt-4 pb-2">
                  <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                  <p class="text-center small">Enter your personal details to create account</p>
                </div>

                <form class="row g-3 needs-validation" method="POST" action="{{route('member.register')}}">
                  @csrf

                  <div class="col-12">
                    <label for="name" class="form-label">Your Name</label>
                    <input type="text" name="name" class="form-control" id="name" required>
                    <div class="invalid-feedback">Please, enter your name!</div>
                  </div>

                  <div class="col-12">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" name="address" class="form-control" id="address" required>
                    <div class="invalid-feedback">Please, enter your name!</div>
                  </div>

                  <div class="col-12">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="text" name="phone_number" class="form-control" id="phone_number" required>
                    <div class="invalid-feedback">Please, enter your Phone number!</div>
                  </div>

                  <div class="col-12">
                    <label for="email" class="form-label">Your Email</label>
                    <input type="email" name="email" class="form-control" id="email" required>
                    <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                  </div>

                  <div class="col-12">
                      <label for="company" class="form-label">Company</label>
                      <input type="text" name="company" class="form-control" id="company" required>
                      <div class="invalid-feedback">Please enter a company.</div>
                  </div>

                  <div class="col-12">
                      <label for="link" class="form-label">Any Link</label>
                      <input type="text" name="link" class="form-control" id="link" required>
                      <div class="invalid-feedback">Please enter a link.</div>
                  </div>

                  <div class="col-12">
                    <label for="yourPassword" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="yourPassword" required>
                    <div class="invalid-feedback">Please enter your password!</div>
                  </div>

                  <div class="col-12">
                    <div class="form-check">
                      <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                      <label class="form-check-label" for="acceptTerms">I agree and accept the <a href="#">terms and conditions</a></label>
                      <div class="invalid-feedback">You must agree before submitting.</div>
                    </div>
                  </div>
                  <div class="col-12">
                    <button class="btn btn-primary w-100" type="submit">Create Account</button>
                  </div>
                  <div class="col-12">
                    <p class="small mb-0">Already have an account? <a href="{{ route('member.login')}}">Log in</a></p>
                  </div>
                </form>

              </div>
            </div>

          </div>
        </div>
      </div>

    </section>

  </div>
</main><!-- End #main -->
@endsection