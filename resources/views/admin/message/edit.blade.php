<form method="post" action="" id="edit_form">

    @csrf
    <input type="hidden" name="id" value="{{ $data->id }}">

    <div class="row">

        <div class="col-md-6">
            <div class="form-group">
                <label>User Name</label>
                <input type="text" name="name" value="{{ $data->name }}" class="form-control @error('name') is-invalid @enderror" readonly>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Email Address</label>
                <input type="text" name="email" value="{{ $data->email }}" class="form-control @error('email') is-invalid @enderror" readonly>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">
            <div class="form-group">
                <label>Subject</label>
                <input type="text" name="subject" value="{{ $data->subject }}" class="form-control @error('subject') is-invalid @enderror" readonly>
                @error('subject')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Message</label>
                <textarea name="message" id="editsummernote" class="form-control @error('message') is-invalid @enderror" rows="5" readonly>{{ $data->message }}</textarea>
                @error('message')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    </div>
</form>
