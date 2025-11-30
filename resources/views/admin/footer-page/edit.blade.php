<form method="post" action="{{ route('update.footer', $data->id) }}" id="edit_form" enctype="multipart/form-data">

    @csrf
    <input type="hidden" name="id" value="{{ $data->id }}">
    <input type="hidden" name="old_photo" value="{{ $data->image }}">

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" value="{{ $data->email }}" class="form-control @error('email') is-invalid @enderror">
                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" value="{{ $data->phone }}" class="form-control @error('phone') is-invalid @enderror">
                @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Footer Title</label>
                <textarea name="footer_title" class="form-control @error('footer_title') is-invalid @enderror" rows="3">{{ $data->footer_title }}</textarea>
                @error('footer_title') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Address</label>
                <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="3">{{ $data->address }}</textarea>
                @error('address') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Address Two</label>
                <textarea name="address_two" class="form-control @error('address_two') is-invalid @enderror" rows="3">{{ $data->address_two }}</textarea>
                @error('address_two') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Copyright Text</label>
                <input type="text" name="copyright_text" value="{{ $data->copyright_text }}" class="form-control @error('copyright_text') is-invalid @enderror">
                @error('copyright_text') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Disclaimer</label>
                <textarea name="disclaimer" class="form-control @error('disclaimer') is-invalid @enderror" rows="4">{{ $data->disclaimer }}</textarea>
                @error('disclaimer') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="form-group">
            <label>New Footer Logo</label>
            <input type="file" name="image" class="form-control" accept="image/*" onchange="readURL(this);">
            <small class="text-danger">Image size must be (600px by 600px)</small>
            <hr>
            <img id="imageEdit" src="#" style="display:none; margin-top:10px;" width="80" />
        </div>
    </div>

    <div class="row">
        <div class="form-group">
            <label>Old Footer Logo</label><br>
            <img src="{{ asset('uploads/footer/'.$data->image) }}" alt="Old Image" width="80" height="80">
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">
            <span class="btn-text">Update</span>
            <span class="e_loading d-none"><i class="fa fa-spinner fa-spin"></i></span>
        </button>
    </div>
</form>


<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => $('#imageEdit').attr('src', e.target.result).show();
            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#edit_form').submit(function(e){
        e.preventDefault();

        const form = $(this);
        const fd = new FormData(this);
        const loading = form.find('.e_loading');
        const btnText = form.find('.btn-text');
        const submitBtn = form.find('button[type="submit"]');

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
                setTimeout(() => {
                    $('#editModal').modal('hide');
                }, 600);
                $('#edit_form')[0].reset();
                $('#imageEdit').hide().attr('src', '#');
                $('.dataTable').DataTable().ajax.reload();
            },
            error: function(xhr){
                if (xhr.status === 422 && xhr.responseJSON?.errors) {
                    $.each(xhr.responseJSON.errors, (key, value) => toastr.error(value[0]));
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
