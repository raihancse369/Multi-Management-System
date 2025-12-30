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
                        <li class="active"><a href="{{ route('website-review') }}">Website Review</a></li>
                        <li><a href="{{ route('review') }}">Product Review</a></li>
                        <li><a href="{{ route('contact') }}">Contact Message</a></li>
                    </ol>
                </div>
            </div>

            <!-- Category Management -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <!-- Panel Header -->
                        <div class="panel-heading">
                            <div class="row mb-2">
                                <div class="col-sm-6">

                                </div>
                            </div>
                            <br/>
                        </div>

                        <!-- Data Table -->
                        <div class="panel-body">
                            <table class="table table-striped table-bordered dataTable">
                                <thead>
                                    <tr>
                                        <th># SL</th>
                                        <th>User Name</th>
                                        <th>Review</th>
                                        <th>Rating</th>
                                        <th>Review Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container -->
    </div><!-- /.content -->



    <!-- Edit Modal -->
    <div id="editModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Show Website Review Message</h5>
                </div>
                <div class="modal-body" id="edit_part"></div>
            </div>
        </div>
    </div>

    <footer class="footer text-right">{{ date('Y') }} © R@ih@n</footer>
</div>

<!-- Scripts -->
<script src="{{ asset('admin/js/jquery.min.js') }}"></script>

<script>
    $(document).ready(function () {

        // Initialize DataTable
        const table = $('.dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('website-review') }}"
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'user_name', name: 'user_name' },
                { data: 'review', name: 'review' },
                { data: 'rating', name: 'rating' },
                { data: 'review_date', name: 'review_date' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });

        // Edit modal load
        $('body').on('click', '.edit', function() {
            const id = $(this).data('id');
            const url = "{{ url('admin/website-review/edit') }}/" + id;

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    if (typeof response === 'object' && response.error) {
                        toastr.error(response.error);
                    } else {
                        $('#edit_part').html(response);
                    }
                },
                error: function(xhr) {
                    toastr.error(xhr.responseJSON?.error || 'Data not found or an error occurred.');
                }
            });
        });

        // Delete category
        $('body').on('click', '.delete_wbreview', function(e) {
            e.preventDefault();
            const url = $(this).attr('href');

            swal({
                title: "Are you sure?",
                text: "This action cannot be undone.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: { _token: '{{ csrf_token() }}' },
                        success: function(res) {
                            toastr.success(res.message || 'Data Deleted Successfully');
                            table.ajax.reload();
                        },
                        error: function() {
                            toastr.error('Failed to delete data.');
                        }
                    });
                }
            });
        });

    });
</script>



@endsection
