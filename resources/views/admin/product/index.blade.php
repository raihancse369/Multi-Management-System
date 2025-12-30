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
                        <li class="active"><a href="{{ route('product') }}">Product</a></li>
                        <li><a href="{{ route('brand') }}">Brand</a></li>
                    </ol>
                </div>
            </div>

            <!-- Product Management -->
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
                                    <select class="form-control submitable" id="category_id">
                                        <option value="">All</option>
                                        @foreach($category as $row)
                                        <option value="{{ $row->id }}">
                                            {{ $row->category_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <select class="form-control submitable" id="subcategory_id">
                                        <option value="">All</option>
                                        @foreach($subcategory as $row)
                                        <option value="{{ $row->id }}">
                                            {{ $row->subcategory_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <select class="form-control submitable" id="brand_id">
                                        <option value="">All</option>
                                        @foreach($brand as $row)
                                        <option value="{{ $row->id }}">
                                            {{ $row->brand_name }}
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
                                        <th>Product Name</th>
                                        <th>Category</th>
                                        <th>Subcategory</th>
                                        <th>Brand Name</th>
                                        <th>Code</th>
                                        <th>Sell Price</th>
                                        <th>Discount Price</th>
                                        <th>Thumbnail</th>
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
                    <h4 class="modal-title">Create New Product</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('store.product') }}" method="POST" id="add_form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Category</label>
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
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Sub Category</label>
                                    <select class="form-control" name="subcategory_id">
                                        @foreach($subcategory as $row)
                                        <option value="{{ $row->id }}">{{ $row->subcategory_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('subcategory_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Brand</label>
                                    <select class="form-control" name="brand_id">
                                        @foreach($brand as $row)
                                        <option value="{{ $row->id }}">{{ $row->brand_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('brand_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Product Name" required />
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Product Code</label>
                                    <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" placeholder="Enter Product Code" required />
                                    @error('code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Stock Quantity</label>
                                    <input type="text" name="stock_quantity" class="form-control @error('stock_quantity') is-invalid @enderror" placeholder="Enter Product Quantity" required />
                                    @error('stock_quantity')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Tags</label>
                                    <input type="text" name="tags" class="form-control @error('tags') is-invalid @enderror" placeholder="Enter Product Tags" required />
                                    @error('tags')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Color</label>
                                    <input type="text" name="color" class="form-control @error('color') is-invalid @enderror" placeholder="Enter Product Color" required />
                                    @error('color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Size</label>
                                    <input type="text" name="size" class="form-control @error('size') is-invalid @enderror" placeholder="Enter Product Size" required />
                                    @error('size')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Unit</label>
                                    <input type="text" name="unit" class="form-control @error('unit') is-invalid @enderror" placeholder="Enter Product Unit" required />
                                    @error('unit')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Show Page</label>
                                    <select class="form-control" name="showpage">
                                        <option value="Featured"><span>Featured</span></option>
                                        <option value="Today Deal">Today Deal</option>
                                        <option value="Trendy">Trendy</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status">
                                        <option value="Active"><span>Active</span></option>
                                        <option value="Deactive">Deactive</option>
                                    </select> 
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Purchase Price</label>
                                    <input type="text" name="purchase_price" class="form-control @error('purchase_price') is-invalid @enderror" placeholder="Product Purchase Price" required />
                                    @error('purchase_price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Discount Price</label>
                                    <input type="text" name="discount_price" class="form-control @error('discount_price') is-invalid @enderror" placeholder="Product Discount Price" required />
                                    @error('discount_price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Sell Price</label>
                                    <input type="text" name="selling_price" class="form-control @error('selling_price') is-invalid @enderror" placeholder="Product Product Sell Price" required />
                                    @error('selling_price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" rows="5" name="description"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Main Thumbnail</label>
                                    <input type="file" name="thumbnail" class="form-control" accept="image/*" onchange="readURL(this);"/><br>
                                    <small class="text-danger">Image size must be (600px by 600px)</small><hr>
                                    <img id="image" src="#" style="display: none; margin-top: 10px" width="80"/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="">  
                                <table class="table table-bordered" id="dynamic_field">
                                    <label for="field-3" class="control-label">More Images (Click Add For More Image)</label><br> 
                                    <tr>  
                                        <td><input type="file" accept="image/*" name="images[]" class="form-control name_list" /></td>  
                                        <td><button type="button" name="add" id="add" class="btn btn-success">Add</button></td>  
                                    </tr>  
                                </table>    
                            </div><br>
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
                    <h5 class="modal-title" id="myModalLabel">Edit Product Page</h5>
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

<script type="text/javascript">
    
    // ======== Dynamic Image Fields ========
    var i = 1;
    
    $('#add').click(function() {
        i++;
        $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added">'+
            '<td><input type="file" accept="image/*" name="images[]" class="form-control name_list" /></td>'+
            '<td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td>'+
            '</tr>');
    });

    $(document).on('click', '.btn_remove', function() {
        var button_id = $(this).attr("id");
        $('#row' + button_id).remove();
    });

</script>

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
            ajax: {
                url: "{{ route('product') }}",
                data: function (d) {
                    d.category_id = $('#category_id').val();
                    d.subcategory_id = $('#subcategory_id').val();
                    d.brand_id = $('#brand_id').val();
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                { data: 'category_name', name: 'category_name' },
                { data: 'subcategory_name', name: 'subcategory_name' },
                { data: 'brand_name', name: 'brand_name' },
                { data: 'code', name: 'code' },
                { data: 'selling_price', name: 'selling_price' },
                { data: 'discount_price', name: 'discount_price' },
                { data: 'thumbnail', name: 'thumbnail', orderable: false, searchable: false },
                { data: 'status', name: 'status', orderable: false, searchable: false },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            language: { emptyTable: "No products available" }
        });

        // Reload table on filter change
        $(document).on('change', '.submitable', function () {
            table.ajax.reload();
        });

        // Add Product AJAX

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
                    $('#image').hide();
                    $('#dynamic_field tr.dynamic-added').remove();
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
            const url = "{{ url('admin/product/edit') }}/" + id;
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
        $('body').on('click', '.delete_product', function(e) {
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
