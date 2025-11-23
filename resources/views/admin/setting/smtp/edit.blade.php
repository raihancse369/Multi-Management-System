<form method="post" action="{{ route('update.smtp') }}" id="edit_form">
    @csrf
    <div class="row">

        <div class="col-md-4">
            <div class="form-group">
                <input type="hidden" name="id" value="{{ $data->id }}">
                <label for="mailer" class="control-label col-md-8">Mail Mailer</label>
                <input class=" form-control" id="mailer" name="mailer" type="text" value="{{ $data->mailer }}">               
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="host" class="control-label col-md-8">Mail Host</label>
                <input class=" form-control" id="host" name="host" type="text" value="{{ $data->host }}">
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="port" class="control-label">Mail Port</label>
                <input class=" form-control" id="port" name="port" type="text" value="{{ $data->port }}"><br>
                <small class="text-danger">Mail Port Example: 2525</small>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="user_name" class="control-label">Mail Username</label>
                <input class=" form-control" id="user_name" name="user_name" type="text" value="{{ $data->user_name }}"><br>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="password" class="control-label">Mail Password</label>
                <input class=" form-control" id="password" name="password" type="text" value="{{ $data->password }}"><br>
            </div>
        </div>


    </div>


    <div class="modal-footer"> 
        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button> 
        <button type="submit" class="btn btn-primary waves-effect waves-light"><span class="e_loading d-none"> </span>Update</button> 
    </div> 

</form>

<script type="text/javascript">
    
    // Edit Form Submit
    
    $('#edit_form').submit(function(e){
        e.preventDefault();
        $('.e_loading').removeClass('d-none');
        var url = $(this).attr('action');
        var request = $(this).serialize();
        $.ajax({
            url:url,
            type:'post',
            async:false,
            data:request,
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