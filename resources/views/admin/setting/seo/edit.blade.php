<form method="post" action="{{ route('update.seo') }}" id="edit_form">
    @csrf
    <div class="row">

        <div class="col-md-6">
            <div class="form-group">
                <input type="hidden" name="id" value="{{ $data->id }}">
                <label for="meta_title" class="control-label col-md-8">Meta Title</label>
                <input class=" form-control" id="meta_title" name="meta_title" type="text" value="{{ $data->meta_title }}">               
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="meta_author" class="control-label col-md-8">Meta Author</label>
                <input class=" form-control" id="meta_author" name="meta_author" type="text" value="{{ $data->meta_author }}">
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="meta_tag" class="control-label">Meta Tags</label>
                <input class=" form-control" id="meta_tag" name="meta_tag" type="text" value="{{ $data->meta_tag }}">
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="meta_keyword" class="control-label">Meta Keyword</label>
                <input class=" form-control" id="meta_keyword" name="meta_keyword" type="text" value="{{ $data->meta_keyword }}"><br>
                <small class="text-danger">Example: ecommerce,online shop,online market</small>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="meta_description" class="control-label">Meta Description</label>
                <textarea class="form-control" rows="5" name="meta_description">{{ $data->meta_description }}</textarea>
            </div>
        </div>

        <strong class="text-center text-success"> -- Other Option -- </strong><br>

        <div class="col-md-12">
            <div class="form-group">
                <label for="google_verification" class="control-label col-md-8">Google Verification</label>
                <input class=" form-control" id="google_verification" name="google_verification" type="text" value="{{ $data->google_verification }}">
                <small class="text-info">Put here only verification code</small>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="alexa_verification" class="control-label col-md-8">Alexa verification</label>
                <input class=" form-control" id="alexa_verification" name="alexa_verification" type="text" value="{{ $data->alexa_verification }}">
                <small class="text-info">Put here only verification code</small>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="google_analytics" class="control-label col-md-8">Google Analytics</label>
                <textarea class="form-control" rows="5" name="google_analytics">{{ $data->google_analytics }}</textarea>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="google_adsense" class="control-label col-md-8">Google Adsense</label>
                <textarea class="form-control" rows="5" name="google_adsense">{{ $data->google_adsense }}</textarea>
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