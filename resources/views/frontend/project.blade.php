@extends('layouts.app')
@section('content')
@php
  $project=DB::table('projects')->limit(9)->where('status','Yes')->get();
@endphp

<main>
  <div class="page-banner bg-img bg-img-parallax overlay-dark" style="background-image: url({{ asset('/web/assets') }}/img/smoke.jpg);">
    <div class="container h-100">
        <div class="row justify-content-center align-items-center h-100">
          <div class="col-lg-8">
            <nav aria-label="breadcrumb">

            </nav>
            <h1 class="fg-white text-center">Projects</h1>
          </div>
        </div>
    </div>
  </div> <!-- .page-banner -->
  <div class="page-section">
    <div class="container">


<div class="grid mt-3">
  @foreach($project as $row)
    <div class="grid-item mobile">
      <div class="portfolio">
        <a href="{{ asset('uploads/project-page/'.$row->image) }}" data-fancybox="portfolio">
          <img src="{{ asset('uploads/project-page/'.$row->image) }}" alt="{{ $row->project_name }}">
        </a>
        <div class="portfolio-info mt-2 text-center">
          <h5><small class="text-info">{{ $row->project_name }}</small></h5> {{-- Displaying project name --}}
        </div>
      </div>
    </div>
  @endforeach
</div> <!-- .grid -->

      
      <div class="mt-5 text-center">
        <button class="btn btn-primary">Load More</button>
      </div>
    </div> <!-- .container -->
  </div> <!-- .page-section -->

</main>

@endsection