@extends('layouts.app')
@section('content')

<main>
  
  <div class="page-banner bg-img bg-img-parallax overlay-dark" style="background-image: url({{ asset('/web/assets') }}/img/smoke.jpg);">
    <div class="container h-100">
        <div class="row justify-content-center align-items-center h-100">
          <div class="col-lg-8">
            <nav aria-label="breadcrumb">

            </nav>
            <h1 class="fg-white text-center">Campaign Products</h1>
          </div>
        </div>
    </div>
  </div>

  <div class="page-section">
    <div class="container text-center py-5">
        <h2 class="section-title">{{ count($products) }} <span style="color:#00b894;"> </span></h2>
        <p class="section-subtitle">products found</p>

      <div class="row">
       @foreach($products as $row)
        <div class="col-6 col-md-3">
          <div class="industry-box">
            <div class="industry-icon fintech"><img src="{{ asset('uploads/product/'.$row->thumbnail) }}" height="60px" width="60px"></div>
            <a href="{{ route('campaign.product.details',$row->slug) }}" class="text-decoration-none">
              <div class="industry-title">{{ $row->name }}</div>
            </a>
            <div class="industry-title">
              <p class="text-success">Price - {{ $row->price }}</p>
            </div>
          </div>
        </div>
        @endforeach

      </div>
    </div>
  </div>

</main>

@endsection