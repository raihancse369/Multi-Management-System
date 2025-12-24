<form action="{{ route('users.updatePhoto', auth()->user()->id) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="card shadow-sm border-0" style="max-width: 400px; margin: 30px auto; border-radius: 10px;">
        <div class="card-header bg-primary text-white text-center" style="border-top-left-radius: 10px; border-top-right-radius: 10px;">
            <h5 class="mb-0">Welcome, {{ Auth::user()->name }} 👋</h5>
        </div>

        <div class="card-body text-center">

            {{-- Profile photo section --}}
            <div class="mb-3 position-relative">
                <div class="profile-img-wrapper" style="position: relative; display: inline-block;">
                    <img id="previewImage" src="{{ auth()->user()->photo ? asset('uploads/user/' . auth()->user()->photo) : asset('uploads/default.png') }}" alt="User photo" class="rounded-circle shadow-sm border" width="120" height="120" style="object-fit: cover;">
                    
                    <label for="photo" class="btn btn-sm btn-primary position-absolute" 
                        style="bottom: 0; right: 0; border-radius: 50%; padding: 8px 10px;">
                        <i class="fa fa-camera"></i>
                        <input type="file" name="photo" id="photo" accept="image/*" hidden>
                    </label>
                </div>
                <p class="mt-2 text-muted small">Click the camera to change your photo</p>
            </div>

            <button type="submit" class="btn btn-success btn-sm px-4 mt-2">
                <i class="fa fa-upload"></i> Update Photo
            </button>
        </div>

        <ul class="list-group list-group-flush text-start">
            <a href="{{ route('home') }}" class="list-group-item list-group-item-action">
                <i class="fa fa-home me-2 text-primary"></i> Dashboard
            </a>
            <a href="{{ route('wishlist') }}" class="list-group-item list-group-item-action">
                <i class="fa fa-heart me-2 text-danger"></i> Wishlist
            </a>
            <a href="{{ route('my.order') }}" class="list-group-item list-group-item-action">
                <i class="fa fa-shopping-cart me-2 text-success"></i> My Orders
            </a>
            <a href="{{ route('customer.setting') }}" class="list-group-item list-group-item-action">
                <i class="fa fa-cog me-2 text-secondary"></i> Settings
            </a>
            <a href="{{ route('open.ticket') }}" class="list-group-item list-group-item-action">
                <i class="fa fa-ticket me-2 text-info"></i> Open Ticket
            </a>
            <a href="{{ route('customer.logout') }}" class="list-group-item list-group-item-action text-danger">
                <i class="fa fa-sign-out me-2"></i> Logout
            </a>
        </ul>
    </div>
</form>

{{-- Live preview script --}}
<script>
document.getElementById('photo').addEventListener('change', function(event) {
    let reader = new FileReader();
    reader.onload = function(){
        document.getElementById('previewImage').src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
});
</script>
