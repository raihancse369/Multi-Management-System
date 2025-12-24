<form method="post" action="" id="edit_form">

    @csrf
    <input type="hidden" name="id" value="{{ $data->id }}">

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>User Name</label>
                <input type="text" name="user_name" value="{{ $data->user_name }}" class="form-control @error('user_name') is-invalid @enderror" readonly>
                @error('user_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Review Date</label>
                <input type="text" name="review_date" value="{{ $data->review_date }}" class="form-control @error('review_date') is-invalid @enderror" readonly>
                @error('review_date')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>Rating</label>
                <input type="text" name="rating" value="{{ $data->rating }}" class="form-control @error('rating') is-invalid @enderror" readonly>
                @error('rating')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Review</label>
                <textarea name="review" id="editsummernote" class="form-control @error('review') is-invalid @enderror" rows="5" readonly>{{ $data->review }}</textarea>
                @error('review')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Product Image</label>
                <div>
                    @if($data->product_image)
                        <img src="{{ asset('uploads/product/'.$data->product_image) }}" alt="Product Image" height="100">
                    @else
                        <span class="text-muted">No image available</span>
                    @endif
                </div>
            </div>
        </div>
    </div>



    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

    </div>
</form>
