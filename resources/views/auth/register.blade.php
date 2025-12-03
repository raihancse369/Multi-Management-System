@extends('layouts.app')
@section('content')

<main>

  {{-- Banner --}}
  <div class="page-banner bg-img bg-img-parallax overlay-dark" style="background-image: url('{{ asset('/web/assets/img/smoke.jpg') }}'); min-height: 220px;">
    <div class="container h-100">
      <div class="row justify-content-center align-items-center h-100">
        <div class="col-lg-8 text-center">
          <h1 class="fg-white">{{ __('Register') }}</h1>
          <p class="text-light">Create a new account to get started</p>
        </div>
      </div>
    </div>
  </div>

  {{-- Registration Form Section --}}
  <div class="page-section py-5">
    <div class="container">
      <div class="row justify-content-center mt-5">
        <div class="col-lg-6">
          <div class="card shadow-sm">
            <div class="card-body">

              <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- Name --}}
                <div class="form-group">
                  <label for="name">{{ __('Name') }}</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" 
                         id="name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                  @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>

                {{-- Email --}}
                <div class="form-group">
                  <label for="email">{{ __('Email Address') }}</label>
                  <input type="email" class="form-control @error('email') is-invalid @enderror" 
                         id="email" name="email" value="{{ old('email') }}" required autocomplete="email">
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
                         id="password" name="password" required autocomplete="new-password">
                  @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="form-group">
                  <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                  <input type="password" class="form-control" 
                         id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
                </div>

                {{-- Submit Button --}}
                <div class="form-group text-center mt-4">
                  <button type="submit" class="btn btn-primary px-5">
                    {{ __('Register') }}
                  </button>
                </div>

                {{-- Optional Login Link --}}
                <div class="form-group text-center mt-2">
                  <p class="mb-0">Already have an account? <a href="{{ route('login') }}" class="text-primary">Login here</a></p>
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
