@extends('layouts.app')

@section('content')

{{-- 🔷 Banner --}}
<div class="page-banner bg-img bg-img-parallax overlay-dark d-flex align-items-center justify-content-center"
     style="background-image: url('{{ asset('/web/assets/img/smoke.jpg') }}'); min-height: 220px; background-size: cover;">
  <div class="text-center text-white">
      <h1 class="font-weight-bold mb-2">Open a New Ticket 🎫</h1>
      <p class="text-light">Need help? Submit your issue and our support team will get back to you.</p>
  </div>
</div>

{{-- 🔶 Main Content --}}
<div class="container py-5">
  <div class="row justify-content-center">
    {{-- Sidebar --}}
    <div class="col-md-4 mb-4">
        @include('user.sidebar')
    </div>

    {{-- New Ticket Form --}}
    <div class="col-md-8">
      <div class="card border-0 shadow-sm rounded">
        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
            <h5 class="text-primary font-weight-bold mb-0">
              <i class="fa fa-envelope-open-text mr-2"></i> Submit a New Ticket
            </h5>
            <a href="{{ route('write.review') }}" class="btn btn-success btn-sm">
                <i class="fa fa-pencil-alt"></i> Write a Review
            </a>
        </div>

        <div class="card-body">
          {{-- Flash Message --}}
          @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <i class="fa fa-check-circle"></i> {{ session('success') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif

          <form action="{{ route('store.ticket') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Subject --}}
            <div class="form-group">
              <label class="font-weight-bold"><i class="fa fa-heading mr-1 text-muted"></i> Subject</label>
              <input type="text" class="form-control" name="subject" placeholder="Enter ticket subject" required>
            </div>

            {{-- Priority & Service --}}
            <div class="form-row">
              <div class="form-group col-md-6">
                <label class="font-weight-bold"><i class="fa fa-flag mr-1 text-muted"></i> Priority</label>
                <select class="form-control" name="priority" required>
                  <option value="Low">Low</option>
                  <option value="Medium">Medium</option>
                  <option value="High">High</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label class="font-weight-bold"><i class="fa fa-cogs mr-1 text-muted"></i> Service</label>
                <select class="form-control" name="service" required>
                  <option value="Technical">Technical</option>
                  <option value="Payment">Payment</option>
                  <option value="Affiliate">Affiliate</option>
                  <option value="Return">Return</option>
                  <option value="Refund">Refund</option>
                </select>
              </div>
            </div>

            {{-- Message --}}
            <div class="form-group">
              <label class="font-weight-bold"><i class="fa fa-comment-dots mr-1 text-muted"></i> Message</label>
              <textarea class="form-control" name="message" rows="5" placeholder="Describe your issue in detail..." required></textarea>
            </div>

            {{-- File Upload --}}
            <div class="form-group">
              <label class="font-weight-bold"><i class="fa fa-image mr-1 text-muted"></i> Attach Image (optional)</label>
              <input type="file" class="form-control-file" name="image" accept="image/*">
              <small class="text-muted d-block mt-1">You can upload screenshots or related images (max 2MB).</small>
            </div>

            {{-- Submit Button --}}
            <div class="text-right">
              <button type="submit" class="btn btn-primary px-4">
                <i class="fa fa-paper-plane mr-1"></i> Submit Ticket
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
      border-bottom: 1px solid #f1f1f1;
  }
  label {
      color: #333;
  }
  .form-control, .form-control-file {
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
  textarea {
      resize: none;
  }
  .alert {
      border-radius: .4rem;
  }
</style>

@endsection
