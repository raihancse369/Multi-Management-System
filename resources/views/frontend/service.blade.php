@extends('layouts.app')
@section('content')
@php
  $service=DB::table('services')->limit(9)->where('status','Yes')->get();
  $serve=DB::table('serves')->limit(12)->where('status','Yes')->get();
@endphp

<main>
  
  <div class="page-banner bg-img bg-img-parallax overlay-dark" style="background-image: url({{ asset('/web/assets') }}/img/smoke.jpg);">
    <div class="container h-100">
        <div class="row justify-content-center align-items-center h-100">
          <div class="col-lg-8">
            <nav aria-label="breadcrumb">

            </nav>
            <h1 class="fg-white text-center">Services</h1>
          </div>
        </div>
    </div>
  </div>

  <div class="page-section">
    <div class="container">
      <div class="text-center">
        <div class="subhead">Our Services</div>
        <h2 class="title-section">See what can we do for your Projects</h2>
      </div>

      <div class="row justify-content-center">
        @foreach($service as $row)
        <div class="col-md-4">
          <div class="service-card">
            <div class="service-icon">
              <img src="{{ asset('uploads/service-page/'.$row->image) }}" alt="" height="100px" width="100px">
            </div>
            <a href="{{ route('service') }}" class="text-decoration-none">
              <div class="service-title text-dark">{{ $row->service_name  }}</div>
            </a>
            <a href="{{ route('service') }}" class="text-decoration-none">
              <div class="service-desc">
                {{ $row->description  }}
              </div>
            </a>
          </div>
        </div>
        @endforeach
      </div>
    </div> <!-- .container -->
  </div> <!-- .page-section -->

  <div class="page-section">
    <div class="container text-center py-5">
        <h2 class="section-title">Industry <span style="color:#00b894;">We Serve</span></h2>
        <p class="section-subtitle">Bridge Your Business with the Virtual World</p>

      <div class="row">
        @foreach($serve as $row)
        <div class="col-6 col-md-3">
          <div class="industry-box">
            <div class="industry-icon fintech"><img src="{{ asset('uploads/serve-page/'.$row->image) }}" height="60px" width="60px"></div>
            <div class="industry-title">{{ $row->serve_name }}</div>
          </div>
        </div>
        @endforeach
        <div class="col-6 col-md-3">
          <div class="industry-box">
            <div class="industry-icon manymore"><i class="fa fa-plus"></i></div>
            <div class="industry-title">Many More</div>
          </div>
        </div>
      </div>
    </div>
  </div>

</main>

@endsection