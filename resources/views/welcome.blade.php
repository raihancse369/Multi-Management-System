@extends('layouts.app')
@section('content')
@include('layouts.frontend_partial.slider')
@php
$show=DB::table('abouts')->get();
$brand=DB::table('brands')->where('status','Yes')->get();
$blog=DB::table('posts')->limit(4)->get();
$product=DB::table('products')->where('status','Active')->limit(8)->get();
$serve=DB::table('serves')->limit(12)->where('status','Yes')->get();
$service=DB::table('services')->limit(6)->where('status','Yes')->get();
$project=DB::table('projects')->limit(6)->where('status','Yes')->get();
$wbreview=DB::table('wbreviews')->limit(6)->where('status',0)->get();
$campaign = DB::table('campaigns')->where('status', 1)->orderBy('id', 'DESC')->get();
@endphp
@foreach($show as $row)
<div class="page-section">
   <div class="container">
      <div class="row align-items-center">
         <div class="col-lg-6 py-3">
            <div class="subhead">About Us</div>
            <h2 class="title-section">{{ $row->title }}</h2>
            <p>{{ Str::limit(str_replace('&nbsp;', ' ', strip_tags($row->description)), 220) }}</p>
            <a href="{{ route('about') }}" class="btn btn-primary mt-4">Read More</a>
         </div>
         <div class="col-lg-6 py-3">
            <div class="about-img">
               <img src="{{ asset('uploads/about-page/'.$row->image) }}" name="old_photo">
            </div>
         </div>
      </div>
   </div>
</div>
<!-- .page-section -->
@endforeach
<div class="page-section">
   <div class="container py-5">
      <div class="row text-center">
         <div class="col-md-2 col-sm-4 stats-box">
            <i class="fa fa-floppy-o"></i>
            <div class="counter" data-target="50">0</div>
            <small>Projects</small>
         </div>
         <div class="col-md-2 col-sm-4 stats-box">
            <i class="fa fa-cart-plus"></i>
            <div class="counter" data-target="40">0</div>
            <small>Products</small>
         </div>
         <div class="col-md-2 col-sm-4 stats-box">
            <i class="fa fa-user-plus"></i>
            <div class="counter" data-target="100">0</div>
            <small>Experts</small>
         </div>
         <div class="col-md-2 col-sm-4 stats-box">
            <i class="fa fa-globe"></i>
            <div class="counter" data-target="100">0</div>
            <small>Countries</small>
         </div>
         <div class="col-md-2 col-sm-4 stats-box">
            <i class="fa fa-smile-o"></i>
            <div class="counter" data-target="10000">0</div>
            <small>Happy Clients</small>
         </div>
         <div class="col-md-2 col-sm-4 stats-box">
            <i class="fa fa-star"></i>
            <div class="counter" data-target="10">0</div>
            <small>Years Experienced</small>
         </div>
      </div>
   </div>
</div>
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
               <a href="{{ route('service') }}">
                  <div class="industry-icon manymore"><i class="fa fa-plus"></i></div>
                  <div class="industry-title">
                     <p class="text-decoration-none">Many More</p>
                  </div>
               </a>
            </div>
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
                     {{ Str::limit(strip_tags($row->description), 100) }}
                  </div>
               </a>
            </div>
         </div>
         @endforeach
      </div>
   </div>
   <!-- .container -->
</div>
<!-- .page-section -->
<div class="page-section">
   <div class="container">
      <div class="row align-items-center">
         <div class="col-md-6 py-3">
            <div class="subhead">Portfolio</div>
            <h2 class="title-section">Our Latest Projects</h2>
         </div>
         <div class="col-md-6 py-3 text-md-right">
            <a href="{{ route('project') }}" class="btn btn-outline-primary">Browse Projects <span class="mai-arrow-forward ml-2"></span></a>
         </div>
      </div>
      <div class="row mt-3">
         @foreach($project as $row)
         <div class="col-lg-4 py-3">
            <div class="portfolio">
               <a href="{{ asset('uploads/project-page/'.$row->image) }}" data-fancybox="portfolio">
               <img src="{{ asset('uploads/project-page/'.$row->image) }}" alt="">
               </a>
            </div>
         </div>
         @endforeach
      </div>
   </div>
   <!-- .container -->
