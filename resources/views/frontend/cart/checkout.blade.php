@extends('layouts.app')
@section('content')

<main class="py-5">

    <div class="container">
        <h2 class="mb-4">Shopping Cart</h2>

        <div class="row">
            {{-- Billing Address --}}
            <div class="col-lg-8 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white text-center">
                        Billing Address
                    </div>
                    <div class="card-body">
                        <form action="{{ route('order.place') }}" method="post" id="order-place">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Customer Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="c_name" value="{{ Auth::user()->name }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Phone <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="c_phone" value="{{ Auth::user()->phone }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Country <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="c_country" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Shipping Address <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="c_address" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Email Address</label>
                                    <input type="email" class="form-control" name="c_email">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Zip Code <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="c_zipcode" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>City <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="c_city" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Extra Phone</label>
                                    <input type="text" class="form-control" name="c_extra_phone">
                                </div>

                                {{-- Payment Methods --}}
                                <div class="col-12 mt-3">
                                    <label class="d-block">Payment Method</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="payment_type" value="Hand Cash" checked>
                                        <label class="form-check-label">Hand Cash</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="payment_type" value="Aamarpay">
                                        <label class="form-check-label">Bkash/Rocket/Nagad</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="payment_type" value="Paypal">
                                        <label class="form-check-label">Paypal</label>
                                    </div>
                                </div>

                                <div class="col-12 mt-4 text-center">
                                    <button type="submit" class="btn btn-primary btn-lg">Place Order</button>
                                    <span class="progress d-none ms-3">Processing...</span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Order Summary --}}
            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-info text-white">
                        Order Summary
                    </div>
                    <div class="card-body">
                        <p>Subtotal: <span class="float-end">{{ Cart::subtotal() }}</span></p>

                        @if(Session::has('coupon'))
                            <p>Coupon ({{ Session::get('coupon')['name'] }}) <a href="{{ route('coupon.remove') }}" class="text-danger">X</a>
                                <span class="float-end">{{ Session::get('coupon')['discount'] }}</span>
                            </p>
                        @endif

                        <p>Tax: <span class="float-end">0.00 %</span></p>
                        <p>Shipping: <span class="float-end">0.00</span></p>
                        <hr>
                        <p class="fw-bold">Total:
                            <span class="float-end">
                                @if(Session::has('coupon'))
                                    {{ Session::get('coupon')['after_discount'] }}
                                @else
                                    {{ Cart::subtotal() }}
                                @endif
                            </span>
                        </p>

                        @if(!Session::has('coupon'))
                        <form action="{{ route('apply.coupon') }}" method="post" class="mt-3">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="coupon" class="form-control" placeholder="Coupon Code" required>
                                <button class="btn btn-outline-secondary" type="submit">Apply</button>
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

<script src="{{ asset('web/assets/js/jquery-3.5.1.min.js') }}"></script>
<script>
    // Show progress on submit
    $('#order-place').submit(function() {
        $('.progress').removeClass('d-none');
    });

    // AJAX for cart updates
    function ajaxCartUpdate(url) {
        $.get(url, function(data) {
            toastr.success(data);
            location.reload();
        });
    }

    $('body').on('click', '.remove-product', function() {
        ajaxCartUpdate('{{ url("cartproduct/remove/") }}/' + $(this).data('id'));
    });

    $('body').on('blur', '.qty', function() {
        ajaxCartUpdate('{{ url("cartproduct/updateqty/") }}/' + $(this).data('id') + '/' + $(this).val());
    });

    $('body').on('change', '.color', function() {
        ajaxCartUpdate('{{ url("cartproduct/updatecolor/") }}/' + $(this).data('id') + '/' + $(this).val());
    });

    $('body').on('change', '.size', function() {
        ajaxCartUpdate('{{ url("cartproduct/updatesize/") }}/' + $(this).data('id') + '/' + $(this).val());
    });
</script>

@endsection
