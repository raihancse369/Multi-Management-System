<form method="POST" action="{{ route('update.campaign', $data->id) }}" id="edit_form" enctype="multipart/form-data">
    @csrf
    @method('PUT') <!-- Method spoofing for RESTful update -->
    <input type="hidden" name="id" value="{{ $data->id }}">
    <input type="hidden" name="old_photo" value="{{ $data->image }}">

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Campaign Title</label>
                <input type="text" name="title" value="{{ $data->title }}" class="form-control @error('title') is-invalid @enderror">
                @error('title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Start Date</label>
                <input type="text" name="start_date" value="{{ $data->start_date }}" class="form-control @error('start_date') is-invalid @enderror">
                @error('start_date')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>End Date</label>
                <input type="text" name="end_date" value="{{ $data->end_date }}" class="form-control @error('end_date') is-invalid @enderror">
                @error('end_date')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="status">
                  <option value="1" @if($data->status==1) selected="" @endif >Active</option>
                  <option value="0" @if($data->status==0) selected="" @endif >Deactive</option>
                </select>
                @error('status')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Discount (%)</label>
                <input type="text" name="discount" value="{{ $data->discount }}" class="form-control @error('discount') is-invalid @enderror">
                @error('discount')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>New Image</label>
                <input type="file" name="image" class="form-control" accept="image/*" onchange="readURL(this, '#imageEdit');"><br>
                <small class="text-danger">Image size must be (1920px by 1080px)</small><hr>
                <img id="imageEdit" src="#" style="display:none; margin-top: 10px;" width="80" />
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Old Image</label>
                <img src="{{ asset('uploads/post/'.$data->image) }}" alt="Old Image" width="80" height="80">
            </div>
        </div>
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
                toastr.success(res.message || 'Data updated successfully.');
                form[0].reset();
                $('#imageEdit').hide().attr('src', '#');
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
