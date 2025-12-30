@extends('layouts.app')
@section('content')
@php

$review_5 = DB::table('reviews')->where('product_id', $product->id)->where('rating', 5)->count();
$review_4 = DB::table('reviews')->where('product_id', $product->id)->where('rating', 4)->count();
$review_3 = DB::table('reviews')->where('product_id', $product->id)->where('rating', 3)->count();
$review_2 = DB::table('reviews')->where('product_id', $product->id)->where('rating', 2)->count();
$review_1 = DB::table('reviews')->where('product_id', $product->id)->where('rating', 1)->count();

$sum_rating = DB::table('reviews')->where('product_id', $product->id)->sum('rating');
$count_rating = DB::table('reviews')->where('product_id', $product->id)->count('rating');
@endphp

<div class="single_product py-4">
  <div class="container">
    <div class="row">

      @php
        $images = json_decode($product->images, true);
        $color = explode(',', $product->color);
        $sizes = explode(',', $product->size);
      @endphp

      <!-- Thumbnails -->
      <div class="col-12 col-md-2 mb-3 order-2 order-md-1">
        <ul class="image_list list-unstyled">
          @isset($images)
            @foreach($images as $image)
              <li data-image="{{ asset('uploads/product/'.$image) }}" class="mb-2">
                <img src="{{ asset('uploads/product/'.$image) }}" class="img-fluid border" alt="">
              </li>
            @endforeach
          @endisset
        </ul>
      </div>

      <!-- Main Image -->
      <div class="col-12 col-md-5 mb-3 order-1 order-md-2">
        <div class="image_selected">
          <a href="">
          <img src="{{ asset('uploads/product/'.$product->thumbnail) }}" class="img-fluid border" alt="">
          </a>
        </div>
      </div>

      <!-- Product Description -->
      <div class="col-12 col-md-5 order-3">
        <div class="product_description">
          <div class="product_category mb-2">
            <strong class="text-success">Brand: {{ $product->brand_name ?? $product->brand->brand_name ?? 'N/A' }}</strong>
          </div>
          <div class="product_category mb-2 text-primary">
            {{ $product->category_name ?? $product->category->name ?? 'N/A' }} / 
            {{ $product->subcategory_name ?? $product->subcategory->subcategory_name ?? 'N/A' }}
          </div>
          <h4 class="product_name">{{ $product->name }}</h4>

          <!-- Static Stars (replace with actual rating if needed) -->
          <div class="rating_r rating_r_4 product_rating mb-2">
            <i></i><i></i><i></i><i></i><i></i>
          </div>

          <div class="product_text mb-3">
            <p>{!! $product->description !!}</p>
          </div>

          <!-- Add to Cart Form -->
          <form action="{{ route('add.to.cart.quickview') }}" method="post" id="add_to_cart">
            @csrf
            <input type="hidden" name="id" value="{{ $product->id }}">
            <div class="form-row">

              <div class="form-group col-6 col-md-4">
                <label>Quantity</label>
                <input id="quantity_input" type="number" class="form-control" name="qty" value="1" min="1" pattern="[1-9]*">
              </div>

              @if(!empty($product->color))
              <div class="form-group col-6 col-md-4">
                <label>Color</label>
                <select class="form-control" name="color">
                  @foreach($color as $row)
                    <option value="{{ $row }}">{{ $row }}</option>
                  @endforeach
                </select>
              </div>
              @endif

              @if(!empty($product->size))
              <div class="form-group col-12 col-md-4">
                <label>Size</label>
                <select class="form-control" name="size">
                  @foreach($sizes as $size)
                    <option value="{{ $size }}">{{ $size }}</option>
                  @endforeach
                </select>
              </div>
              @endif

            </div>


@php
$now = \Carbon\Carbon::now();
$isCampaignActive = false;

if (!empty($product->campaign_price) && !empty($product->campaign_status) && $product->campaign_status == 1) {
    $start = \Carbon\Carbon::parse($product->start_date);
    $end = \Carbon\Carbon::parse($product->end_date);
    if ($now->between($start, $end)) {
        $isCampaignActive = true;
    }
}
@endphp

<div class="product_price h5">
    @if($isCampaignActive)
        <span class="text-success">{{ number_format($product->campaign_price, 2) }}</span>
        <small class="text-muted"><del class="text-danger">{{ number_format($product->selling_price, 2) }}</del></small>
    @elseif(!empty($product->discount_price))
        <span class="text-primary">{{ number_format($product->discount_price, 2) }}</span>
        <small class="text-muted"><del class="text-danger">{{ number_format($product->selling_price, 2) }}</del></small>
    @else
        <span>{{ number_format($product->selling_price, 2) }}</span>
    @endif
