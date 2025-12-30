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
                        <li class="active"><a href="{{ route('blog') }}">Blog Post</a></li>
                        <li><a href="{{ route('blog-category') }}">Blog Category</a></li>
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
                                    <select class="form-control submitable" id="filter_category">
                                        <option value="">All</option>
                                        @foreach($category as $row)
                                        <option value="{{ $row->id }}">
                                            {{ $row->category_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <input type="date" class="form-control submitable" id="date"/>
                                </div>
                            </div>
                        </div>

                        <!-- Data Table -->
                        <div class="panel-body">
                            <table class="table table-striped table-bordered dataTable">
                                <thead>
                                    <tr>
                                        <th># SL</th>
                                        <th>Category</th>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Tags</th>
                                        <th>Date</th>
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
                    <h4 class="modal-title">Create New Blog Post</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('store.blog') }}" method="POST" id="add_form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Select Category</label>
                                    <select class="form-control" name="category_id">
                                        @foreach($category as $row)
                                        <option value="{{ $row->id }}">{{ $row->category_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tags</label>
                                    <input type="text" name="tags" class="form-control @error('tags') is-invalid @enderror" placeholder="Enter Post Tags" required />
                                    @error('tags')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter Post Title" required />
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea id="summernote" class="form-control @error('details') is-invalid @enderror" rows="5" name="details"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" name="image" class="form-control" accept="image/*" onchange="readURL(this);"/><br>
                                    <small class="text-danger">Image size must be (1920px by 1280px)</small><hr>
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
                    <h5 class="modal-title" id="myModalLabel">Edit Blog Post</h5>
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
        $('#summernote').summernote({ height: 200 });
        
        // Global CSRF Setup
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        });

        // Initialize DataTable
        const table = $('.dataTable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                url: "{{ route('blog') }}",
                data: function (d) {
                    d.category_id = $('#filter_category').val();
                    d.date = $('#date').val();
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'category_name', name: 'category_name' },
                { data: 'title', name: 'title' },
                { data: 'image', name: 'image' },
                { data: 'tags', name: 'tags' },
                { data: 'date', name: 'date' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });

        // Reload table on filter change
        $(document).on('change', '.submitable', function () {
            table.ajax.reload();
        });

        
    // ============================
    // CREATE AJAX (Optimized)
    // ============================
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
                toastr.success(res.message);
                form[0].reset();
                $('#image').hide().attr('src', '#');
                $('#con-close-modal').modal('hide');
                table.ajax.reload(null, false);
            },

            error: function (xhr) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    for (const key in errors) {
                        const input = form.find('[name="'+key+'"]');
                        input.addClass('is-invalid');
                        input.after('<span class="text-danger">'+errors[key][0]+'</span>');
                        toastr.error(errors[key][0]);
                    }
                } else {
                    toastr.error('Unexpected error.');
                }
            },

            complete: function () {
                btn.prop('disabled', false);
                loading.addClass('d-none');
                btnText.removeClass('d-none');
            }
        });
    });


    // ============================
    // EDIT LOAD
    // ============================
    $('body').on('click', '.edit', function() {
        const id = $(this).data('id');

        $('#edit_part').html(`<div class="text-center p-4">
            <i class="fa fa-spinner fa-spin"></i> Loading...
        </div>`);

        $.get("{{ url('admin/blog/edit') }}/" + id, function(response) {
            $('#edit_part').html(response);
            $('#editModal').modal('show');
        }).fail(function() {
            toastr.error("Unable to load edit form");
        });
    });


    // ============================
    // DELETE AJAX (Optimized)
    // ============================
    $('body').on('click', '.delete_blog', function (e) {
        e.preventDefault();
        const url = $(this).attr('href');

        swal({
            title: "Are you sure?",
            text: "Deleted data cannot be restored!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {

                $.ajax({
                    url: url,
                    type: 'DELETE',

                    success: function (res) {
                        toastr.success(res.message);
                        table.ajax.reload(null, false);
                    },

                    error: function () {
                        toastr.error("Failed to delete");
                    }
                });
            }
        });
    });

    // Cleanup modal on close
    $('#con-close-modal, #editModal').on('hidden.bs.modal', function () {
        const form = $(this).find('form');
        if (form.length) form[0].reset();
        $(this).find('.is-invalid').removeClass('is-invalid');
        $(this).find('.text-danger').remove();
    });

    });
</script>




@endsection
