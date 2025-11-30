@extends('layouts.app')
@section('content')

<main>

  {{-- Banner --}}
  <div class="page-banner bg-img bg-img-parallax overlay-dark" style="background-image: url('{{ asset('/web/assets/img/smoke.jpg') }}'); min-height: 220px;">
    <div class="container h-100">
      <div class="row justify-content-center align-items-center h-100">
        <div class="col-lg-8 text-center">
          <h1 class="fg-white">{{ __('Login') }}</h1>
          <p class="text-light">Welcome back! Please login to continue.</p>
        </div>
      </div>
    </div>
  </div>

  {{-- Login Form Section --}}
  <div class="page-section py-5">
    <div class="container">
      <div class="row justify-content-center mt-5">
        <div class="col-lg-6">
          <div class="card shadow-sm">
            <div class="card-body">
              <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email --}}
                <div class="form-group">
                  <label for="email">{{ __('Email Address') }}</label>
                  <input type="email" class="form-control @error('email') is-invalid @enderror" 
                         id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                  @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>

                {{-- Password --}}
                <div class="form-group">
                  <label for="password">{{ __('Password') }}</label>
                  <input type="password" class="form-control @error('password') is-invalid @enderror" 
                         id="password" name="password" required autocomplete="current-password">
                  @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>

                {{-- Remember Me & Forgot Password --}}
                <div class="form-group d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                  </div>
                  @if (Route::has('password.request'))
                      <a href="{{ route('password.request') }}" class="text-primary">
                        {{ __('Forgot Your Password?') }}
                      </a>
                  @endif
                </div>

                {{-- Submit Button --}}
                <div class="form-group text-center mt-4">
                  <button type="submit" class="btn btn-primary px-5">
                    {{ __('Login') }}
                  </button>
                </div>

                {{-- Optional: Registration Link --}}
                <div class="form-group text-center mt-2">
                  <p class="mb-0">Don't have an account? <a href="{{ route('register') }}" class="text-primary">Register here</a></p>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</main>

@endsection
