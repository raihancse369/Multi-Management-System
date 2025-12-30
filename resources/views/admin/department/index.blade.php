@extends('layouts.admin')

@section('admin_content')
<div class="content-page">
    <div class="content">
        <div class="container">

            <!-- Breadcrumb -->
            <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb pull-right">
                        <li class="active"><a href="{{ route('department') }}">Department</a></li>
                        <li><a href="{{ route('designation') }}">Designation</a></li>
                        <li><a href="{{ route('employee') }}">Employee</a></li>
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
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#con-close-modal">
                                        Add New <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Data Table -->
                        <div class="panel-body">
                            <table class="table table-striped table-bordered dataTable dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th># SL</th>
                                        <th>Department Name</th>
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
    </div>

    <!-- Create Modal -->
    <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create New Department</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('store.department') }}" method="POST" id="add_form">
                        @csrf
                        <div class="form-group">
                            <label>Department Name</label>
                            <input type="text" name="department_name" class="form-control @error('department_name') is-invalid @enderror" placeholder="Enter Department Name" required>
                            @error('department_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary submit_button">
                                <span class="btn-text">Submit</span>
                                <span class="loading d-none"><i class="fa fa-spinner fa-spin"></i></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Department</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
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

        // Global CSRF Setup
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        });

        // Initialize DataTable
        const table = $('.dataTable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('department') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'department_name', name: 'department_name' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });

        // Create Form Submit
        $('#add_form').on('submit', function (e) {
            e.preventDefault();
            const form = $(this);
            const btn = form.find('.submit_button');
            const loading = btn.find('.loading');
            const btnText = btn.find('.btn-text');
            const formData = new FormData(this);

            // Reset previous validation
            form.find('.is-invalid').removeClass('is-invalid');
            form.find('.text-danger').remove();

            btn.prop('disabled', true);
            loading.removeClass('d-none');
            btnText.addClass('d-none');

            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (res) {
                    toastr.success(res.message || 'Department Inserted Successfully.');
                    form[0].reset();
                    $('#con-close-modal').modal('hide');
                    table.ajax.reload(null, false);
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        for (const key in errors) {
                            const input = form.find('[name="'+key+'"]');
                            input.addClass('is-invalid');
                            input.after('<span class="text-danger">' + errors[key][0] + '</span>');
                            toastr.error(errors[key][0]);
                        }
                    } else if (xhr.status === 404) {
                        toastr.error('Resource not found.');
                    } else if (xhr.status === 500) {
                        toastr.error('Server error. Please try again later.');
                    } else {
                        toastr.error('An unexpected error occurred.');
                    }
                },
                complete: function () {
                    btn.prop('disabled', false);
                    loading.addClass('d-none');
                    btnText.removeClass('d-none');
                }
            });
        });

        // Edit
        $('body').on('click', '.edit', function() {
            const id = $(this).data('id');
            const url = "{{ url('admin/department/edit') }}/" + id;
            const modalBody = $('#edit_part');

            modalBody.html('<div class="text-center p-4"><i class="fa fa-spinner fa-spin"></i> Loading...</div>');

            $.get(url)
                .done(function(response) {
                    modalBody.html(response);
                    $('#editModal').modal('show');
                    $('#editModal').find('input:first').focus(); // autofocus first input
                })
                .fail(function(xhr) {
                    toastr.error(xhr.responseJSON?.error || 'Failed to load edit form.');
                });
        });

        // Delete

        $('body').on('click', '.delete_department', function(e) {
            e.preventDefault();
            const url = $(this).data('url');

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
                            toastr.success(res.message || 'Department Deleted Successfully.');
                            table.ajax.reload(null, false);
                        },
                        error: function(xhr) {
                            toastr.error('Failed to delete department.');
                        }
                    });
                }
            });
        });

        // Modal Cleanup on Close
        $('#con-close-modal, #editModal').on('hidden.bs.modal', function () {
            const form = $(this).find('form');
            if (form.length) {
                form[0].reset();
                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.text-danger').remove();
                const btn = form.find('.submit_button');
                btn.prop('disabled', false);
                btn.find('.loading').addClass('d-none');
                btn.find('.btn-text').removeClass('d-none');
            }
        });



    });
</script>
@endsection