</div>

            <div class="button_container mt-3 d-flex flex-wrap gap-2">              
              @if($product->stock_quantity<1)
              <button class="btn btn-outline-danger" disabled="">Stock Out</button>
              @else
              <a class="btn btn-success btn-sm" href="{{ route('cart') }}" role="button" style="margin-right: 10px;"> <i class="fa fa-shopping-cart"></i> Add to cart</a>
              @endif
              <a class="btn btn-info btn-sm" href="{{ route('add.wishlist', $product->id) }}" role="button"> <i class="fa fa-shopping-cart"></i> Add to wishlist</a>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>

<div class="container my-5">
  <div class="row mb-4">
    <div class="col-12 col-md-3 mb-3">
      <img src="{{ asset('uploads/product/' . $product->thumbnail) }}" class="img-fluid" alt="{{ $product->name }}">
    </div>
    <div class="col-12 col-md-9">
      <h3>{{ $product->name }}</h3>
      <p>Product Code: <strong>{{ $product->code }}</strong></p>

      @php
        $average = $count_rating > 0 ? round($sum_rating / $count_rating, 1) : 0;
        $rounded = floor($average);
      @endphp

      <div class="mb-2">
        @for ($i = 1; $i <= 5; $i++)
          <span class="fa fa-star {{ $i <= $rounded ? 'text-warning' : 'text-muted' }}"></span>
        @endfor
        <small class="ml-2">({{ $count_rating }} reviews, Avg: {{ $average }}/5)</small>
      </div>

      <p>{!! $product->short_description ?? '' !!}</p>
    </div>
  </div>

  <div class="row mb-5">
    <div class="col-12 col-md-8">
      <h4>Write a Review</h4>
      <form action="{{ route('store.review') }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">

        <div class="form-group">
          <label for="review">Your Review</label>
          <textarea name="review" rows="4" class="form-control" required></textarea>
        </div>

        <div class="form-group">
          <label for="rating">Rating</label>
          <select class="form-control w-6
          0" name="rating" required>
            <option disabled selected>Select Rating</option>
            <option value="5">5 - Excellent</option>
            <option value="4">4 - Good</option>
            <option value="3">3 - Average</option>
            <option value="2">2 - Poor</option>
            <option value="1">1 - Terrible</option>
          </select>
        </div>

        @if(Auth::check())
          <button type="submit" class="btn btn-primary">Submit Review</button>
        @else
          <p class="text-danger">You must <a href="{{ route('login') }}">log in</a> to submit a review.</p>
        @endif
      </form>
    </div>
  </div>

  <!-- Customer Reviews -->
<div class="container my-5">
  <div class="row">
    <div class="col-12">
      <h4 class="mb-4">Customer Reviews ({{ $review->count() }})</h4>

      @if($review->isEmpty())
        <p>No reviews yet for this product.</p>
      @else
        @foreach($review as $r)
          <div class="card mb-3 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
              <strong>{{ $r->user_name }}</strong>
              <span class="text-muted small">{{ date('d M, Y', strtotime($r->review_date)) }}</span>
            </div>
            <div class="card-body">
              <!-- Star Rating -->
              <div class="mb-2">
                @for($i = 1; $i <= 5; $i++)
                  <span class="fa fa-star {{ $i <= $r->rating ? 'text-warning' : 'text-muted' }}"></span>
                @endfor
              </div>
              <p class="mb-0">{{ $r->review }}</p>
            </div>
          </div>
        @endforeach
      @endif
    </div>
  </div>
</div>


</div>


<div class="container mt-5">
   <h4><strong>Related Product</strong></h4>
   <div class="row mt-4 owl-carousel hero-carousel">
      @foreach($related_product as $row)
      <!-- Product -->
      <div class="col-md-2 col-sm-6 mb-4">
         <div class="product-card">
            <div class="badge-new">New</div>
            <a href="{{ route('product.details',$row->slug) }}">
              <img src="{{ asset('uploads/product/'.$row->thumbnail) }}" alt="Huawei MediaPad" class="img-fluid mb-2">
            </a>
            @if($row->discount_price==NULL)
            <h5 class="text-dark font-weight-bold">{{ $row->selling_price }}</h5>
            @else
            <h5 class="text-dark font-weight-bold">{{ $row->discount_price }}</h5>
            @endif
            <a href="{{ route('product.details',$row->slug) }}">
               <p class="text-muted small mb-0">{{ substr($row->name, 0, 50) }}</p>
            </a>
         </div>
      </div>
      @endforeach
   </div>
</div>

<script type="text/javascript">
   //store coupon ajax call
   $('#add_cart_form').submit(function(e){
     e.preventDefault();
     $('.loading').removeClass('d-none');
     var url = $(this).attr('action');
     var request =$(this).serialize();
     $.ajax({
       url:url,
       type:'post',
       async:false,
       data:request,
       success:function(data){
         toastr.success(data);
         $('#add_cart_form')[0].reset();
         $('.loading').addClass('d-none');
         cart();
       }
     });
   });
</script>



@endsection
