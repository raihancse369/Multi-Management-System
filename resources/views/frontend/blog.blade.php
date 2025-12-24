@extends('layouts.app')
@section('content')
@php
  $blog=DB::table('posts')->limit(9)->get();
@endphp

<main>
  <div class="page-banner bg-img bg-img-parallax overlay-dark" style="background-image: url({{ asset('/web/assets') }}/img/smoke.jpg);">
    <div class="container h-100">
        <div class="row justify-content-center align-items-center h-100">
          <div class="col-lg-8">
            <nav aria-label="breadcrumb">

            </nav>
            <h1 class="fg-white text-center">News</h1>
          </div>
        </div>
    </div>
  </div> <!-- .page-banner -->

  <div class="page-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-10">
            <div class="row">
              @foreach($blog as $row)
              <div class="col-md-6 col-lg-4 py-3">
                <div class="card-blog">
                  <div class="header">
                    <div class="avatar">
                      <img src="{{ asset('uploads/post/'.$row->image) }}" alt="">
                    </div>
                    <div class="entry-footer">
                      <div class="post-author">@if($row->user_id==0) Admin @else @endif</div>
                      <a class="post-date">{{ date('d F , Y') ,strtotime($row->date)  }}</a>
                    </div>
                  </div>
                  <div class="body">
                    <div class="post-title"><a href="{{ route('blog-single.page',$row->slug) }}" class="text-decoration-none">{{ Str::limit(strip_tags($row->title), 23) }}</a></div>
                    <div class="post-excerpt">{{ Str::limit(strip_tags($row->details), 80) }}</div>
                  </div>
                  <div class="footer">
                    <a href="{{ route('blog-single.page',$row->slug) }}" class="text-decoration-none">Read More <span class="mai-chevron-forward text-sm"></span></a>
                  </div>
                </div>
              </div>

               @endforeach


              <div class="col-12 my-5">
                <nav aria-label="Page Navigation">
                  <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                      <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                    <li class="page-item active" aria-current="page">
                      <a class="page-link" href="#">1 <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                      <a class="page-link" href="#">Next</a>
                    </li>
                  </ul>
                </nav>
              </div>
              
            </div>
          </div>
          
        </div>
      </div> <!-- .container -->
  </div> <!-- .page-section -->
</main>

@endsection