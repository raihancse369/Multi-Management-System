@php
  $data=DB::table('sliders')->where('status','Active')->get();
@endphp
<div class="page-banner home-banner mb-5">
  <div class="slider-wrapper">
    <div class="owl-carousel hero-carousel">
      @foreach($data as $row)
      <div class="hero-carousel-item">
        <img src="{{ asset('uploads/slider/'.$row->image) }}" alt="">
        <div class="img-caption">
          <div class="subhead">{{ $row->title }}</div>
          <h1 class="mb-4">{{ Str::limit(str_replace('&nbsp;', ' ', strip_tags($row->description)), 60) }}</h1>
          <a href="{{ route('service') }}" class="btn btn-outline-light">Get Started</a>
        </div>
      </div>
      @endforeach
    </div>
  </div> <!-- .slider-wrapper -->
</div> <!-- .page-banner -->