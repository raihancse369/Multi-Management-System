<form method="POST" action="{{ route('update.brand', $data->id) }}" id="edit_form" enctype="multipart/form-data">
    @csrf
    @method('PUT') <!-- Method spoofing for RESTful update -->
    <input type="hidden" name="old_photo" value="{{ $data->image }}">

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Brand Name</label>
                <input type="text" name="brand_name" value="{{ old('brand_name', $data->brand_name) }}" class="form-control @error('brand_name') is-invalid @enderror" placeholder="Enter category name" required>
                @error('brand_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Show Frontend Page</label>
                    <select class="form-control" name="status">
                      <option value="Yes" @if($data->status=='Yes') selected="" @endif >Yes</option>
                      <option value="No" @if($data->status=='No') selected="" @endif >No</option>
                    </select>
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
            </div>
        </div>
    </div>

    <div class="form-group">
        <label>New Logo</label>
        <input type="file" name="image" class="form-control" accept="image/*" onchange="readURL(this, '#imageEdit');">
        <img id="imageEdit" src="#" style="display:none; margin-top: 10px;" width="80" />
    </div>

    <div class="form-group">
        <label>Old Logo</label><br>
        <img src="{{ asset('uploads/brand/'.$data->image) }}" alt="Old Image" width="80" height="80">
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary submit_button">
            <span class="btn-text">Update</span>
            <span class="loading d-none"><i class="fa fa-spinner fa-spin"></i></span>
        </button>
    </div>
</form>

<!-- Image Preview -->
<script>
    function readURL(input, previewSelector) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $(previewSelector).attr('src', e.target.result).show();
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
</script>

<!-- AJAX Form Submit -->
<script>
$(document).ready(function () {

    $('#edit_form').on('submit', function (e) {
        e.preventDefault();

        const form = $(this);
        const submitBtn = form.find('.submit_button');
        const loading = form.find('.loading');
        const btnText = form.find('.btn-text');
        const formData = new FormData(this);

        // Reset previous validation
        form.find('.is-invalid').removeClass('is-invalid');
        form.find('.text-danger').remove();

        // Button loading state
        submitBtn.prop('disabled', true);
        loading.removeClass('d-none');
        btnText.addClass('d-none');

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                toastr.success(res.message || 'Brand Updated Successfully.');
                form[0].reset();
                $('#imageEdit').hide().attr('src', ''); // hide preview on reset
                $('#editModal').modal('hide');
                $('.dataTable').DataTable().ajax.reload(null, false); // Reload without changing pagination
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    let firstInvalid = null;
                    for (const key in errors) {
                        const input = form.find('[name="' + key + '"]');
                        input.addClass('is-invalid');
                        input.after('<span class="text-danger">' + errors[key][0] + '</span>');
                        if (!firstInvalid) firstInvalid = input;
                        toastr.error(errors[key][0]);
                    }
                    if (firstInvalid) firstInvalid.focus();
                } else if (xhr.status === 404) {
                    toastr.error('Data not found.');
                } else if (xhr.status === 500) {
                    toastr.error('Server error. Please try again later.');
                } else {
                    toastr.error('An unexpected error occurred.');
                }
            },
            complete: function () {
                submitBtn.prop('disabled', false);
                loading.addClass('d-none');
                btnText.removeClass('d-none');
            }
        });
    });

});
</script>
