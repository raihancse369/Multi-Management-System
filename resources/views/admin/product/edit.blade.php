<form method="POST" action="{{ route('update.product', $data->id) }}" id="edit_form" enctype="multipart/form-data">
    @csrf
    @method('PUT') <!-- Method spoofing for RESTful update -->
    <input type="hidden" name="id" value="{{ $data->id }}">

    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label>Category</label>
                <select class="form-control @error('category_id') is-invalid @enderror" name="category_id">
                    @foreach($category as $row)
                        <option value="{{ $row->id }}" {{ $row->id == $data->category_id ? 'selected' : '' }}>{{ $row->category_name }}</option>
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
                <select class="form-control @error('subcategory_id') is-invalid @enderror" name="subcategory_id">
                    @foreach($subcategory as $row)
                        <option value="{{ $row->id }}" {{ $row->id == $data->subcategory_id ? 'selected' : '' }}>{{ $row->subcategory_name }}</option>
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
                <select class="form-control @error('brand_id') is-invalid @enderror" name="brand_id">
                    @foreach($brand as $row)
                        <option value="{{ $row->id }}" {{ $row->id == $data->brand_id ? 'selected' : '' }}>{{ $row->brand_name }}</option>
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
                <input type="text" name="name" value="{{ $data->name }}" class="form-control @error('name') is-invalid @enderror">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>Product Code</label>
                <input type="text" name="code" value="{{ $data->code }}" class="form-control @error('code') is-invalid @enderror">
                @error('code')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>Stock Quantity</label>
                <input type="text" name="stock_quantity" value="{{ $data->stock_quantity }}" class="form-control @error('stock_quantity') is-invalid @enderror">
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
                <input type="text" name="tags" value="{{ $data->tags }}" class="form-control @error('tags') is-invalid @enderror">
                @error('tags')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>Color</label>
                <input type="text" name="color" value="{{ $data->color }}" class="form-control @error('color') is-invalid @enderror">
                @error('color')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>Size</label>
                <input type="text" name="size" value="{{ $data->size }}" class="form-control @error('size') is-invalid @enderror">
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
                <select class="form-control" name="unit" id="unit" required>
                    <option value="Piece" {{ $data->unit == 'Piece' ? 'selected' : '' }}>Piece</option>
                    <option value="Gram" {{ $data->unit == 'Gram' ? 'selected' : '' }}>Gram</option>
                    <option value="Kg" {{ $data->unit == 'Kg' ? 'selected' : '' }}>Kg</option>
                </select>
                @error('unit')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>Show-Page</label>
                <select class="form-control" name="showpage" id="showpage" required>
                    <option value="Featured" {{ $data->showpage == 'Featured' ? 'selected' : '' }}>Featured</option>
                    <option value="Today Deal" {{ $data->showpage == 'Today Deal' ? 'selected' : '' }}>Today Deal</option>
                    <option value="Trendy" {{ $data->showpage == 'Trendy' ? 'selected' : '' }}>Trendy</option>
                </select>
                @error('showpage')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="status" id="status" required>
                    <option value="Active" {{ $data->status == 'Active' ? 'selected' : '' }}>Active</option>
                    <option value="Deactive" {{ $data->status == 'Deactive' ? 'selected' : '' }}>Deactive</option>
                </select>
                @error('status')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label>Purchase Price</label>
                <input type="text" name="purchase_price" value="{{ $data->purchase_price }}" class="form-control @error('purchase_price') is-invalid @enderror">
                @error('purchase_price')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>Discount Price</label>
                <input type="text" name="discount_price" value="{{ $data->discount_price }}" class="form-control @error('discount_price') is-invalid @enderror">
                @error('discount_price')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>Sell Price</label>
                <input type="text" name="selling_price" value="{{ $data->selling_price }}" class="form-control @error('selling_price') is-invalid @enderror">
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
                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="5">{{ $data->description }}</textarea>
                @error('description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>New Thumbnail</label>
                <input type="file" name="thumbnail" class="form-control" accept="image/*" onchange="readURL(this);">
                <input type="hidden" name="old_photo" value="{{ $data->thumbnail }}">
                <img id="imageEdit" src="#" alt="New Image Preview" style="display:none; height:80px; width:80px; margin-top:10px;">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Old Thumbnail</label><br>
                <img src="{{ asset('uploads/product/'.$data->thumbnail) }}" alt="Old Image" width="80" height="80">
            </div>
        </div>
    </div>

    <div class="form-group">
        <label>New Multiple Images</label><br>
        <table class="table table-bordered" id="dynamic_image_field">
            <tr>
                <td>
                    <input type="file" accept="image/*" name="images[]" class="form-control dynamic-image-input" />
                    <div class="preview-container mt-2"></div>
                </td><br>
                <td>
                    <button type="button" name="add" id="add_image" class="btn btn-success">Add</button>
                </td>
            </tr>
        </table><br>
    </div>


    <!-- Old Multiple Images -->
    @php
        $oldImages = json_decode($data->images, true) ?? [];
    @endphp
    @if(count($oldImages) > 0)
    <div class="form-group">
        <label>Old Images</label><br>
        <div id="old-images-preview">
            @foreach ($oldImages as $img)
                <div class="old-image-wrapper" style="display:inline-block; position:relative; margin-right:5px; margin-top:5px;">
                    <input type="hidden" name="old_images[]" value="{{ $img }}">
                    <img src="{{ asset('uploads/product/' . $img) }}" alt="Old Image" style="height:80px; width:80px;">
                    <button type="button" class="btn btn-sm btn-danger remove-old-image" style="position:absolute; top:0; right:0;">&times;</button>
                </div>
            @endforeach
        </div>
    </div>
    @endif

    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary submit_button">
            <span class="btn-text">Update</span>
            <span class="loading d-none"><i class="fa fa-spinner fa-spin"></i></span>
        </button>
    </div>
</form>

<!-- JS Scripts -->
<script>
    $(document).ready(function(){

        // Track dynamic rows
        let imageRowId = 1;

        // Track removed old images
        let removedOldImages = [];

        // Add new row
        $('#add_image').click(function(){
            imageRowId++;
            $('#dynamic_image_field').append(`
                <tr id="row${imageRowId}" class="dynamic-added">
                    <td>
                        <input type="file" accept="image/*" name="images[]" class="form-control dynamic-image-input" />
                        <div class="preview-container mt-2"></div>
                    </td>
                    <td>
                        <button type="button" name="remove" id="${imageRowId}" class="btn btn-danger btn_remove_image">X</button>
                    </td>
                </tr>
            `);
        });

        // Remove dynamic row
        $(document).on('click', '.btn_remove_image', function(){
            const button_id = $(this).attr("id");
            $('#row'+button_id).remove();
        });

        // Live preview for dynamic images
        $(document).on('change', '.dynamic-image-input', function(){
            const input = this;
            const container = $(this).siblings('.preview-container');
            container.empty(); // Clear previous preview

            if (input.files && input.files[0]){
                const reader = new FileReader();
                reader.onload = function(e){
                    container.append(`<img src="${e.target.result}" style="height:80px; width:auto; margin-top:5px;">`);
                }
                reader.readAsDataURL(input.files[0]);
            }
        });

        // Single Thumbnail Preview
        window.readURL = function(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imageEdit').attr('src', e.target.result).show();
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Remove Old Image
        $(document).on('click', '.remove-old-image', function(){
            const imgWrapper = $(this).closest('.old-image-wrapper');
            const imgName = imgWrapper.find('input[name="old_images[]"]').val();
            removedOldImages.push(imgName);
            imgWrapper.remove();
        });

        // AJAX Form Submission
        $('#edit_form').submit(function(e){
            e.preventDefault();
            $('.e_loading').removeClass('d-none');
            $(this).find('button[type="submit"]').attr('disabled', true);

            const fd = new FormData(this);

            // Add removed old images to FormData to let backend know
            removedOldImages.forEach(img => fd.append('removed_old_images[]', img));

            $.ajax({
                url: '{{ route("update.product") }}',
                method: 'POST',
                data: fd,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response){
                    toastr.success(response.message);
                    $('#edit_form')[0].reset();
                    $('#imageEdit').hide();
                    $('#dynamic_image_field tr.dynamic-added').remove();
                    $('#old-images-preview').html('');
                    $('.e_loading').addClass('d-none');
                    $('#editModal').modal('hide');
                    $('button[type="submit"]').attr('disabled', false);
                    $('.dataTable').DataTable().ajax.reload();
                    removedOldImages = []; // reset
                },
                error: function(xhr){
                    $('.e_loading').addClass('d-none');
                    $('button[type="submit"]').attr('disabled', false);
                    let msg = xhr.responseJSON?.message ?? 'Update failed. Please try again.';
                    toastr.error(msg);
                }
            });
        });

    });

</script>
