<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Raihan">

        <link rel="shortcut icon" href="images/favicon_1.ico">

        <title>@yield('title')</title>

        <!-- Base Css Files -->
        <link href="{{ asset('admin') }}/css/bootstrap.min.css" rel="stylesheet" />

        <!-- toastr alerts -->
        <link href="{{ asset('admin') }}/css/toastr.min.css" rel="stylesheet">

        <!-- Font Icons -->
        <link href="{{ asset('admin') }}/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
        <link href="{{ asset('admin') }}/assets/ionicon/css/ionicons.min.css" rel="stylesheet" />
        <link href="{{ asset('admin') }}/css/material-design-iconic-font.min.css" rel="stylesheet">

        <!-- animate css -->
        <link href="{{ asset('admin') }}/css/animate.css" rel="stylesheet" />

        <!-- Waves-effect -->
        <link href="{{ asset('admin') }}/css/waves-effect.css" rel="stylesheet">

        <!-- Custom Files -->
        <link href="{{ asset('admin') }}/css/helper.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin') }}/css/style.css" rel="stylesheet" type="text/css" />

        <script src="{{ asset('admin') }}/js/modernizr.min.js"></script>
        
    </head>
    <body>


        <div class="wrapper-page">
            <div class="panel panel-color panel-primary panel-pages">
                <div class="panel-heading bg-img"> 
                    <div class="bg-overlay"></div>
                    <h3 class="text-center m-t-10 text-white"> Admin Login <strong>Panel</strong> </h3>
                </div> 


                <div class="panel-body">
                    <form class="form-horizontal m-t-20" action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control input-lg @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="email">
                            </div>
                        </div>

                        @if (session('error'))
                          <strong style="color: red;">  {{ session('error') }} </strong>
                        @endif
                        
                        @error('email')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror

                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control input-lg @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="current-password" placeholder="password">
                            </div>
                        </div>

                        @error('password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror

                        <div class="form-group ">
                            <div class="col-xs-12">
                                <div class="checkbox checkbox-primary">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label for="checkbox-signup">
                                        Remember me
                                    </label>
                                </div>
                                
                            </div>
                        </div>
                        
                        <div class="form-group text-center m-t-40">
                            <div class="col-xs-12">
                                <button class="btn btn-primary btn-lg w-lg waves-effect waves-light" type="submit">Sign In</button>
                            </div>
                        </div>

                        <div class="form-group m-t-30">
                            <div class="col-sm-7">
                                <a href="{{ route('password.request') }}"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
                            </div>

                        </div>
                    </form> 
                </div>                                 
                
            </div>
        </div>

        
        <script>
            var resizefunc = [];
        </script>
        <script src="{{ asset('admin') }}/js/jquery.min.js"></script>
        <script src="{{ asset('admin') }}/js/bootstrap.min.js"></script>
        <script src="{{ asset('admin') }}/js/waves.js"></script>
        <script src="{{ asset('admin') }}/js/wow.min.js"></script>
        <script src="{{ asset('admin') }}/js/jquery.nicescroll.js" type="text/javascript"></script>
        <script src="{{ asset('admin') }}/js/jquery.scrollTo.min.js"></script>
        <script src="{{ asset('admin') }}/assets/jquery-detectmobile/detect.js"></script>
        <script src="{{ asset('admin') }}/assets/fastclick/fastclick.js"></script>
        <script src="{{ asset('admin') }}/assets/jquery-slimscroll/jquery.slimscroll.js"></script>
        <script src="{{ asset('admin') }}/assets/jquery-blockui/jquery.blockUI.js"></script>

        <!-- CUSTOM JS -->
        <script src="{{ asset('admin') }}/js/jquery.app.js"></script>

        <!-- Custom Toastr JS File -->
        <script src="{{ asset('admin') }}/js/toastr.min.js"></script>

        <script>
          @if(Session::has('message'))
            var type="{{Session::get('alert-type','info')}}"
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

        <!-- End Toastr JS File -->
    
    
    </body>
</html>
