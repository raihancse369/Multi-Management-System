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
                            <li class="active"><a href="{{ route('page') }}">Create New Page</a></li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="m-b-30">
                                            <button class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#con-close-modal">Add New <i class="fa fa-plus"></i></button>
                                        </div>
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
                                                    <th>Page Name</th>
                                                    <th>Page Title</th>
                                                    <th>Description</th>
                                                    <th>Page Position</th>
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
                        <div class="modal-title">Create New Page</div> 
                    </div> 
                    <div class="modal-body"> 
                        <form action="{{ route('store.page') }}" method="post" id="add_form" >
                            @csrf
                            <div class="row">

                                <div class="col-md-6"> 
                                    <div class="form-group"> 
                                        <label for="field-3" class="control-label">Page Name</label> 
                                        <input type="text" name="page_name" class="form-control @error('page_name')is-invalid @enderror" id="page_name" placeholder="Enter Page Name">
                                        @error('page_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div> 
                                </div>

                                <div class="col-md-6"> 
                                    <div class="form-group"> 
                                        <label for="page_position">Page Position<span class="text-danger"> * </span></label> 
                                            <select class="form-control" name="page_position">
                                                <option value="1"><span>Line One</span></option>
                                                <option value="2">Line Two</option>
                                            </select> 
                                    </div> 
                                </div> 

                                <div class="col-md-12"> 
                                    <div class="form-group"> 
                                        <label for="field-3" class="control-label">Page Title</label> 
                                        <input type="text" name="page_title" class="form-control @error('page_title')is-invalid @enderror" id="page_title" placeholder="Enter Page Title">
                                        @error('page_title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div> 
                                </div> 

                                <div class="col-md-12"> 
                                    <div class="form-group"> 
                                        <label for="field-3" class="control-label">Description</label>
                                        <textarea id="summernote" class="form-control" rows="5" name="page_description"></textarea> 
                                    </div> 
                                </div>

                            </div>

                            <div class="modal-footer"> 
                                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button> 
                                <button type="submit" class="btn btn-primary waves-effect waves-light submit_button"><span class="loading d-none"> </span>Submit</button> 
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
                        <h5 class="modal-title" id="myModalLabel">Edit Page Setting</h5>
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

        //Datatable data show
        $(function category(){
          table =$('.dataTable').dataTable({
            "processing":true,
            "serverSide":true,
            "search":true,
            
            "ajax":{
                "url": "{{ route('page') }}", 
                "data":function(e) { 
                  
                }
            },

            columns:[
                { data:'DT_RowIndex', name:'DT_RowIndex'},
                { data:'page_name', name:'page_name'},
                { data:'page_title', name:'page_title'},
                { data:'page_description', name:'page_description'},
                { data:'page_position', name:'page_position'},
                { data:'action', name:'action'},
                ]
            });

        });

        $('#add_form').on('submit', function (e) {
        e.preventDefault();

        var $form = $(this);
        var $submitBtn = $form.find('.submit_button');

        var formData = new FormData(this);

        // Disable button to prevent double-click
        $submitBtn.prop('disabled', true);
        $('.loading').removeClass('d-none');

        $.ajax({
            url: $form.attr('action'),
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
            toastr.success(data.message || 'Data Inserted Successfully');
            $form[0].reset();
            $('#con-close-modal').modal('hide');
            $('.dataTable').DataTable().ajax.reload();
        },
        error: function (xhr) {
            toastr.error('Something went wrong');
            console.log(xhr.responseText);
        },
        complete: function () {
            // Always re-enable button & hide loader
            $submitBtn.prop('disabled', false);
            $('.loading').addClass('d-none');
                }
            });
        });


        //edit request send
        $('body').on('click','.edit',function(){
          var id = $(this).data('id');
          var url = "{{ url('admin/page/edit') }}/"+id;
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
          $(document).on('click','#delete_page',function(e){
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
              type: 'get',
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

    </script>

@endsection