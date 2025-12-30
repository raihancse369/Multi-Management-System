@extends('layouts.app')

@section('content')

{{-- 🔷 Banner --}}
<div class="page-banner bg-img bg-img-parallax overlay-dark d-flex align-items-center justify-content-center"
     style="background-image: url('{{ asset('/web/assets/img/smoke.jpg') }}'); min-height: 220px; background-size: cover;">
  <div class="text-center text-white">
      <h1 class="font-weight-bold mb-2">Account Settings</h1>
      <p class="text-light">Manage your shipping details and security</p>
  </div>
</div>

{{-- 🔶 Main Content --}}
<div class="container py-5">
  <div class="row justify-content-center">
    {{-- Sidebar --}}
    <div class="col-md-4 mb-4">
        @include('user.sidebar')
    </div>

    {{-- Settings Card --}}
    <div class="col-md-8">
      <div class="card shadow-sm border-0 rounded">
        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
            <h5 class="text-primary font-weight-bold mb-0">
              <i class="fa fa-cog mr-2"></i> Account Settings
            </h5>
            <a class="btn btn-sm btn-success" href="{{ route('write.review') }}">
              <i class="fa fa-pencil-alt"></i> Write a Review
            </a>
        </div>

        {{-- ⚙️ Shipping Information Section --}}
        <div class="card-body border-bottom">
          <h5 class="font-weight-bold mb-3 text-secondary">
            <i class="fa fa-truck mr-2 text-info"></i> Default Shipping Information
          </h5>
          <form action="{{ route('update.shipping') }}" method="post">
            @csrf
            <div class="form-group">
              <label><i class="fa fa-user mr-1 text-muted"></i> Shipping Name</label>
              <input type="text" class="form-control" name="shipping_name" value="{{ $shipping->shipping_name ?? '' }}" placeholder="Enter full name">
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label><i class="fa fa-phone mr-1 text-muted"></i> Shipping Phone</label>
                <input type="text" class="form-control" name="shipping_phone" value="{{ $shipping->shipping_phone ?? '' }}" placeholder="+1234567890">
              </div>
              <div class="form-group col-md-6">
                <label><i class="fa fa-envelope mr-1 text-muted"></i> Shipping Email</label>
                <input type="email" class="form-control" name="shipping_email" value="{{ $shipping->shipping_email ?? '' }}" placeholder="example@email.com">
              </div>
            </div>

            <div class="form-group">
              <label><i class="fa fa-map-marker-alt mr-1 text-muted"></i> Shipping Address</label>
              <input type="text" class="form-control" name="shipping_address" value="{{ $shipping->shipping_address ?? '' }}" placeholder="Street address, building, etc.">
            </div>

            <div class="form-row">
              <div class="form-group col-md-4">
                <label>Country</label>
                <input type="text" class="form-control" name="shipping_country" value="{{ $shipping->shipping_country ?? '' }}" placeholder="Country">
              </div>
              <div class="form-group col-md-4">
                <label>City</label>
                <input type="text" class="form-control" name="shipping_city" value="{{ $shipping->shipping_city ?? '' }}" placeholder="City">
              </div>
              <div class="form-group col-md-4">
                <label>Zip Code</label>
                <input type="text" class="form-control" name="shipping_zipcode" value="{{ $shipping->shipping_zipcode ?? '' }}" placeholder="Postal code">
              </div>
            </div>
            <div class="text-right">
              <button type="submit" class="btn btn-primary px-4">
                <i class="fa fa-save mr-1"></i> Save
              </button>
            </div>
          </form>
        </div>

        {{-- 🔒 Change Password Section --}}
        <div class="card-body">
          <h5 class="font-weight-bold mb-3 text-secondary">
            <i class="fa fa-lock mr-2 text-warning"></i> Change Your Password
          </h5>

          <form action="{{ route('customer.password.change') }}" method="POST">
            @csrf
            <div class="form-group">
              <label><i class="fa fa-key mr-1 text-muted"></i> Old Password</label>
              <input type="password" class="form-control" name="old_password" required placeholder="Enter your current password">
            </div>

            <div class="form-group">
              <label><i class="fa fa-lock mr-1 text-muted"></i> New Password</label>
              <input type="password" class="form-control @error('password') is-invalid @enderror"
                     name="password" required placeholder="Enter a new password">
              @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="form-group">
              <label><i class="fa fa-check-circle mr-1 text-muted"></i> Confirm Password</label>
              <input type="password" class="form-control" name="password_confirmation" required placeholder="Re-enter your new password">
            </div>

            <div class="text-right">
              <button type="submit" class="btn btn-primary px-4">
                <i class="fa fa-sync-alt mr-1"></i> Update Password
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- 🔹 Custom Styles --}}
<style>
  .card {
      border-radius: .6rem;
  }
  .card-header {
      border-bottom: 1px solid #f0f0f0;
  }
  .form-group label {
      font-weight: 500;
      color: #555;
  }
  .form-control {
      border-radius: .25rem;
  }
  .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
  }
  .btn-primary:hover {
      background-color: #0069d9;
      border-color: #0062cc;
  }
</style>

@endsection
