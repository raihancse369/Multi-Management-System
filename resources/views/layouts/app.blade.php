@php
  $seo = DB::table('seos')->first();
  $data = DB::table('footers')->get();
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="copyright" content="">

  <!-- CSRF Token -->

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <meta name="author" content="{{ $seo->meta_author }}">
  <meta name="keyword" content="{{ $seo->meta_keyword }}">
  <meta name="description" content="{{ $seo->meta_description }}">

  <title>{{ $seo->meta_title }}</title>

  <link rel="stylesheet" href="{{ asset('web') }}/assets/css/bootstrap.css">
  
  <link rel="stylesheet" href="{{ asset('web') }}/assets/css/maicons.css">

  <link rel="stylesheet" href="{{ asset('web') }}/assets/vendor/animate/animate.css">

  <link rel="stylesheet" href="{{ asset('web') }}/assets/vendor/owl-carousel/css/owl.carousel.css">

  <link rel="stylesheet" href="{{ asset('web') }}/assets/vendor/fancybox/css/jquery.fancybox.css">

  <link rel="stylesheet" href="{{ asset('web') }}/assets/css/theme.css">
  <link rel="stylesheet" href="{{ asset('web') }}/assets/css/toastr.min.css">

  <!-- Font Icons -->
  <link href="{{ asset('admin') }}/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" />

</head>
<body>

  <!-- Back to top button -->
  <div class="back-to-top"></div>

  <header>

@include('layouts.frontend_partial.topbar')
@include('layouts.frontend_partial.navbar')


  </header>

  <main>
@yield('content')

  </main>

    @php 
        $pages_one=DB::table('pages')->where('page_position',1)->get();
        $pages_two=DB::table('pages')->where('page_position',2)->get();
        $show=DB::table('sites')->get();
    @endphp

  <footer class="page-footer">
    <div class="container">
      <div class="row">
        @foreach($data as $row)
        <div class="col-lg-4 py-4">
          <h3>
            <img src="{{ asset('uploads/footer/'.$row->image) }}" name="old_photo" style="height: 60px; width: 90px;">
          </h3><br>
          <p style="width: 285px;">{{ $row->footer_title }}</p>
        </div>
        <div class="col-lg-4 py-4">
          <h5>Contact Information</h5>
          <p>{{ $row->address }}</p><br>
          <p>{{ $row->address_two }}</p><br><br>
          <p>Email</p>
          <p>{{ $row->email }}</p>
          <p>{{ $row->phone }}</p>
        </div>
        @endforeach


        <div class="col-lg-2 py-2">
          <h5>Useful Links</h5>
          <ul class="footer-menu">
            @foreach($pages_one as $row)
            <li><a href="{{ route('view.page',$row->page_slug) }}" class="text-decoration-none">{{ $row->page_name }}</a></li>
            @endforeach
          </ul>
        </div>

        <div class="col-lg-2 py-2">
          <h5>Pages</h5>
          <ul class="footer-menu">
            @foreach($pages_two as $row)
            <li><a href="{{ route('view.page',$row->page_slug) }}" class="text-decoration-none">{{ $row->page_name }}</a></li>
            @endforeach
          </ul>
        </div>

      </div>

      <hr>
      <div class="row mt-4">
        @foreach($data as $row)
        <div class="col-md-6">
          <p>Copyright {{ date('Y') }}. {{ $row->copyright_text }} </p>
          <p style="width: 285px;">{{ $row->disclaimer }} </p>
        </div>
        @endforeach

        @foreach($show as $row)
        <div class="col-md-6 text-right">
          <div class="sosmed-button">
            <a href="{{ $row->facebook }}"><span class="mai-logo-facebook-f"></span></a>
            <a href="{{ $row->twitter }}"><span class="mai-logo-twitter"></span></a>
            <a href="{{ $row->youtube }}"><span class="mai-logo-youtube"></span></a>
            <a href="{{ $row->linkedin }}"><span class="mai-logo-linkedin"></span></a>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </footer>
  
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog  modal-lg  modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="quick_view_body">
   
      </div>
    </div>
  </div>
</div>

<script src="{{ asset('web') }}/assets/js/jquery-3.5.1.min.js"></script>

<script src="{{ asset('web') }}/assets/js/bootstrap.bundle.min.js"></script>

<script src="{{ asset('web') }}/assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>

<script src="{{ asset('web') }}/assets/vendor/wow/wow.min.js"></script>

<script src="{{ asset('web') }}/assets/vendor/fancybox/js/jquery.fancybox.min.js"></script>

<script src="{{ asset('web') }}/assets/vendor/isotope/isotope.pkgd.min.js"></script>

<script src="{{ asset('web') }}/assets/js/google-maps.js"></script>

<script src="{{ asset('web') }}/assets/js/theme.js"></script>

<!-- Count-up Script -->
<script>
  const counters = document.querySelectorAll('.counter');
  const speed = 100; // lower = faster

  counters.forEach(counter => {
    const updateCount = () => {
      const target = +counter.getAttribute('data-target');
      const count = +counter.innerText.replace('+', '');

      const increment = target / speed;

      if (count < target) {
        counter.innerText = Math.ceil(count + increment);
        setTimeout(updateCount, 10);
      } else {
        counter.innerText = target.toLocaleString() + '+';
      }
    };

    updateCount();
  });
</script>


<script>
    // Set the countdown target time (YYYY-MM-DD HH:MM:SS format)
    var countdownDate = new Date("2025-09-15T23:59:59").getTime();

    // Update the countdown every second
    var countdownFunction = setInterval(function () {
        var now = new Date().getTime();
        var distance = countdownDate - now;

        // Time calculations
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display result
        document.getElementById("dealCountdown").innerHTML =
            "Time Left: " + days + "d " + hours + "h "
            + minutes + "m " + seconds + "s";

        // If the countdown is finished
        if (distance < 0) {
            clearInterval(countdownFunction);
            document.getElementById("dealCountdown").innerHTML = "Deal Expired";
        }
    }, 1000);
</script>



<script src="{{ asset('web') }}/assets/js/toastr.min.js"></script>

<script>
    @if(Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}";
        switch(type){
            case 'info':
                toastr.info("{{ Session::get('message') }}");
                break;

            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;

            case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;

            case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
        }
    @endif
</script>


 <script type="text/javascript" charset="utf-8">
    function cart() {
         $.ajax({
            type:'get',
            url:'{{ route('all.cart') }}', 
            dataType: 'json',
            success:function(data){
               $('.cart_qty').empty();
               $('.cart_total').empty();
               $('.cart_qty').append(data.cart_qty);
               $('.cart_total').append(data.cart_total);
            }
        });
    }
    $(document).ready(function(event) {
        cart();
    });
    
 </script>

<script type="text/javascript">
  //ajax request send for collect childcategory
  $(document).on('click', '.quick_view', function(){ 
    var id = $(this).attr("id");
    $.ajax({
    url: "{{ url("/product-quick-view/") }}/"+id,
    type: 'get',
    success: function(data) {
    $("#quick_view_body").html(data);
      }
    });
  });

  //store coupon ajax call
  $('#newsletter_form').submit(function(e){
    e.preventDefault();
    var url = $(this).attr('action');
    var request =$(this).serialize();
    $.ajax({
      url:url,
      type:'post',
      async:false,
      data:request,
      success:function(data){
        toastr.success(data);
      $('#newsletter_form')[0].reset();
      }
    });
  });
</script>


</body>
</html>