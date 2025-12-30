@extends('layouts.admin')
@section('admin_content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <ol class="breadcrumb pull-right">
                            <li class="active"><a href="{{ route('order.index') }}">All Order List</a></li>

                        </ol>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">

                            <div class="panel-heading">
                                <div class="row">

                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <select class="form-control submitable" name="payment_type" id="payment_type">
                                            <option value="">All</option>
                                            <option value="Hand Cash">Hand Cash</option>
                                            <option value="Aamarpay">Aamarpay</option>
                                            <option value="Paypal">Paypal</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <select class="form-control submitable" name="status" id="status">
                                        <option value="">All</option>
                                            <option value="0">Pending</option>
                                            <option value="1">Completed</option>
                                            <option value="2">Shipped</option>
                                            <option value="3">Recieved</option>
                                            <option value="4">Return</option>
                                            <option value="5">Cancel</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <input type="date" class="form-control submitable" name="date" id="date">
                                    </div>

                                </div>
                            </div>
                            
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <table class="table table-striped table-bordered dataTable">
                                            <thead>
                                                <tr role="row">
                                                    <th># SL</th>
                                                    <th>Name</th>
                                                    <th>Phone</th>
                                                    <th>Email</th>
                                                    <th>Total</th>
                                                    <th>Discount</th>
                                                    <th>Payment Type</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>                                             
                                            <tbody>
                                                <tr role="row" class="odd">
                                                </tr>
                                            </tbody>
                                        </table>
                                        <form id="delete_form" action="" method="post">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div> <!-- End Row -->


            </div> <!-- container -->
                       
        </div> <!-- content -->





        <!-- sample modal content -->
        <div id="editModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">View Order Details</h5>
                    </div>
                    
                    <div class="modal-body" id="edit_part">

                    </div>
                    
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <footer class="footer text-right">
            {{ date('Y') }} © R@ih@n
        </footer>

    </div>

    <script src="{{ asset('admin') }}/js/jquery.min.js"></script>

    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#image')
                    .attr('src',e.target.result)
                    .width(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script type="text/javascript">

        //Datatable data show
        $(function category(){
          table =$('.dataTable').dataTable({
            "processing":true,
            "serverSide":true,
            "search":true,
            
            "ajax":{
                "url": "{{ route('order.index') }}", 
                "data":function(e) { 
                  e.payment_type =$("#payment_type").val();
                  e.status =$("#status").val();
                  e.date =$("#date").val();
                }
            },

            columns:[
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false }, // Disable ordering here
                { data:'c_name', name:'c_name'},
                { data:'c_phone', name:'c_phone'},
                { data:'c_email', name:'c_email'},
                { data:'subtotal', name:'subtotal'},
                { data:'after_discount', name:'after_discount'},
                //{ data:'total', name:'total'},
                { data:'payment_type', name:'payment_type'},
                { data:'date', name:'date'},
                { data:'status', name:'status'},
                { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });

        });


        //edit request send
        $('body').on('click','.edit',function(){
          var id = $(this).data('id');
          var url = "{{ url('admin/order/edit') }}/"+id;
          $.ajax({
            url:url,
            type:'get',
            success:function(data){
              $('#edit_part').html(data);
            }
          });
        });

        //Delete Specific Category
        $(document).ready(function(){
          $(document).on('click','#delete_order',function(e){
            e.preventDefault();
            var url = $(this).attr('href');
            $("#delete_form").attr('action',url);
            swal({
              title: "Are you sure ?",
              text: "Once deleted, you will not be able to recover this imaginary file !",
              icon: 'warning',
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if(willDelete) {
                $("#delete_form").submit();
              }else{
                //swal("Your imaginary file is safe !")
              }
            });
          });

          //Data passed throung here
          $('#delete_form').submit(function(e){
            e.preventDefault();
            var url = $(this).attr('action');
            var request = $(this).serialize();
            $.ajax({
              url:url,
              tye: 'post',
              async:false,
              data:request,
              success:function(data){
                toastr.success(data);
                  $('#delete_form')[0].reset();
                  $('.dataTable').DataTable().ajax.reload();
                }

              });
          });

        });

        //submitable class call for every change
        
        $(document).on('change','.submitable', function(){
            $('.dataTable').DataTable().ajax.reload();
        });


    </script>

@endsection