<form method="post" action="{{ route('update.slider', $data->id) }}" id="edit_form" enctype="multipart/form-data">

    @csrf
    <input type="hidden" name="id" value="{{ $data->id }}">
    <input type="hidden" name="old_photo" value="{{ $data->image }}">

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Slider Title</label>
                <input type="text" name="title" value="{{ $data->title }}" class="form-control @error('title') is-invalid @enderror">
                @error('title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="status">
                  <option value="Active" @if($data->status=='Active') selected="" @endif >Active</option>
                  <option value="Deactive" @if($data->status=='Deactive') selected="" @endif >Deactive</option>
                </select>
                @error('status')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" id="editsummernote" class="form-control @error('description') is-invalid @enderror" rows="5">{{ $data->description }}</textarea>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label>New Image</label>
        <input type="file" name="image" class="form-control" accept="image/*" onchange="readURL(this);"><br>
        <small class="text-danger">Image size must be (1920px by 1280px)</small><hr>
        <img id="imageEdit" src="#" style="display:none; margin-top: 10px;" width="80" />
    </div>

    <div class="form-group">
        <label>Old Image</label><br>
        <img src="{{ asset('uploads/slider/'.$data->image) }}" alt="Old Image" width="80" height="80">
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
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#imageEdit').attr('src', e.target.result).show();
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
        var loading = $('.e_loading');
        var btnText = $('.btn-text');

        var fd = new FormData(this);

        loading.removeClass('d-none');
        btnText.addClass('d-none');

        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
                toastr.success(response.message || 'Data Updated Successfully.');
                $('#edit_form')[0].reset();
                $('#imageEdit').hide().attr('src', '#'); // hide preview on reset
                $('#editModal').modal('hide');
                $('.dataTable').DataTable().ajax.reload();
            },
            error: function(xhr){
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    for (var key in errors) {
                        toastr.error(errors[key][0]);
                    }
                } else {
                    toastr.error('Something went wrong. Please try again.');
                }
            },
            complete: function(){
                loading.addClass('d-none');
                btnText.removeClass('d-none');
            }
        });
    });

</script>
