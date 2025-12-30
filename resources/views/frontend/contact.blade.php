@extends('layouts.app')
@section('content')

  <main>
  <div class="page-banner bg-img bg-img-parallax overlay-dark" style="background-image: url({{ asset('/web/assets') }}/img/smoke.jpg);">
      <div class="container h-100">
          <div class="row justify-content-center align-items-center h-100">
            <div class="col-lg-8">
              <nav aria-label="breadcrumb">

              </nav>
              <h1 class="fg-white text-center">Contact</h1>
            </div>
          </div>
      </div>
    </div> <!-- .page-banner -->

    <div class="page-section">
      <div class="container">
        <div class="text-center">
          <h2 class="title-section mb-3">Stay in touch</h2>
          <p>Don’t Hesitate to contact with us <a href="" class="text-decoration-none">for any kind of information</a></p>
        </div>
        <div class="row justify-content-center mt-5">
          <div class="col-lg-8">
            <form action="{{ route('contact.message') }}" class="form-contact" method="POST" id="add_form">
              @csrf
              <div class="row">
                <div class="col-sm-6 py-2">
                  <label for="name" class="fg-grey">Name</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter name..">
                    @error('name')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-sm-6 py-2">
                  <label for="email" class="fg-grey">Email</label>
                  <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email address..">
                    @error('email')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 py-2">
                  <label for="subject" class="fg-grey">Subject</label>
                  <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" placeholder="Subject..">
                    @error('email')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 py-2">
                  <label for="message" class="fg-grey">Message</label>
                  <textarea id="message" rows="8" class="form-control @error('message') is-invalid @enderror" name="message" placeholder="Enter message.."></textarea>
                    @error('message')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 mt-3">
                  <button type="submit" class="btn btn-primary submit_button px-5">
                    <span class="btn-text">Submit</span>
                    <span class="loading d-none"><i class="fa fa-spinner fa-spin"></i></span>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div> <!-- .container -->
    </div> <!-- .page-section -->

    <div class="maps-container">
      <div id="google-maps"></div>
    </div>
  </main>

  <!-- Scripts -->
<script src="{{ asset('admin/js/jquery.min.js') }}"></script>

<script>
    $(document).ready(function () {

        // Create form submit
        $('#add_form').on('submit', function (e) {
            e.preventDefault();

            const form = $(this);
            const btn = form.find('.submit_button');
            const loading = btn.find('.loading');
            const btnText = btn.find('.btn-text');
            const formData = new FormData(this);

            // Reset validation messages
            form.find('.is-invalid').removeClass('is-invalid');
            form.find('.text-danger').remove();

            btn.prop('disabled', true);
            loading.removeClass('d-none');
            btnText.addClass('d-none');

            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (res) {
                    toastr.success(res.message || 'Message Send Successfully');
                    form[0].reset();
                    $('#con-close-modal').modal('hide');
                    table.ajax.reload();
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        for (const key in errors) {
                            const input = form.find('[name="'+key+'"]');
                            input.addClass('is-invalid');
                            input.after('<span class="text-danger">' + errors[key][0] + '</span>');
                            toastr.error(errors[key][0]);
                        }
                    } else if (xhr.status === 404) {
                        toastr.error('Resource not found.');
                    } else if (xhr.status === 500) {
                        toastr.error('Something wrong Please try again later.');
                    } else {
                        toastr.error('At first login your account.');
                    }
                },

                complete: function () {
                    btn.prop('disabled', false);
                    loading.addClass('d-none');
                    btnText.removeClass('d-none');
                }
            });
        });

    });
</script>

@endsection