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
                            <li class="active"><a href="{{ route('ticket.index') }}">Ticket List</a></li>
                            <li><a href="{{ route('coupon.index') }}">Coupon</a></li>
                            <li><a href="{{ route('campaign.index') }}">Campaign</a></li>
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
                                        <select class="form-control submitable" name="type" id="type">
                                            <option value="">All</option>
                                            <option value="Technical">Technical</option>
                                            <option value="Payment">Payment</option>
                                            <option value="Affiliate">Affiliate</option>
                                            <option value="Return">Return</option>
                                            <option value="Refund">Refund</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <select class="form-control submitable" name="status" id="status">
                                        <option value="">All</option>
                                            <option value="0">Pending</option>
                                            <option value="1">Replied</option>
                                            <option value="2">Closed</option>
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
                                                    <th>User</th>
                                                    <th>Subject</th>
                                                    <th>Service</th>
                                                    <th>Priority</th>
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



        <div id="con-close-modal" id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog"> 
                <div class="modal-content"> 
                    <div class="modal-header"> 
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                        <div class="modal-title">Reply Ticket Message</div> 
                    </div> 
                    <div class="modal-body"> 
                        <form action="{{ route('admin.store.reply') }}" method="post" id="add_form" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-md-6"> 
                                    <div class="form-group"> 
                                        <label for="field-3" class="control-label">Brand Name</label> 
                                        <input type="text" name="brand_name" class="form-control @error('brand_name')is-invalid @enderror" id="brand_name" placeholder="Enter Brand Name">
                                        @error('brand_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div> 
                                </div>

                                <div class="col-md-6"> 
                                    <div class="form-group"> 
                                        <label for="status">Show Frontend Page<span class="text-danger"> * </span></label> 
                                            <select class="form-control" name="status">
                                                <option value="Yes"><span>Yes</span></option>
                                                <option value="No">No</option>
                                            </select> 
                                    </div> 
                                </div>  


                            </div>

                            <div class="form-group">
                                <label for="field-3" class="control-label">Brand Logo</label><br>
                                <input type="file" name="image" class="form-control" accept="image/*" onchange="readURL(this);"><br>
                                <img id="image" src="#" />
                            </div>

                            <div class="modal-footer"> 
                                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button> 
                                <button type="submit" class="btn btn-primary waves-effect waves-light"><span class="loading d-none"> </span>Submit</button> 
                            </div> 
                        </form> 
                    </div> 
                </div> 
            </div>
        </div><!-- /.modal -->


        <!-- sample modal content -->
        <div id="editModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Replay Ticket Message</h5>
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
                "url": "{{ route('ticket.index') }}", 
                "data":function(e) { 
                  e.type =$("#type").val();
                  e.status =$("#status").val();
                  e.date =$("#date").val();
                }
            },

            columns:[
                { data:'DT_RowIndex', name:'DT_RowIndex'},
                { data:'name', name:'name'},
                { data:'subject', name:'subject'},
                { data:'service', name:'service'},
                { data:'priority', name:'priority'},
                { data:'date', name:'date'},
                { data:'status', name:'status'},
                { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });

        });


        //edit request send
        $('body').on('click','.edit',function(){
          var id = $(this).data('id');
          var url = "{{ url('admin/ticket/edit') }}/"+id;
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
          $(document).on('click','#delete_ticket',function(e){
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