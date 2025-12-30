<form method="POST" action="{{ route('update.blog-category', $data->id) }}" id="edit_form">
    @csrf
    @method('PUT') <!-- Method spoofing for RESTful update -->
    <input type="hidden" name="id" value="{{ $data->id }}">

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Blog Category Name</label>
                <input type="text" name="category_name" value="{{ old('category_name', $data->category_name) }}" class="form-control @error('category_name') is-invalid @enderror" required>
                @error('category_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
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
                toastr.success(res.message || 'Blog category updated successfully.');
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
                    toastr.error('Blog category not found.');
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
