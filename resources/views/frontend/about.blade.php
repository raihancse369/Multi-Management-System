@extends('layouts.app')
@section('content')
@php
  $show=DB::table('abouts')->get();
  $blog=DB::table('posts')->limit(9)->get();
  $employee = DB::table('employees')
    ->leftJoin('departments', 'employees.department_id', 'departments.id')
    ->leftJoin('designations', 'employees.designation_id', 'designations.id')
    ->select('employees.*', 'departments.department_name', 'designations.designation_name')
    ->limit(4)->get();
@endphp

<main>
  <div class="page-banner bg-img bg-img-parallax overlay-dark" style="background-image: url({{ asset('/web/assets') }}/img/smoke.jpg);">
    <div class="container h-100">
        <div class="row justify-content-center align-items-center h-100">
          <div class="col-lg-8">
            <nav aria-label="breadcrumb">

            </nav>
            <h1 class="fg-white text-center">About Us</h1>
          </div>
        </div>
    </div>
  </div> <!-- .page-banner -->

    @foreach($show as $row)
    <div class="page-section">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 py-3">
            <div class="subhead">About Us</div>
            <h2 class="title-section"> <span class="fg-primary">{{ $row->title }}</span> </h2>

            <p>{{ preg_replace('/\s+/', ' ', str_replace('&nbsp;', ' ', strip_tags($row->description))) }}</p>
          </div>
          <div class="col-lg-6 py-3">
            <div class="about-img">
              <img src="{{ asset('uploads/about-page/'.$row->image) }}" alt="">
            </div>
          </div>
        </div>
      </div> <!-- .container -->
    </div> <!-- .page-section -->
    @endforeach

    <div class="page-section">
      <div class="container">
        <div class="text-center">
          <div class="subhead">Our Teams</div>
          <h2 class="title-section">The Expert Team</h2>
        </div>

        <div class="owl-carousel team-carousel mt-5">
           @foreach($employee as $row)
          <div class="team-wrap">
            <div class="team-profile">
              <img src="{{ asset('uploads/employee/'.$row->image) }}" alt="">
            </div>
            <div class="team-content">
              <h5>{{ $row->name }}</h5>
              <div class="text-sm fg-grey">{{ $row->designation_name }}</div>
            </div>
          </div>
          @endforeach

        </div>
      </div> <!-- .container -->
    </div> <!-- .page-section -->
</main>

@endsection