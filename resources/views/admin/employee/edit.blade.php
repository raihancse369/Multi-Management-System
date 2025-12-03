<form method="POST" action="{{ route('update.employee', $data->id) }}" id="edit_form" enctype="multipart/form-data">
    @csrf
    @method('PUT') <!-- Method spoofing for RESTful update -->
    <input type="hidden" name="id" value="{{ $data->id }}">
    <input type="hidden" name="old_photo" value="{{ $data->image }}">

    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label>Select Department</label>
                <select class="form-control @error('department_id') is-invalid @enderror" name="department_id">
                    @foreach($department as $row)
                        <option value="{{ $row->id }}" {{ $row->id == $data->department_id ? 'selected' : '' }}>{{ $row->department_name }}</option>
                    @endforeach
                </select>
                @error('department_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>Select Designation</label>
                <select class="form-control @error('designation_id') is-invalid @enderror" name="designation_id">
                    @foreach($designation as $row)
                        <option value="{{ $row->id }}" {{ $row->id == $data->designation_id ? 'selected' : '' }}>{{ $row->designation_name }}</option>
                    @endforeach
                </select>
                @error('designation_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>Employee ID</label>
                <input type="text" name="employee_id" value="{{ $data->employee_id }}" class="form-control @error('employee_id') is-invalid @enderror">
                @error('employee_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="{{ $data->name }}" class="form-control @error('name') is-invalid @enderror">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" value="{{ $data->email }}" class="form-control @error('email') is-invalid @enderror">
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" value="{{ $data->phone }}" class="form-control @error('phone') is-invalid @enderror">
                @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label>NID</label>
                <input type="text" name="nid" value="{{ $data->nid }}" class="form-control @error('nid') is-invalid @enderror">
                @error('nid')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>Joining Date</label>
                <input type="text" name="joining_date" value="{{ $data->joining_date }}" class="form-control @error('joining_date') is-invalid @enderror">
                @error('joining_date')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>Salary</label>
                <input type="text" name="salary" value="{{ $data->salary }}" class="form-control @error('salary') is-invalid @enderror">
                @error('salary')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Address</label>
                <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="5">{{ $data->address }}</textarea>
                @error('address')
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
                <small class="text-danger">Image size must be (560px by 700px)</small><hr>
                <img id="imageEdit" src="#" style="display:none; margin-top: 10px;" width="80" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Old Image</label><br>
                <img src="{{ asset('uploads/employee/'.$data->image) }}" alt="Old Image" width="80" height="80">
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
