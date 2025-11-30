<form action="{{ route('update.role', $user->id) }}" method="POST" id="edit_form">
    @csrf
    @method('PUT') <!-- Method spoofing for RESTful update -->
    <input type="hidden" name="id" value="{{ $user->id }}">

    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" value="{{ $user->name }}" class="form-control">
    </div>

    <div class="form-group mt-2">
        <label>Email</label>
        <input type="email" name="email" value="{{ $user->email }}" class="form-control">
    </div>

    <hr>
    <h6 class="fw-bold text-secondary mb-2">Permissions</h6>

    <div class="row g-3">
        @php
            $permissions = ['setting','page','category','product','offer','orders','message','blog','hrm','attendance','payroll','expense','role'];
        @endphp
        @foreach($permissions as $perm)
            <div class="col-md-3 col-6">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="{{ $perm }}" value="1" 
                        {{ $user->$perm == 1 ? 'checked' : '' }}>
                    <label class="form-check-label text-capitalize">{{ $perm }}</label>
                </div>
            </div>
        @endforeach
    </div>

    <div class="modal-footer mt-4">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary submit_edit_button">
            <span class="btn-text">Update Role</span>
            <span class="loading d-none"><i class="fa fa-spinner fa-spin"></i></span>
        </button>
    </div>
</form>

<script>
    $('#edit_form').on('submit', function (e) {
        e.preventDefault();
        const form = $(this);
        const btn = form.find('.submit_edit_button');
        const loading = btn.find('.loading');
        const btnText = btn.find('.btn-text');
        const formData = new FormData(this);

        btn.prop('disabled', true);
        loading.removeClass('d-none');
        btnText.addClass('d-none');

        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                toastr.success(res.message || 'Updated successfully');
                $('#editModal').modal('hide');
                $('.dataTable').DataTable().ajax.reload(null, false);
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    for (const key in errors) {
                        toastr.error(errors[key][0]);
                    }
                } else {
                    toastr.error('Something went wrong.');
                }
            },
            complete: function () {
                btn.prop('disabled', false);
                loading.addClass('d-none');
                btnText.removeClass('d-none');
            }
        });
    });
</script>
