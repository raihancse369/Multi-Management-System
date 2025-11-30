@extends('layouts.app')

@section('content')

{{-- 🔷 Banner --}}
<div class="page-banner bg-img bg-img-parallax overlay-dark d-flex align-items-center justify-content-center"
     style="background-image: url('{{ asset('/web/assets/img/smoke.jpg') }}'); min-height: 220px; background-size: cover;">
  <div class="text-center text-white">
      <h1 class="font-weight-bold mb-2">Write a Review ✍️</h1>
      <p class="text-light">Share your experience with our products and services</p>
  </div>
</div>

{{-- 🔶 Main Content --}}
<div class="container py-5">
  <div class="row justify-content-center">

    {{-- Sidebar --}}
    <div class="col-md-4 mb-4">
      @include('user.sidebar')
    </div>

    {{-- Review Form --}}
    <div class="col-md-8">
      <div class="card border-0 shadow-sm rounded">
        <div class="card-header bg-success text-white font-weight-bold">
          <i class="fa fa-star mr-2"></i> Share Your Valuable Review
        </div>

        <div class="card-body">
          {{-- Flash Message --}}
          @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <i class="fa fa-check-circle"></i> {{ session('success') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif

          <form action="{{ route('store.website.review') }}" method="POST">
            @csrf

            {{-- Customer Name --}}
            <div class="form-group">
              <label class="font-weight-bold"><i class="fa fa-user mr-1"></i> Customer Name</label>
              <input type="text" class="form-control" name="name" readonly value="{{ Auth::user()->name }}">
            </div>

            {{-- Review Message --}}
            <div class="form-group">
              <label class="font-weight-bold"><i class="fa fa-comment mr-1"></i> Your Review</label>
              <textarea class="form-control" name="review" rows="5" placeholder="Write your review here..." required></textarea>
            </div>

            {{-- Rating --}}
            <div class="form-group">
              <label class="font-weight-bold"><i class="fa fa-star mr-1"></i> Rating</label>
              <select class="form-control" name="rating" style="max-width: 200px;">
                <option value="1">1 Star</option>
                <option value="2">2 Stars</option>
                <option value="3">3 Stars</option>
                <option value="4">4 Stars</option>
                <option value="5" selected>5 Stars</option>
              </select>
            </div>

            {{-- Submit --}}
            <div class="text-right">
              <button type="submit" class="btn btn-primary">
                <i class="fa fa-paper-plane mr-1"></i> Submit Review
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
      font-size: 1rem;
  }
  label {
      color: #333;
  }
  textarea {
      resize: none;
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
      border-color: #005cbf;
  }
</style>

@endsection
