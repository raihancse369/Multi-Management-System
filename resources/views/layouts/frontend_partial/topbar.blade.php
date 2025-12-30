@php
  $show=DB::table('sites')->get();
  $wishlist=DB::table('wishlists')->where('user_id',Auth::id())->count();
@endphp

@foreach($show as $row)

<div class="top-bar">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-7">
        <div class="d-inline-block">
          <span class="mai-mail fg-primary"></span> <a href="mailto:contact@mail.com">{{ $row->email }}</a>
        </div>
        <div class="d-inline-block ml-2">
          <span class="mai-call fg-primary"></span> <a href="">{{ $row->phone }}</a>
        </div>
      </div>
      <div class="col-md-5 text-right d-none d-md-block">
        <div class="social-mini-button">
          <a href="{{ $row->facebook }}"><span class="mai-logo-facebook-f"></span></a>
          <a href="{{ $row->twitter }}"><span class="mai-logo-twitter"></span></a>
          <a href="{{ $row->youtube }}"><span class="mai-logo-youtube"></span></a>
          <a href="{{ $row->linkedin }}"><span class="mai-logo-linkedin"></span></a>
          <a href="{{ route('wishlist') }}" class="">
            <i class="fa fa-heart"> <small class="wishlist_count">{{ $wishlist }}</small></i> Wishlist
          </a>

          <a href="{{ route('cart') }}" class="cart_count">
            <i class="fa fa-shopping-cart"> <small class="cart_qty"></small> Cart</i> 
          </a>

        </div>

      </div>


    </div>
  </div> <!-- .container -->
</div> <!-- .top-bar -->


@endforeach