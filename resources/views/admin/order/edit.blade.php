<form action="{{ route('update.order') }}" method="post" id="edit_form">
    @csrf
    <div class="row">

        <div class="col-md-6">
            <div class="form-group">
                <input type="hidden" name="id" value="{{ $order->id }}">
                <label for="c_name" class="control-label col-md-8">Name</label>
                <input class=" form-control" id="c_name" name="c_name" type="text" value="{{ $order->c_name }}">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="c_email" class="control-label col-md-8">Email</label>
                <input class=" form-control" id="c_email" name="c_email" type="text" value="{{ $order->c_email }}">
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-md-6">
            <div class="form-group">
                <label for="c_phone" class="control-label col-md-8">Phone</label>
                <input class=" form-control" id="c_phone" name="c_phone" type="text" value="{{ $order->c_phone }}">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="c_email" class="control-label col-md-8">Order Status</label>
                <select class="form-control" name="status">
                   <option value="0" @if($order->status==0) selected @endif>Pending</option>
                    <option value="1" @if($order->status==1) selected @endif>Completed</option>
                    <option value="2" @if($order->status==2) selected @endif>Shipped</option>
                    <option value="3" @if($order->status==3) selected @endif>Recieved</option>
                    <option value="4" @if($order->status==4) selected @endif>Return</option>
                    <option value="5" @if($order->status==5) selected @endif>Cancel</option> 
                </select>
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