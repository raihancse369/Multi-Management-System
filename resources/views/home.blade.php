@extends('layouts.app')

@section('content')

{{-- 🔷 Banner Section --}}
<div class="page-banner bg-img bg-img-parallax overlay-dark d-flex align-items-center justify-content-center"
     style="background-image: url('{{ asset('/web/assets/img/smoke.jpg') }}'); min-height: 220px; background-size: cover;">
  <div class="text-center text-white">
      <h1 class="fw-bold mb-2">My Profile</h1>
      <p class="text-light-50">Manage your account, orders, and preferences</p>
  </div>
</div>

{{-- 🔶 Main Content --}}
<div class="container py-5">
  <div class="row justify-content-center">
    {{-- Sidebar --}}
    <div class="col-md-4 mb-4">
        @include('user.sidebar')
    </div>

    {{-- Dashboard Content --}}
    <div class="col-md-8">
      <div class="card border-0 shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center border-bottom">
          <h5 class="mb-0 fw-bold text-primary"><i class="fa fa-tachometer-alt me-2"></i> Dashboard</h5>
          <a class="btn btn-sm btn-success" href="{{ route('write.review') }}">
              <i class="fas fa-pencil-alt"></i> Write a Review
          </a>
        </div>

        <div class="card-body">
          {{-- 🔹 Order Summary --}}
          <div class="row text-center mb-4">
            <div class="col-md-3 col-6 mb-3">
              <div class="card border-0 shadow-sm rounded">
                <div class="card-body p-3">
                  <p class="text-info fw-semibold mb-1">Total Orders</p>
                  <h5 class="fw-bold text-dark">{{ $total_order }}</h5>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-6 mb-3">
              <div class="card border-0 shadow-sm rounded">
                <div class="card-body p-3">
                  <p class="text-success fw-semibold mb-1">Success</p>
                  <h5 class="fw-bold text-dark">{{ $complete_order }}</h5>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-6 mb-3">
              <div class="card border-0 shadow-sm rounded">
                <div class="card-body p-3">
                  <p class="text-danger fw-semibold mb-1">Cancelled</p>
                  <h5 class="fw-bold text-dark">{{ $cancel_order }}</h5>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-6 mb-3">
              <div class="card border-0 shadow-sm rounded">
                <div class="card-body p-3">
                  <p class="text-warning fw-semibold mb-1">Returned</p>
                  <h5 class="fw-bold text-dark">{{ $return_order }}</h5>
                </div>
              </div>
            </div>
          </div>

          {{-- 🔹 Recent Orders Table --}}
          <h5 class="fw-bold mb-3">Recent Orders</h5>
          <div class="table-responsive">
            <table class="table align-middle table-hover">
              <thead class="table-light">
                <tr>
                  <th scope="col">Order ID</th>
                  <th scope="col">Date</th>
                  <th scope="col">Total</th>
                  <th scope="col">Payment</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
                @forelse($orders as $row)
                  <tr>
                    <td><span class="fw-semibold">{{ $row->order_id }}</span></td>
                    <td>{{ date('d M, Y', strtotime($row->date ?? $row->created_at)) }}</td>
                    <td>${{ number_format($row->subtotal, 2) }}</td>
                    <td>{{ ucfirst($row->payment_type) }}</td>
                    <td>
                      @if($row->status == 0)
                        <span class="badge bg-danger">Pending</span>
                      @elseif($row->status == 1)
                        <span class="badge bg-info">Received</span>
                      @elseif($row->status == 2)
                        <span class="badge bg-primary">Shipped</span>
                      @elseif($row->status == 3)
                        <span class="badge bg-success">Completed</span>
                      @elseif($row->status == 4)
                        <span class="badge bg-warning text-dark">Returned</span>
                      @elseif($row->status == 5)
                        <span class="badge bg-dark">Cancelled</span>
                      @endif
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="5" class="text-center text-muted py-4">
                      <i class="fa fa-box-open fa-2x mb-2"></i><br>
                      No recent orders found.
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

@endsection
