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
                        <li class="active"><a href="{{ route('employee') }}">Employee</a></li>
                        <li><a href="{{ route('department') }}">Department</a></li>
                        <li><a href="{{ route('designation') }}">Designation</a></li>
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
                            </div><br/>
                            <!-- Filters -->
                            <div class="row">
                                <div class="col-sm-4">
                                    <select class="form-control submitable" id="department">
                                        <option value="">All</option>
                                        @foreach($department as $row)
                                        <option value="{{ $row->id }}">
                                            {{ $row->department_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <select class="form-control submitable" id="designation">
                                        <option value="">All</option>
                                        @foreach($designation as $row)
                                        <option value="{{ $row->id }}">
                                            {{ $row->designation_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Data Table -->
                        <div class="panel-body">
                            <table class="table table-striped table-bordered dataTable">
                                <thead>
                                    <tr>
                                        <th># SL</th>
                                        <th>Employee ID</th>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Designation</th>
                                        <th>Photo</th>
                                        <th>Salary</th>
                                        <th>Email</th>
                                        <th>Phone</th>
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
                    <h4 class="modal-title">Create New Employee</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('store.employee') }}" method="POST" id="add_form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Select Department</label>
                                    <select class="form-control" name="department_id">
                                        @foreach($department as $row)
                                        <option value="{{ $row->id }}">{{ $row->department_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('department_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Select Designation</label>
                                    <select class="form-control" name="designation_id">
                                        @foreach($designation as $row)
                                        <option value="{{ $row->id }}">{{ $row->designation_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('designation_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Employee ID</label>
                                    <input type="text" name="employee_id" class="form-control @error('employee_id') is-invalid @enderror" placeholder="Enter Employee ID" required />
                                    @error('employee_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Employee Name" required />
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Valid Email Address" required />
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="+1234567890" required />
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>NID</label>
                                    <input type="text" name="nid" class="form-control @error('nid') is-invalid @enderror" placeholder="National ID Card" required />
                                    @error('nid')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Joining Date</label>
                                    <input type="date" name="joining_date" class="form-control @error('joining_date') is-invalid @enderror"/>
                                    @error('joining_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Salary</label>
                                    <input type="text" name="salary" class="form-control @error('salary') is-invalid @enderror" placeholder="Enter Salary" required />
                                    @error('salary')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" rows="5" name="address"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" name="image" class="form-control" accept="image/*" onchange="readURL(this);"/><br>
                                    <small class="text-danger">Image size must be (560px by 700px)</small><hr>
                                    <img id="image" src="#" style="display: none; margin-top: 10px" width="80"/>
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
                    <h5 class="modal-title" id="myModalLabel">Edit Employee Page</h5>
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
    function readURL(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#image').attr('src', e.target.result).show();
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

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
            ajax: {
                url: "{{ route('employee') }}",
                data: function (d) {
                    d.department_id = $('#department').val();
                    d.designation_id = $('#designation').val();
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'employee_id', name: 'employee_id' },
                { data: 'name', name: 'name' },
                { data: 'department_name', name: 'department_name' },
                { data: 'designation_name', name: 'designation_name' },
                { data: 'image', name: 'image' },
                { data: 'salary', name: 'salary' },
                { data: 'email', name: 'email' },
                { data: 'phone', name: 'phone' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });

        // Reload table on filter change
        $(document).on('change', '.submitable', function () {
            table.ajax.reload();
        });

        // -----------------------------
        // Create Form Submit
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
        // Edit method
        // -----------------------------
        $('body').on('click', '.edit', function() {
            const id = $(this).data('id');
            const url = "{{ url('admin/employee/edit') }}/" + id;
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
        // Delete method
        // -----------------------------
        $('body').on('click', '.delete_employee', function(e) {
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