</div>

<div class="page-section">
   <div class="container text-center py-5">
      <h2 class="section-title">Our <span style="color:#00b894;">Brands</span></h2>
      <p class="section-subtitle"></p>
      <div class="row">
         @foreach($brand as $row)
         <div class="col-12 col-md-3">
            <div class="industry-box">
               <div class="industry-icon"><img src="{{ asset('uploads/brand/'.$row->image) }}"></div>
               <div class="industry-title">{{ $row->brand_name }}</div>
            </div>
         </div>
         @endforeach
      </div>
   </div>
</div>


<div class="page-section">
   <div class="container text-center py-5">
      <h2 class="section-title"> <span style="color:#00b894;"></span></h2><br>
      <p class="section-subtitle"></p>
         <div class="row">
            @foreach($campaign as $row)
            @php
            $endTime = \Carbon\Carbon::parse($row->end_date);
            @endphp
            @if($endTime->isFuture()) {{-- show only if campaign is not over --}}
            <div class="col-md-4">
               <div class="deal-card">
                  <a href="{{ route('frontend.campaign.product', $row->id) }}">
                  <img src="{{ asset('uploads/campaign/'.$row->image) }}" class="product-img mb-3" alt="{{ $row->title }}">
                  </a>
                  <h5>{{ $row->title }}</h5>
                  <p class="price">
                     <span class="text-success">Discount</span>
                     <span class="old-price text-danger">{{ $row->discount }} %</span> 
                  </p>
                  <p class="countdown">Ends: {{ $endTime->toDayDateTimeString() }}</p>
               </div>
            </div>
            @endif
            @endforeach
            <div class="col-md-8">
               <ul class="nav nav-tabs mb-3" id="productTabs" role="tablist">
                  <li class="nav-item">
                     <a class="nav-link active" id="featured-tab" data-toggle="tab" href="#featured" role="tab">Featured</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" id="onsale-tab" data-toggle="tab" href="#todaydeal" role="tab">Today Deal</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" id="bestrated-tab" data-toggle="tab" href="#trendy" role="tab">Trendy</a>
                  </li>
               </ul>
               <div class="tab-content" id="productTabsContent">
                  <div class="tab-pane fade show active" id="featured" role="tabpanel">
                     <div class="row">
                        @foreach($featured as $row)
                        <div class="col-6 col-md-3">
                           <div class="product-card position-relative" style="background:#fff; box-shadow:0 0 10px rgba(0,123,255,.5);">
                              <div class="badge-discount">{{ $row->stock_quantity }}</div>
                              <span class="heart-icon"><i class="fa fa-heart"></i></span>
                              <img src="{{ asset('uploads/product/'.$row->thumbnail) }}" alt="{{ $row->name }}" class="img-fluid mb-2" />
                              @php
                              // Determine which price to show
                              $isCampaignActive = false;
                              if (!empty($row->campaign_price) && !empty($row->campaign_status) && $row->campaign_status == 1) {
                              // Check if campaign is within valid date range
                              $now = \Carbon\Carbon::now();
                              $start = \Carbon\Carbon::parse($row->start_date);
                              $end = \Carbon\Carbon::parse($row->end_date);
                              if ($now->between($start, $end)) {
                              $isCampaignActive = true;
                              }
                              }
                              @endphp
                              {{-- Campaign price first --}}
                              @if($isCampaignActive)
                              <h6 class="text-success product-price">
                                 {{ number_format($row->campaign_price, 2) }}
                                 <small class="old-price text-danger">{{ number_format($row->selling_price, 2) }}</small>
                                 <hr>
                                 <span class="btn-sm btn-sm btn-danger">Campaign</span>
                              </h6>
                              {{-- Then normal discount --}}
                              @elseif($row->discount_price)
                              <h6 class="text-dark product-price">
                                 {{ number_format($row->discount_price, 2) }}
                                 <small class="old-price text-danger">{{ number_format($row->selling_price, 2) }}</small>
                              </h6>
                              {{-- Finally, regular price --}}
                              @else
                              <h6 class="text-danger product-price">{{ number_format($row->selling_price, 2) }}</h6>
                              @endif
                              <a href="{{ route('product.details',$row->slug) }}">
                              <small class="text-dark text-decoration-none">{{ $row->name }}</small>
                              </a><br>
                              <a href="" class="quick_view text-dark" id="{{ $row->id }}" data-toggle="modal" data-target="#exampleModalCenter">Quick View</a><br>
                              <div class="d-flex justify-content-center my-2">
                                 <a href="{{ route('cart') }}">
                                 <button class="btn btn-sm btn-success"><small>Add to Cart</small></button>
                                 </a>
                              </div>
                           </div>
                        </div>
                        @endforeach
                     </div>
                  </div>
                  <!-- Other tab panes can be added here similarly -->
                  <div class="tab-pane fade show active" id="todaydeal" role="tabpanel">
                     <div class="row">
                        @foreach($todaydeal as $row)
                        <!-- Product 5 (highlighted) -->
                        <div class="col-6 col-md-3">
                           <div class="product-card position-relative" style="background:#fff; box-shadow:0 0 10px rgba(0,123,255,.5);">
                              <div class="badge-discount">{{ $row->stock_quantity }}</div>
                              <span class="heart-icon"><i class="fa fa-heart"></i></span>
                              <img src="{{ asset('uploads/product/'.$row->thumbnail) }}" alt="{{ $row->name }}" class="img-fluid mb-2" />
                              @php
                              // Determine which price to show
                              $isCampaignActive = false;
                              if (!empty($row->campaign_price) && !empty($row->campaign_status) && $row->campaign_status == 1) {
                              // Check if campaign is within valid date range
                              $now = \Carbon\Carbon::now();
                              $start = \Carbon\Carbon::parse($row->start_date);
                              $end = \Carbon\Carbon::parse($row->end_date);
                              if ($now->between($start, $end)) {
                              $isCampaignActive = true;
                              }
                              }
                              @endphp
                              {{-- Campaign price first --}}
                              @if($isCampaignActive)
                              <h6 class="text-success product-price">
                                 {{ number_format($row->campaign_price, 2) }}
                                 <small class="old-price text-danger">{{ number_format($row->selling_price, 2) }}</small><br>
                                 <span class="btn-sm btn-sm btn-danger">Campaign</span>
                              </h6>
                              {{-- Then normal discount --}}
                              @elseif($row->discount_price)
                              <h6 class="text-dark product-price">
                                 {{ number_format($row->discount_price, 2) }}
                                 <small class="old-price text-danger">{{ number_format($row->selling_price, 2) }}</small>
                              </h6>
                              {{-- Finally, regular price --}}
                              @else
                              <h6 class="text-danger product-price">{{ number_format($row->selling_price, 2) }}</h6>
                              @endif
                              <a href="{{ route('product.details',$row->slug) }}">
                              <small class="text-dark text-decoration-none">{{ $row->name }}</small>
                              </a><br>
                              <a href="" class="quick_view text-dark" id="{{ $row->id }}" data-toggle="modal" data-target="#exampleModalCenter">Quick View</a><br>
                              <div class="d-flex justify-content-center my-2">
                                 <a href="{{ route('cart') }}">
                                 <button class="btn btn-sm btn-success"><small>Add to Cart</small></button>
                                 </a>
                              </div>
                           </div>
                        </div>
                        @endforeach
                     </div>
                  </div>
                  <div class="tab-pane fade show active" id="trendy" role="tabpanel">
                     <div class="row">
                        @foreach($trendy as $row)
                        <!-- Product 5 (highlighted) -->
                        <div class="col-6 col-md-3">
                           <div class="product-card position-relative" style="background:#fff; box-shadow:0 0 10px rgba(0,123,255,.5);">
                              <div class="badge-discount">{{ $row->stock_quantity }}</div>
                              <span class="heart-icon"><i class="fa fa-heart"></i></span>
                              <img src="{{ asset('uploads/product/'.$row->thumbnail) }}" alt="{{ $row->name }}" class="img-fluid mb-2" />
                              @php
                              // Determine which price to show
                              $isCampaignActive = false;
                              if (!empty($row->campaign_price) && !empty($row->campaign_status) && $row->campaign_status == 1) {
                              // Check if campaign is within valid date range
                              $now = \Carbon\Carbon::now();
                              $start = \Carbon\Carbon::parse($row->start_date);
                              $end = \Carbon\Carbon::parse($row->end_date);
                              if ($now->between($start, $end)) {
                              $isCampaignActive = true;
                              }
                              }
                              @endphp
                              {{-- Campaign price first --}}
                              @if($isCampaignActive)
                              <h6 class="text-success product-price">
                                 {{ number_format($row->campaign_price, 2) }}
                                 <small class="old-price text-danger">{{ number_format($row->selling_price, 2) }}</small><br>
                                 <span class="btn-sm btn-sm btn-danger">Campaign</span>
                              </h6>
                              {{-- Then normal discount --}}
                              @elseif($row->discount_price)
                              <h6 class="text-dark product-price">
                                 {{ number_format($row->discount_price, 2) }}
                                 <small class="old-price text-danger">{{ number_format($row->selling_price, 2) }}</small>
                              </h6>
                              {{-- Finally, regular price --}}
                              @else
                              <h6 class="text-danger product-price">{{ number_format($row->selling_price, 2) }}</h6>
                              @endif
                              <a href="{{ route('product.details',$row->slug) }}">
                              <small class="text-dark text-decoration-none">{{ $row->name }}</small>
                              </a><br>
                              <a href="" class="quick_view text-dark" id="{{ $row->id }}" data-toggle="modal" data-target="#exampleModalCenter">Quick View</a><br>
                              <div class="d-flex justify-content-center my-2">
                                 <a href="{{ route('cart') }}">
                                 <button class="btn btn-sm btn-success"><small>Add to Cart</small></button>
                                 </a>
                              </div>
                           </div>
                        </div>
                        @endforeach
                     </div>
                  </div>
               </div>
            </div>
         </div>
   </div>
