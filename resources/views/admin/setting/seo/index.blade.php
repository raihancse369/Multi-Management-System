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
                            <li class="active"><a href="{{ route('seo') }}">Your Seo Setting</a></li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- <div class="m-b-30">
                                            <button class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#con-close-modal">Add New <i class="fa fa-plus"></i></button>
                                        </div> -->
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
                                                    <th>Meta Title</th>
                                                    <th>Meta Author</th>
                                                    <th>Meta Tags</th>
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
                        <h5 class="modal-title" id="myModalLabel">Update Seo Page</h5>
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
            processing:true,
            serverSide:true,
            search:true,
            ajax:"{{ route('seo') }}",

            columns:[
                { data:'DT_RowIndex', name:'DT_RowIndex'},
                { data:'meta_title', name:'meta_title'},
                { data:'meta_author', name:'meta_author'},
                { data:'meta_tag', name:'meta_tag'},
                { data:'action', name:'action'},
                ]
            });

        });


        //edit request send
        $('body').on('click','.edit',function(){
          var id = $(this).data('id');
          var url = "{{ url('admin/seo/edit') }}/"+id;
          $.ajax({
            url:url,
            type:'get',
            success:function(data){
              $('#edit_part').html(data);
            }
          });
        });



    </script>

@endsection