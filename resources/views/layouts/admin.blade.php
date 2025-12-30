<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="images/favicon_1.ico">
        
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">  
         
        <title>@yield('title')</title>

        <!-- toastr alerts -->
        <link href="{{ asset('admin') }}/css/toastr.min.css" rel="stylesheet">

        <!-- Base Css Files -->
        <link href="{{ asset('admin') }}/css/bootstrap.min.css" rel="stylesheet" />

        <!-- Font Icons -->
        <link href="{{ asset('admin') }}/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" />

        <!-- animate css -->
        <link href="{{ asset('admin') }}/css/animate.css" rel="stylesheet" />

        <!-- Waves-effect -->
        <link href="{{ asset('admin') }}/css/waves-effect.css" rel="stylesheet">

        <!-- sweet alerts -->
        <link href="{{ asset('admin') }}/assets/sweet-alert/sweet-alert.min.css" rel="stylesheet">

        <!-- Custom Files -->
        <link href="{{ asset('admin') }}/css/helper.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin') }}/css/style.css" rel="stylesheet" type="text/css" />

        <!-- DataTables -->
        <link href="{{ asset('admin') }}/assets/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
        
        <link href="{{ asset('admin') }}/assets/summernote/summernote.css" rel="stylesheet" />



        <script src="{{ asset('admin') }}/assets/chart.js"></script>
        
    </head>



    <body class="fixed-left">

@guest

@else
        
        <!-- Begin page -->
        <div id="wrapper">
        
@include('layouts.admin_partial.topbar')

@include('layouts.admin_partial.sidebar')

@endguest




@yield('admin_content')


        </div>
        <!-- END wrapper -->


    
        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="{{ asset('admin') }}/js/jquery.min.js"></script>
        <script src="{{ asset('admin') }}/js/bootstrap.min.js"></script>
        <script src="{{ asset('admin') }}/js/waves.js"></script>
        <script src="{{ asset('admin') }}/js/wow.min.js"></script>
        <script src="{{ asset('admin') }}/js/jquery.nicescroll.js" type="text/javascript"></script>
        <script src="{{ asset('admin') }}/js/jquery.scrollTo.min.js"></script>
        <script src="{{ asset('admin') }}/assets/chat/moment-2.2.1.js"></script>
        <script src="{{ asset('admin') }}/assets/jquery-sparkline/jquery.sparkline.min.js"></script>
        <script src="{{ asset('admin') }}/assets/jquery-detectmobile/detect.js"></script>
        <script src="{{ asset('admin') }}/assets/fastclick/fastclick.js"></script>
        <script src="{{ asset('admin') }}/assets/jquery-slimscroll/jquery.slimscroll.js"></script>
        <script src="{{ asset('admin') }}/assets/jquery-blockui/jquery.blockUI.js"></script>

        <!-- sweet alerts -->
        <script src="{{ asset('admin') }}/assets/sweet-alert/sweet-alert.min.js"></script>
        <script src="{{ asset('admin') }}/assets/sweet-alert/sweet-alert.init.js"></script>


        <!-- Counter-up -->
        <script src="{{ asset('admin') }}/assets/counterup/waypoints.min.js" type="text/javascript"></script>
        <script src="{{ asset('admin') }}/assets/counterup/jquery.counterup.min.js" type="text/javascript"></script>
        
        <!-- CUSTOM JS -->
        <script src="{{ asset('admin') }}/js/jquery.app.js"></script>

        <!-- Chat -->
        <script src="{{ asset('admin') }}/js/jquery.chat.js"></script>

        <!-- Todo -->
        <script src="{{ asset('admin') }}/js/jquery.todo.js"></script>

        <script type="text/javascript">
            /* ==============================================
            Counter Up
            =============================================== */
            jQuery(document).ready(function($) {
                $('.counter').counterUp({
                    delay: 100,
                    time: 1200
                });
            });
        </script>

        <!-- Custom Toastr JS File -->
        <script src="{{ asset('admin') }}/js/sweetalert.min.js"></script>

        <script>
          $(document).on("click", "#delete", function(e){
            e.preventDefault();
            var link = $(this).attr("href");
              swal({
                title: "Are you want to delete ?",
                text: "Once Delete, This will be Permanently Delete !",
                icon: "warning",
                buttons: true,
                dangerMode: true,
              })
              .then((willDelete) => {
                if(willDelete) {
                  window.location.href = link;
                }else {
                  //swal("Safe Data !");
                }
              });
          });
        </script>
        
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

        <script src="{{ asset('admin') }}/assets/datatables/jquery.dataTables.min.js"></script>
        <script src="{{ asset('admin') }}/assets/datatables/dataTables.bootstrap.js"></script>
        
        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').dataTable();
            } );
        </script>

        <!-- Date Method Jquery -->        
        <script type="text/javascript">
            function dateDiffInDays(date1, date2) {
                // round to the nearest whole number
                return Math.round((date2-date1)/(1000*60*60*24));
            }

            $(document).ready(function(){
                $('.enddate').on('change', function(e){
                    var date1=$('.startdate').val();
                    var date2=$('.enddate').val();
                    var daysDiff=dateDiffInDays(new Date(date1), new Date(date2));
                    var totaldays=daysDiff+1;
                    $('.num_of_days').val(totaldays);
                });

                $('.startdate').on('change', function(e){
                    var date1=$('.startdate').val();
                    var date2=$('.enddate').val();
                    var daysDiff=dateDiffInDays(new Date(date1), new Date(date2));
                    var totaldays=daysDiff+1;
                    $('.num_of_days').val(totaldays);
                });
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#summernote').summernote({
                    height: 200,
                    minHeight: null,
                    maxHeight: null,
                    focus: true
                });
            });
        </script>

        <script src="{{ asset('admin') }}/assets/summernote/summernote.min.js"></script>
    
    </body>
</html>