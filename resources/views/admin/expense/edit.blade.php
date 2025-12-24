<form method="POST" action="{{ route('update.expense', $data->id) }}" id="edit_form">
    @csrf
    @method('PUT') <!-- Method spoofing for RESTful update -->
    <input type="hidden" name="id" value="{{ $data->id }}">

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Expense Type</label>
                <select class="form-control @error('type_id') is-invalid @enderror" name="type_id">
                    @foreach($expensetype as $row)
                        <option value="{{ $row->id }}" {{ $row->id == $data->type_id ? 'selected' : '' }}>{{ $row->type_name }}</option>
                    @endforeach
                </select>
                @error('type_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Amount</label>
                <input type="text" name="amount" value="{{ old('amount', $data->amount) }}" class="form-control @error('amount') is-invalid @enderror">
                @error('amount')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Date</label>
                <input type="text" name="date" value="{{ old('date', $data->date) }}" class="form-control @error('date') is-invalid @enderror">
                @error('date')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Month</label>
                <select class="form-control" name="month">
                    <option value="January" @if($data->month=='January') selected="" @endif >January</option>
                    <option value="February" @if($data->month=='February') selected="" @endif >February</option>
                    <option value="March" @if($data->month=='March') selected="" @endif >March</option>
                    <option value="April" @if($data->month=='April') selected="" @endif >April</option>
                    <option value="May" @if($data->month=='May') selected="" @endif >May</option>
                    <option value="June" @if($data->month=='June') selected="" @endif >June</option>
                    <option value="July" @if($data->month=='July') selected="" @endif >July</option>
                    <option value="August" @if($data->month=='August') selected="" @endif >August</option>
                    <option value="September" @if($data->month=='September') selected="" @endif >September</option>
                    <option value="October" @if($data->month=='October') selected="" @endif >October</option>
                    <option value="November" @if($data->month=='November') selected="" @endif >November</option>
                    <option value="December" @if($data->month=='December') selected="" @endif >December</option>
                </select>
                @error('month')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Description</label>
                    <textarea name="details" id="editsummernote" class="form-control @error('details') is-invalid @enderror" rows="5">{{ $data->details }}</textarea>
                    @error('details')
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

<!-- Summernote Init -->
<script>
    $(document).ready(function() {
        $('#editsummernote').summernote({
            height: 200,
            focus: true
        });
    });
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
                toastr.success(res.message || 'Expense updated successfully.');
                $('#editsummernote').summernote('reset'); // reset summernote editor
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
                    toastr.error('Category not found.');
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
