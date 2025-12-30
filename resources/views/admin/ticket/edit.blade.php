<form method="post" action="{{ route('admin.store.reply') }}" enctype="multipart/form-data">
    @csrf
    <div class="row">

        <div class="col-md-12">
            <div class="form-group">
                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                <label for="message" class="control-label">Message</label>
                <textarea class="form-control" rows="5" name="message" >{{ $ticket->message }}</textarea>
            </div>
        </div>
        <hr>

        <strong class="text-center text-success"> -- Reply Message -- </strong><br>
        @php 
            $replies=DB::table('replies')->where('ticket_id',$ticket->id)->orderBy('id','DESC')->get();
        @endphp

        <div class="col-md-12">
            <div class="form-group"><br><hr>
                
                @isset($replies)    
                   @foreach($replies as $row)
                    <div class="card mt-1 @if($row->user_id==0) ml-4 @endif">
                      <div class="card-header @if($row->user_id==0) bg-info @else bg-danger @endif ">
                       <i class="fa fa-user"></i> @if($row->user_id==0) Admin @else {{ $ticket->name }} @endif
                      </div>
                      <div class="card-body">
                        <blockquote class="blockquote mb-0">
                          <p>{{ $row->message }}</p>
                          <footer class="blockquote-footer">{{ date('d F Y'),strtotime($row->reply_date) }}</footer>
                        </blockquote>
                      </div>
                    </div>
                  @endforeach   
                @endisset
            </div>
        </div>


    </div>


    <div class="modal-footer"> 
        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button> 
        <button type="submit" class="btn btn-primary waves-effect waves-light"><span class="e_loading d-none"> </span>Reply Message</button> 
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