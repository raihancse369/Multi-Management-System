@extends('layouts.app')
@section('content')

<main>
    <div class="page-banner bg-img bg-img-parallax overlay-dark" style="background-image: url({{ asset('/web/assets') }}/img/bg_image_3.jpg);">
    <div class="container h-100">
        <div class="row justify-content-center align-items-center h-100">
          <div class="col-lg-8">
            <nav aria-label="breadcrumb">

            </nav>
            <h1 class="fg-white text-center">{{ $page->page_name }}</h1>
          </div>
        </div>
    </div>
  </div> <!-- .page-banner -->
  <div class="page-section pt-4">
    <div class="container">

      <div class="row">
        <div class="col-lg-8">
          <div class="blog-single-wrap">
            <h1 class="post-title">{{ $page->page_title }}</h1><br>
            <div class="post-content">
              <p>{!! $page->page_description !!}</p>

            </div>
          </div> <!-- .blog-single-wrap -->

        </div>
        
      </div>
    </div> <!-- .container -->
  </div> <!-- .page-section -->
</main>

@endsection