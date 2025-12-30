<form method="post" action="{{ route('update.page') }}" id="edit_form">
    @csrf
    <div class="row">

        <div class="col-md-6">
            <div class="form-group">
                <input type="hidden" name="id" value="{{ $data->id }}">
                <label for="page_name" class="control-label col-md-8">Page Name</label>
                <input class=" form-control" id="page_name" name="page_name" type="text" value="{{ $data->page_name }}">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="title" class="control-label">Page Position</label>
                <select class="form-control" name="page_position">
                  <option value="1" @if($data->page_position==1) selected="" @endif >Line One</option>
                  <option value="2" @if($data->page_position==2) selected="" @endif >Line Two</option>
                </select>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="page_title" class="control-label col-md-8">Page Title</label>
                <input class=" form-control" id="page_title" name="page_title" type="text" value="{{ $data->page_title }}">
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="page_description" class="control-label">Description</label>
                <textarea class="form-control" id="editsummernote" rows="5" name="page_description">{{ $data->page_description }}</textarea>
            </div>
        </div>

    </div>


    <div class="modal-footer"> 
        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button> 
        <button type="submit" class="btn btn-primary waves-effect waves-light"><span class="e_loading d-none"> </span>Update</button> 
    </div> 

</form>


<script type="text/javascript">
    $(document).ready(function() {
        $('#editsummernote').summernote({
            height: 200,
            minHeight: null,
            maxHeight: null,
            focus: true
        });
    });
</script>

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