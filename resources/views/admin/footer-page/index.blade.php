@extends('layouts.admin') 
@section('admin_content')
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <!-- Breadcrumb -->
            <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb pull-right">
                        <li class="active"><a href="{{ route('footer-page') }}">Footer Page</a></li>
                    </ol>
                </div>
            </div>

            <!-- Blog Post Management -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <!-- Panel Header -->
                        <div class="panel-heading">
                            <div class="row mb-2">
                            </div><br/>
                        </div>

                        <!-- Table -->
                        <div class="panel-body">
                            <table class="table table-striped table-bordered dataTable">
                                <thead>
                                    <tr>
                                        <th># SL</th>
                                        <th>Footer Title</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- container -->
    </div>
    <!-- content -->


    <!-- sample modal content -->
    <div id="editModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">
                        Edit Footer Page
                    </h5>
                </div>

                <div class="modal-body" id="edit_part"></div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <footer class="footer text-right">
        {{ date('Y') }} © R@ih@n
    </footer>
</div>

<!-- Scripts -->
<script src="{{ asset('admin/js/jquery.min.js') }}"></script>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#image').attr('src', e.target.result).show();
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).ready(function () {

        const table = $('.dataTable').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            paging: false,
            ordering: false,
            ajax: "{{ route('footer-page') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'footer_title', name: 'footer_title' },
                { data: 'email', name: 'email' },
                { data: 'phone', name: 'phone' },
                { data: 'address', name: 'address' },
                { data: 'image', name: 'image' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });


        // Reload table on filter change
        $(document).on('change', '.submitable', function () {
            table.ajax.reload();
        });

        //edit request send
        $('body').on('click','.edit',function(){
            var id = $(this).data('id');
            var url = "{{ url('admin/footer-page/edit') }}/" + id;
            $('#edit_part').html('<div class="text-center py-3"><i class="fa fa-spinner fa-spin fa-2x"></i> Loading...</div>');
            $.get(url, function(data) {
                $('#edit_part').html(data);
            });
        });



    });

</script>
@endsection
