<form method="POST" action="{{ route('update.department', $data->id) }}" id="edit_form">
    @csrf
    @method('PUT') <!-- Method spoofing for RESTful update -->
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Department Name</label>
                <input type="text" name="department_name" value="{{ old('department_name', $data->department_name) }}" class="form-control @error('department_name') is-invalid @enderror" required>
                @error('department_name')
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
            const loading = submitBtn.find('.loading');
            const btnText = submitBtn.find('.btn-text');
            const formData = new FormData(this);
            formData.append('_method', 'PUT'); // Ensure Laravel recognizes PUT

            // Reset previous validation
            form.find('.is-invalid').removeClass('is-invalid');
            form.find('.text-danger').remove();

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
                    toastr.success(res.message || 'Department Updated Successfully.');
                    $('#editModal').modal('hide');
                    $('.dataTable').DataTable().ajax.reload(null, false);
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

        // Reset modal on close
        $('#editModal').on('hidden.bs.modal', function () {
            const form = $(this).find('form');
            form[0].reset();
            form.find('.is-invalid').removeClass('is-invalid');
            form.find('.text-danger').remove();
            const submitBtn = form.find('.submit_button');
            submitBtn.prop('disabled', false);
            submitBtn.find('.loading').addClass('d-none');
            submitBtn.find('.btn-text').removeClass('d-none');
        });

    });

</script>
