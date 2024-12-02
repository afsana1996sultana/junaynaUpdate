@extends('layouts.frontend')
@section('content-frontend')
    <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{route('home')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Pages <span></span> Login
                </div>
            </div>
        </div>
         <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 offset-xl-4 col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-sm-12 col-12">
                        <div class="auth-form">
                            <h4>Login Page</h4>
                            <form method="POST" action="{{ route('login') }}" class="row g-3 needs-validation" novalidate>
                                @csrf
                                <div class="form-group">
                                    <label for="email">Email <span class="color: text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{ old('email') }}" autofocus/>
                                    @error('email')
                                        <div class="text-danger" style="font-weight: bold;">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">Password <span class="color: text-danger">*</span></label>
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Your password" autocomplete="current-password" value="{{ old('password')}}" />
                                    @error('password')
                                        <div class="text-danger" style="font-weight: bold;">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group d-flex justify-content-between">
                                    <button type="submit">Sign In</button>
                                    <a class="text-muted" href="{{ route('password.request') }}">Forgot password?</a>
                                </div>
                            </form>
                            <span>New Customer? <a href="{{ route('register') }}">Create your Account</a></span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>


<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
      'use strict'

      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.querySelectorAll('.needs-validation')

      // Loop over them and prevent submission
      Array.prototype.slice.call(forms)
        .forEach(function (form) {
          form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
              event.preventDefault()
              event.stopPropagation()
            }

            form.classList.add('was-validated')
          }, false)
        })
    })()
</script>
@endsection