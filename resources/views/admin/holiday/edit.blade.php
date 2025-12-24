<form method="POST" action="{{ route('update.holiday', $data->id) }}" id="edit_form">
    @csrf
    @method('PUT') <!-- Method spoofing for RESTful update -->
    <input type="hidden" name="id" value="{{ $data->id }}">

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Holiday Type</label>
                <select class="form-control" name="type">
                  <option value="Offday" @if($data->type=='Offday') selected="" @endif >Offday</option>
                  <option value="Holiday" @if($data->type=='Holiday') selected="" @endif >Holiday</option>
                </select>
                @error('type')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Holiday Name</label>
                <input type="text" name="name" value="{{ $data->name }}" class="form-control @error('name') is-invalid @enderror">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label>From</label>
                <input type="date" name="from" value="{{ $data->from }}" class="form-control startdate @error('from') is-invalid @enderror">
                @error('from')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>To</label>
                <input type="date" name="to" value="{{ $data->to }}" class="form-control enddate  @error('to') is-invalid @enderror">
                @error('to')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>Total Days</label>
                <input type="text" name="num_of_days" value="{{ $data->num_of_days }}" class="form-control numofdays @error('num_of_days') is-invalid @enderror" readonly>
                @error('num_of_days')
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
