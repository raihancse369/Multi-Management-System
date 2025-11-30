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
                        <li class="active"><a href="{{ route('coupon.index') }}">Coupon</a></li>
                        <li class="active"><a href="{{ route('campaign.index') }}">Campaign</a></li>
                        <li><a href="{{ route('ticket.index') }}">Ticket</a></li>
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
                            <br/>
                        </div>

                        <!-- Data Table -->
                        <div class="panel-body">
                            <table class="table table-striped table-bordered dataTable">
                                <thead>
                                    <tr>
                                        <th># SL</th>
                                        <th>Coupon Code</th>
                                        <th>Coupon Type</th>
                                        <th>Coupon Amount</th>
                                        <th>Coupon Date</th>
                                        <th>Status</th>
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

    <!-- Create Modal -->
    <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Create New Coupon</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('store.coupon') }}" method="POST" id="add_form">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Coupon Code</label>
                                    <input type="text" name="coupon_code" class="form-control @error('coupon_code') is-invalid @enderror" placeholder="Enter Coupon Code" required>
                                    @error('coupon_code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Coupon Type</label>
                                    <select class="form-control" name="type">
                                        <option value="Fixed"><span>Fixed</span></option>
                                        <option value="Percentage">Percentage</option>
                                    </select>
                                    @error('type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="text" name="coupon_amount" class="form-control @error('coupon_amount') is-invalid @enderror">
                                    @error('coupon_amount')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Valid Date</label>
                                    <input type="date" name="valid_date" class="form-control @error('valid_date') is-invalid @enderror"/>
                                    @error('valid_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status">
                                        <option value="Active"><span>Active</span></option>
                                        <option value="Deactive">Deactive</option>
                                    </select> 
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
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
    <div id="editModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Edit Coupon Page</h5>
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

        // -----------------------------
        // Global CSRF Setup
        // -----------------------------
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        });

        // -----------------------------
        // Initialize DataTable
        // -----------------------------
        const table = $('.dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: { url: "{{ route('coupon.index') }}" },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'coupon_code', name: 'coupon_code' },
                { data: 'type', name: 'type' },
                { data: 'coupon_amount', name: 'coupon_amount' },
                { data: 'valid_date', name: 'valid_date' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });

        // -----------------------------
        // Create Category Form Submit
        // -----------------------------
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
                    toastr.success(res.message || 'Data added successfully');
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

        // -----------------------------
        // Edit Category Modal
        // -----------------------------
        $('body').on('click', '.edit', function() {
            const id = $(this).data('id');
            const url = "{{ url('admin/coupon/edit') }}/" + id;
            const modalBody = $('#edit_part');

            modalBody.html('<div class="text-center p-4"><i class="fa fa-spinner fa-spin"></i> Loading...</div>');

            $.get(url)
                .done(function(response) {
                    modalBody.html(response);
                    $('#editModal').modal('show');
                })
                .fail(function(xhr) {
                    const errorMsg = (xhr.responseJSON && xhr.responseJSON.error) ? xhr.responseJSON.error : 'Failed to load edit form.';
                    toastr.error(errorMsg);
                });
        });

        // -----------------------------
        // Delete Category
        // -----------------------------
        $('body').on('click', '.delete_coupon', function(e) {
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
                        success: function(res) {
                            toastr.success(res.message || 'Data deleted successfully');
                            table.ajax.reload(null, false);
                        },
                        error: function() {
                            toastr.error('Failed to delete data.');
                        }
                    });
                }
            });
        });

        // -----------------------------
        // Modal Cleanup on Close
        // -----------------------------
        $('#con-close-modal, #editModal').on('hidden.bs.modal', function () {
            const form = $(this).find('form');
            form && form[0].reset();
            $(this).find('.is-invalid').removeClass('is-invalid');
            $(this).find('.text-danger').remove();
        });

    });
</script>




@endsection
