<form method="post" action="{{ route('update.project', $data->id) }}" id="edit_form" enctype="multipart/form-data">

    @csrf
    <input type="hidden" name="id" value="{{ $data->id }}">
    <input type="hidden" name="old_photo" value="{{ $data->image }}">

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Project Name</label>
                <input type="text" name="project_name" value="{{ $data->project_name }}" class="form-control @error('project_name') is-invalid @enderror">
                @error('project_name')
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
        <img src="{{ asset('uploads/project-page/'.$data->image) }}" alt="Old Image" width="80" height="80">
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">
            <span class="btn-text">Update</span>
            <span class="e_loading d-none"><i class="fa fa-spinner fa-spin"></i></span>
        </button>

    </div>
</form>

<!-- Summernote Init -->
<script>
$(document).ready(function() {
    $('#editsummernote').summernote({
        height: 200,
        focus: true
    });
});
</script>

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
    $('#edit_form').submit(function(e){
        e.preventDefault();

        var form = $(this);
        var loading = form.find('.e_loading');
        var btnText = form.find('.btn-text');
        var submitBtn = form.find('button[type="submit"]');

        var fd = new FormData(this);

        // Clear previous errors
        form.find('.is-invalid').removeClass('is-invalid');
        form.find('.text-danger').remove();

        loading.removeClass('d-none');
        btnText.addClass('d-none');
        submitBtn.prop('disabled', true);

        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
                toastr.success(response.message || 'Data Updated Successfully.');
                form[0].reset();
                $('#imageEdit').hide().attr('src', '#'); // hide preview on reset
                $('#editsummernote').summernote('reset'); // reset summernote editor
                $('#editModal').modal('hide');
                $('.dataTable').DataTable().ajax.reload();
            },
            error: function(xhr){
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    for (var key in errors) {
                        var input = form.find('[name="'+key+'"]');
                        input.addClass('is-invalid');
                        input.after('<span class="text-danger">' + errors[key][0] + '</span>');
                        toastr.error(errors[key][0]);
                    }
                } else {
                    toastr.error('Something went wrong. Please try again.');
                }
            },
            complete: function(){
                loading.addClass('d-none');
                btnText.removeClass('d-none');
                submitBtn.prop('disabled', false);
            }
        });
    });


</script>
