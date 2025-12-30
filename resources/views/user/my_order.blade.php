@extends('layouts.app')

@section('content')

{{-- 🔷 Banner --}}
<div class="page-banner bg-img bg-img-parallax overlay-dark d-flex align-items-center justify-content-center"
     style="background-image: url('{{ asset('/web/assets/img/smoke.jpg') }}'); min-height: 220px; background-size: cover;">
  <div class="text-center text-white">
      <h1 class="font-weight-bold mb-2">My Orders</h1>
      <p class="text-light">Track and manage your orders easily</p>
  </div>
</div>

{{-- 🔶 Main Content --}}
<div class="container py-5">
  <div class="row justify-content-center">
    {{-- Sidebar --}}
    <div class="col-md-4 mb-4">
        @include('user.sidebar')
    </div>

    {{-- Orders Section --}}
    <div class="col-md-8">
      <div class="card shadow-sm rounded">
        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
            <h5 class="font-weight-bold text-primary mb-0">
                <i class="fa fa-shopping-cart mr-2"></i> My Orders
            </h5>
            <a href="{{ route('write.review') }}" class="btn btn-sm btn-success">
                <i class="fa fa-pencil-alt"></i> Write a Review
            </a>
        </div>

        <div class="card-body">
          @if($orders->count() > 0)
            <div class="table-responsive">
              <table class="table table-hover align-middle">
                <thead class="thead-light">
                  <tr>
                    <th>Order ID</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($orders as $row)
                  <tr>
                    <td class="font-weight-bold">{{ $row->order_id }}</td>
                    <td>{{ date('d M, Y', strtotime($row->date ?? $row->created_at)) }}</td>
                    <td>${{ number_format($row->subtotal, 2) }}</td>
                    <td>{{ ucfirst($row->payment_type) }}</td>
                    <td>
                      @if($row->status == 0)
                        <span class="badge badge-danger">Pending</span>
                      @elseif($row->status == 1)
                        <span class="badge badge-info">Received</span>
                      @elseif($row->status == 2)
                        <span class="badge badge-primary">Shipped</span>
                      @elseif($row->status == 3)
                        <span class="badge badge-success">Completed</span>
                      @elseif($row->status == 4)
                        <span class="badge badge-warning">Returned</span>
                      @elseif($row->status == 5)
                        <span class="badge badge-dark">Cancelled</span>
                      @else
                        <span class="badge badge-secondary">Unknown</span>
                      @endif
                    </td>
                    <td>
                      <a href="{{ route('view.order', $row->id) }}" 
                         class="btn btn-sm btn-outline-primary"
                         title="View Order Details">
                         <i class="fa fa-eye"></i>
                      </a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            {{-- Empty State --}}
            <div class="text-center py-5 text-muted">
              <i class="fa fa-box-open fa-3x mb-3 text-primary"></i>
              <h5 class="font-weight-bold">No Orders Found</h5>
              <p>You haven’t placed any orders yet.</p>
              <a href="{{ route('home') }}" class="btn btn-primary btn-sm mt-2">
                <i class="fa fa-shopping-bag"></i> Start Shopping
              </a>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>

{{-- 🔹 Custom Styling --}}
<style>
  .table thead th {
      background-color: #f8f9fa;
      font-weight: 600;
  }
  .table-hover tbody tr:hover {
      background-color: #f1f3f6;
  }
  .card {
      border-radius: 0.5rem;
  }
  .page-banner {
      position: relative;
      background-position: center;
      background-size: cover;
  }
  .overlay-dark::before {
      content: '';
      position: absolute;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0, 0, 0, 0.5);
  }
  .overlay-dark > * {
      position: relative;
      z-index: 2;
  }
</style>

@endsection
