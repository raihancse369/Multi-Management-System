<form method="POST" action="{{ route('update.leave', $data->id) }}" id="edit_form">
    @csrf
    @method('PUT') <!-- Method spoofing for RESTful update -->
    <input type="hidden" name="id" value="{{ $data->id }}">

    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label>Employee - ID</label>
                <select class="form-control" name="employee_id">
                @foreach($employee as $row)
                    <option value="{{ $row->id }}" @if($row->id==$data->employee_id) selected="" @endif >{{ $row->name .'-'.$row->employee_id }}</option>
                @endforeach
                </select>
                @error('employee_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>Leave Type</label>
                <select class="form-control" name="type_id">
                    @foreach($leavetype as $row)
                        <option value="{{ $row->id }}" @if($row->id==$data->type_id) selected="" @endif >{{ $row->type_name }}</option>
                    @endforeach
                </select>
                @error('type_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="status">
                  <option value=1 @if($data->status==1) selected="" @endif >Approved</option>
                  <option value=0 @if($data->status==0) selected="" @endif >Pending</option>
                  <option value=2 @if($data->status==2) selected="" @endif >Declined</option>
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
                <label>From</label>
                <input type="date" name="start_date" value="{{ $data->start_date }}" class="form-control startdate @error('start_date') is-invalid @enderror">
                @error('start_date')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>To</label>
                <input type="date" name="end_date" value="{{ $data->end_date }}" class="form-control enddate @error('end_date') is-invalid @enderror">
                @error('end_date')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>Total Days</label>
                <input type="text" name="leave_day" value="{{ $data->leave_day }}" class="form-control numofdays @error('leave_day') is-invalid @enderror" readonly onkeydown="return false;">
                @error('leave_day')
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
<script type="text/javascript">
    $(document).ready(function () {
        function dateDiffInDays(date1, date2) {
            if (isNaN(date1) || isNaN(date2)) return 0;
            return Math.round((date2 - date1) / (1000 * 60 * 60 * 24));
        }

        function calculateTotalDays() {
            console.log('Date changed'); // Debug log
            let startdate = $('.startdate').val();
            let enddate = $('.enddate').val();

            if (startdate && enddate) {
                let start = new Date(startdate);
                let end = new Date(enddate);

                if (!isNaN(start) && !isNaN(end)) {
                    let diff = dateDiffInDays(start, end);
                    $('.numofdays').val(diff + 1); // including both start and end
                } else {
                    $('.numofdays').val('');
                }
            } else {
                $('.numofdays').val('');
            }
        }

        // Use delegated binding to support dynamically inserted inputs
        $(document).on('change', '.startdate, .enddate', function () {
            calculateTotalDays();
        });

        // Also run on page load
        calculateTotalDays();
    });
</script>
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