</div>


<div class="page-section">
   <div class="container">
      <div class="text-center">
         <div class="subhead">News</div>
         <h2 class="title-section">Read Our Latest News</h2>
      </div>

      <div class="row my-5 card-blog-row">
         @foreach($blog->take(4) as $row) {{-- show only 4 posts --}}
         <div class="col-lg-3 py-3">
            <div class="card-blog">
               <div class="header">
                  <div class="avatar">
                     <img src="{{ asset('uploads/post/'.$row->image) }}" alt="">
                  </div>
                  <div class="entry-footer">
                     <div class="post-author">
                        @if($row->user_id == 0)
                           Admin
                        @endif
                     </div>
                     <a class="post-date">{{ date('d F, Y', strtotime($row->date)) }}</a>
                  </div>
               </div>

               <div class="body">
                  <div class="post-title">
                     <a href="{{ route('blog-single.page', $row->slug) }}" class="text-decoration-none">
                        {{ Str::limit(strip_tags($row->title), 23) }}
                     </a>
                  </div>
                  <div class="post-excerpt">
                     {{ Str::limit(strip_tags($row->details), 80) }}
                  </div>
               </div>

               <div class="footer">
                  <a href="{{ route('blog-single.page', $row->slug) }}" class="text-decoration-none">
                     Read More <span class="mai-chevron-forward text-sm"></span>
                  </a>
               </div>
            </div>
         </div>
         @endforeach
      </div>

      <div class="text-center">
         <a href="{{ route('news') }}" class="btn btn-primary text-decoration-none">View More</a>
      </div>
   </div>
</div>

<!-- .page-section -->
@endsection
