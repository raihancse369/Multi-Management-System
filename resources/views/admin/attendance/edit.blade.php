<form method="post" action="{{ route('update.attendance') }}" id="edit_form">
    @csrf
    <input type="hidden" name="att_date" value="{{ $edit_date }}">

    <input type="hidden" name="att_month" value="{{ \Carbon\Carbon::parse($edit_date)->format('F') }}">
    <input type="hidden" name="att_year" value="{{ \Carbon\Carbon::parse($edit_date)->format('Y') }}">


    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Photo</th>
                <th>Attendance</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $key => $row)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $row->name }}</td>
                    <td><img src="{{ asset('uploads/employee/'.$row->image) }}" width="50" class="rounded-circle"></td>
                    <td>
                        <input type="hidden" name="id[]" value="{{ $row->id }}">
                        <label><input type="radio" name="status[{{ $row->id }}]" value="Present" {{ $row->status == 'Present' ? 'checked' : '' }}> Present</label>
                        <label class="ms-2"><input type="radio" name="status[{{ $row->id }}]" value="Absence" {{ $row->status == 'Absence' ? 'checked' : '' }}> Absence</label>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">
            <span class="btn-text">Update</span>
            <span class="e_loading d-none"><i class="fa fa-spinner fa-spin"></i></span>
        </button>
    </div>
</form>

<script>
$('#edit_form').submit(function(e){
    e.preventDefault();
    const form = $(this);
    const loading = form.find('.e_loading');
    const btnText = form.find('.btn-text');
    const submitBtn = form.find('button[type="submit"]');

    loading.removeClass('d-none');
    btnText.addClass('d-none');
    submitBtn.prop('disabled', true);

    $.ajax({
        url: form.attr('action'),
        method: 'POST',
        data: form.serialize(),
        success: function(response){
            toastr.success(response.message || 'Updated successfully.');
            setTimeout(()=>$('#editModal').modal('hide'),500);
            $('.dataTable').DataTable().ajax.reload();
        },
        error: function(){
            toastr.error('Something went wrong.');
        },
        complete: function(){
            loading.addClass('d-none');
            btnText.removeClass('d-none');
            submitBtn.prop('disabled', false);
        }
    });
});
</script>
