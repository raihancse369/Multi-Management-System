@extends('layouts.app')

@section('content')

{{-- 🔷 Banner --}}
<div class="page-banner bg-img bg-img-parallax overlay-dark d-flex align-items-center justify-content-center"
     style="background-image: url('{{ asset('/web/assets/img/smoke.jpg') }}'); min-height: 220px; background-size: cover;">
  <div class="text-center text-white">
      <h1 class="font-weight-bold mb-2">My Order Details 🛒</h1>
      <p class="text-light">Track and review your order information</p>
  </div>
</div>

{{-- 🔶 Main Content --}}
<div class="container py-5">
  <div class="row justify-content-center">

    {{-- Sidebar --}}
    <div class="col-md-4 mb-4">
      @include('user.sidebar')
    </div>

    {{-- Order Details --}}
    <div class="col-md-8">
      <div class="card border-0 shadow-sm rounded">
        <div class="card-header bg-info text-white font-weight-bold">
          <i class="fa fa-info-circle mr-2"></i> Order Summary
        </div>

        <div class="card-body">
          <div class="mb-3">
            <strong>Name:</strong> {{ $order->c_name }} <br>
            <strong>Phone:</strong> {{ $order->c_phone }} <br>
            <strong>Order ID:</strong> #{{ $order->order_id }} <br>
            <strong>Status:</strong>
            @if($order->status==0)
              <span class="badge badge-danger">Pending</span>
            @elseif($order->status==1)
              <span class="badge badge-info">Received</span>
            @elseif($order->status==2)
              <span class="badge badge-primary">Shipped</span>
            @elseif($order->status==3)
              <span class="badge badge-success">Completed</span>
            @elseif($order->status==4)
              <span class="badge badge-warning">Returned</span>
            @elseif($order->status==5)
              <span class="badge badge-danger">Canceled</span>
            @endif
            <br>
            <strong>Date:</strong> {{ date('d F, Y', strtotime($order->created_at)) }} <br>
            <strong>Subtotal:</strong> ${{ number_format($order->subtotal, 2) }} <br>
            <strong>Total:</strong> ${{ number_format($order->total, 2) }}
          </div>
        </div>

        <div class="card-body">
          <strong class="mb-3 d-block">Order Items</strong>
          <div class="table-responsive">
            <table class="table table-hover table-bordered">
              <thead class="thead-light">
                <tr>
                  <th>#</th>
                  <th>Product</th>
                  <th>Color</th>
                  <th>Size</th>
                  <th>Quantity</th>
                  <th>Price</th>
                  <th>Subtotal</th>
                </tr>
              </thead>
              <tbody>
                @foreach($order_details as $key => $item)
                <tr>
                  <td>{{ $key + 1 }}</td>
                  <td>{{ $item->product_name }}</td>
                  <td>{{ $item->color ?? '-' }}</td>
                  <td>{{ $item->size ?? '-' }}</td>
                  <td>{{ $item->quantity }}</td>
                  <td>${{ number_format($item->single_price, 2) }}</td>
                  <td>${{ number_format($item->subtotal_price, 2) }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
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
  .table th, .table td {
    vertical-align: middle;
  }
  .badge {
    font-size: .85rem;
    padding: .4em .7em;
  }
</style>

@endsection
