<form method="post" action="{{ route('update.site') }}" id="edit_form" enctype="multipart/form-data">
    @csrf
    <div class="row">

        <div class="col-md-6">
            <div class="form-group">
                <input type="hidden" name="id" value="{{ $data->id }}">
                <label for="email" class="control-label col-md-8">Email</label>
                <input class=" form-control" id="email" name="email" type="text" value="{{ $data->email }}">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="phone" class="control-label col-md-8">Phone</label>
                <input class=" form-control" id="phone" name="phone" type="text" value="{{ $data->phone }}">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="facebook" class="control-label col-md-8">Facebook</label>
                <input class=" form-control" id="facebook" name="facebook" type="text" value="{{ $data->facebook }}">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="twitter" class="control-label col-md-8">Twitter</label>
                <input class=" form-control" id="twitter" name="twitter" type="text" value="{{ $data->twitter }}">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="youtube" class="control-label col-md-8">Youtube</label>
                <input class=" form-control" id="youtube" name="youtube" type="text" value="{{ $data->youtube }}">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="linkedin" class="control-label col-md-8">Linkedin</label>
                <input class=" form-control" id="linkedin" name="linkedin" type="text" value="{{ $data->linkedin }}">
            </div>
        </div>

    </div>

    <div class="form-group">
        <label for="field-3" class="control-label">New Image</label><br>
        <input type="file" name="image" class="form-control" accept="image/*" onchange="readURL(this);"><br>
        <input type="hidden" name="old_photo" value="{{ $data->image }}">
        <img id="imageEdit" src="#" />
    </div>

    <div class="form-group ">
        <label for="firstname" class="control-label col-md-2">Old Image</label>
        <div class="col-md-12">
            <img src="{{ asset('uploads/logo/'.$data->image) }}" name="old_photo" style="height: 80px; width: 80px;">
        </div>
    </div>

    <div class="modal-footer"> 
        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button> 
        <button type="submit" class="btn btn-primary waves-effect waves-light"><span class="e_loading d-none"> </span>Update</button> 
    </div> 

</form>

<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#imageEdit')
                .attr('src',e.target.result)
                .width(80);
            };
        reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<script type="text/javascript">
    $('#edit_form').submit(function(e){
        e.preventDefault();
        $('.e_loading').removeClass('d-none');
        const fd = new FormData(this);
        $.ajax({
            url: '{{ route('update.site') }}',
            method: 'post',
            data: fd,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success:function(data){
                toastr.success(data);
                $('#edit_form')[0].reset();
                $('.e_loading').addClass('d-none');
                $('#editModal').modal('hide');
                $('.dataTable').DataTable().ajax.reload();
            }
        });
    });
</script>