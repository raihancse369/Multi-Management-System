@extends('layouts.app')

@section('content')

{{-- 🔷 Banner --}}
<div class="page-banner bg-img bg-img-parallax overlay-dark d-flex align-items-center justify-content-center"
     style="background-image: url('{{ asset('/web/assets/img/smoke.jpg') }}'); min-height: 220px; background-size: cover;">
  <div class="text-center text-white">
      <h1 class="fw-bold mb-2">Your Wishlist ❤️</h1>
      <p class="text-light-50">All your saved products in one place</p>
  </div>
</div>

{{-- 🔶 Main Content --}}
<div class="container py-5">
  <div class="row">
    {{-- Sidebar --}}
    <div class="col-md-4 mb-4">
        @include('user.sidebar')
    </div>

    {{-- Wishlist Content --}}
    <div class="col-md-8">
      <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0 text-primary"><i class="fa fa-heart me-2"></i> Wishlist Items</h5>
            <span class="badge bg-secondary">{{ count($wishlist) }} items</span>
        </div>

        <div class="card-body">
          @if($wishlist->count() > 0)
            <div class="row g-3">
              @foreach($wishlist as $row)
                <div class="col-md-6 col-lg-4 col-sm-6">
                  <div class="card border-0 shadow-sm h-100 position-relative wishlist-card">
                    <img src="{{ asset('uploads/product/'.$row->thumbnail) }}" 
                         alt="{{ $row->name }}" 
                         class="card-img-top" 
                         style="height: 180px; object-fit: cover; border-top-left-radius: .5rem; border-top-right-radius: .5rem;">

                    <div class="card-body text-center">
                      <h6 class="card-title fw-semibold mb-1">{{ Str::limit($row->name, 20) }}</h6>
                      <p class="text-muted small mb-2"><i class="fa fa-calendar me-1"></i> {{ date('d M, Y', strtotime($row->date)) }}</p>
                      <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('wishlistproduct.delete', $row->id) }}" 
                           class="btn btn-sm btn-outline-danger px-3 remove-product"
                           onclick="return confirm('Remove this product from wishlist?')">
                           <i class="fa fa-trash"></i> Remove
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          @else
            {{-- Empty State --}}
            <div class="text-center py-5 text-muted">
              <i class="fa fa-heart-broken fa-3x mb-3 text-danger"></i>
              <h5 class="fw-semibold">Your wishlist is empty</h5>
              <p class="small">Browse our products and add what you love ❤️</p>
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

<style>
  .wishlist-card:hover {
    transform: translateY(-4px);
    transition: 0.2s ease;
  }
  .wishlist-card img {
    transition: transform 0.3s ease;
  }
  .wishlist-card:hover img {
    transform: scale(1.05);
  }
</style>

@endsection
