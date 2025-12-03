@extends('layouts.app')
@section('content')

<main>
  <div class="page-section pt-4">
    <div class="container">
      <nav aria-label="Breadcrumb">
        <ol class="breadcrumb bg-transparent mb-4">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('news') }}">Blog</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $post->title }}</li>
        </ol>
      </nav>
      <div class="row">
        <div class="col-lg-8">
          <div class="blog-single-wrap">
            <div class="post-thumbnail">
              <img src="{{ asset('uploads/post/'.$post->image) }}" alt="{{ $post->title }}">
            </div>
            <h1 class="post-title">{{ $post->title }}</h1>
            <div class="post-meta">
              <div class="post-author">
                <span class="text-grey">By</span> <a>@if($post->user_id==0) Admin @else {{ $post->user->name ?? 'Unknown' }} @endif</a>  
              </div>
              <span class="gap">|</span>
              <div class="post-date">
                <a>{{ date('d F, Y', strtotime($post->date)) }}</a>
              </div>
              <span class="gap">|</span>
              <div>
                <a href="{{ route('blog-single.page',$post->slug) }}">{{ $post->tags }}</a> 
              </div>
              <span class="gap">|</span>
              <div class="post-comment-count">
                <a href="#">8 Comments</a>
              </div>
            </div>
            <div class="post-content">
              <p>{!! $post->details !!}</p>
              <div class="post-tags">
                <p class="mb-2">Tags:</p>
                <a href="{{ route('blog-single.page',$post->slug) }}" class="tag-link">{{ $post->tags }}</a>

              </div>
            </div>
          </div> <!-- .blog-single-wrap -->

          <div class="comment-form-wrap pt-5">
            <h3 class="mb-5">Leave a comment</h3>
            <form action="#" class="">
              <div class="form-row form-group">
                <div class="col-md-6">
                  <label for="name">Name *</label>
                  <input type="text" class="form-control" id="name">
                </div>
                <div class="col-md-6">
                  <label for="email">Email *</label>
                  <input type="email" class="form-control" id="email">
                </div>
              </div>
              <div class="form-group">
                <label for="website">Subject</label>
                <input type="url" class="form-control" id="website">
              </div>
  
              <div class="form-group">
                <label for="message">Message</label>
                <textarea name="msg" id="message" cols="30" rows="8" class="form-control"></textarea>
              </div>
              <div class="form-group">
                <input type="submit" value="Post Comment" class="btn btn-primary">
              </div>
  
            </form>
          </div> <!-- .comment-form-wrap -->
        </div>
        
        <div class="col-lg-4">
          <div class="widget">
            <div class="widget-box">
              <h3 class="widget-title">Search</h3>
              <div class="divider"></div>
              <form action="#" class="search-form">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Type a keyword and hit enter">
                  <button type="submit" class="btn"><span class="icon mai-search"></span></button>
                </div>
              </form>
            </div>
            <div class="widget-box">
              <h3 class="widget-title">Categories</h3>
              <div class="divider"></div>
              <ul class="categories">
                <li><a href="{{ route('blog-single.page',$post->slug) }}">{{ $post->category_name }} <span>12</span></a></li>

              </ul>
            </div>

            <div class="widget-box">
              <h3 class="widget-title">Recent Blog</h3>
              <div class="divider"></div>
              <div class="blog-item">
                <div class="content">
                  <h6 class="post-title"><a href="{{ route('blog-single.page',$post->slug) }}">{{ $post->title }}</a></h6>
                  <div class="meta">
                    <a href="{{ route('blog-single.page',$post->slug) }}"><span class="mai-calendar"></span> {{ date('d F, Y', strtotime($post->date)) }}</a>
                    <a><span class="mai-person"></span> @if($post->user_id==0) Admin @else {{ $post->user->name ?? 'Unknown' }} @endif</a>
                    <a href="#"><span class="mai-chatbubbles"></span> 19</a>
                  </div>
                </div>
              </div>
            </div>

            <div class="widget-box">
              <h3 class="widget-title">Tag Cloud</h3>
              <div class="divider"></div>
              <div class="tagcloud">
                <a href="{{ route('blog-single.page',$post->slug) }}" class="tag-cloud-link">{{ $post->tags }}</a>
              </div>
            </div>


          </div>
        </div>
        
      </div>
    </div> <!-- .container -->
  </div> <!-- .page-section -->
</main>



@endsection