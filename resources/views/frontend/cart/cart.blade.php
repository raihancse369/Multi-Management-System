@extends('layouts.app')
@section('content')

<!-- Cart Section -->
<div class="container my-5">
    <h2 class="text-left mb-4">Shopping Cart</h2>

    <!-- Cart Table -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Product</th>
                    <th>Color</th>
                    <th>Size</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($content as $row)
                @php
                    $product = DB::table('products')->where('id', $row->id)->first();
                    $colors = $product && $product->color ? explode(',', $product->color) : [];
                    $sizes = $product && $product->size ? explode(',', $product->size) : [];
                @endphp
                <tr>
                    <td>
                        <img src="{{ asset('uploads/product/'.$product->thumbnail) }}" alt="{{ $row->name }}" class="img-fluid" width="100">
                        {{ substr($row->name, 0, 15) }}..
                    </td>
                    
                    <!-- Color -->
                    <td>
                        @if(!empty($colors))
                        <select class="form-control form-control-sm color" name="color" data-id="{{ $row->rowId }}">
                            @foreach($colors as $color)
                                <option value="{{ trim($color) }}" @if(trim($color) == $row->options->color) selected @endif>{{ trim($color) }}</option>
                            @endforeach
                        </select>
                        @else
                            N/A
                        @endif
                    </td>
                    
                    <!-- Size -->
                    <td>
                        @if(!empty($sizes))
                        <select class="form-control form-control-sm size" name="size" data-id="{{ $row->rowId }}">
                            @foreach($sizes as $size)
                                <option value="{{ trim($size) }}" @if(trim($size) == $row->options->size) selected @endif>{{ trim($size) }}</option>
                            @endforeach
                        </select>
                        @else
                            N/A
                        @endif
                    </td>


                    <!-- Quantity -->
                    <td>
                        <input type="number" class="form-control qty" name="qty" value="{{ $row->qty }}" data-id="{{ $row->rowId }}" min="1" max="{{ $product->stock_quantity }}" required>
                    </td>

                    <!-- Price -->
                    <td> {{ $row->price }} x {{$row->qty }}</td>

                    <!-- Total -->
                    <td>{{ $row->qty*$row->price }}</td>

                    <!-- Action -->
                    <td>
                        <button class="btn-sm btn-sm btn-danger remove-product" data-id="{{ $row->rowId }}">Remove</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table><br><br>
    </div>

    <!-- Cart Total -->
    <div class="row">
        <div class="col-md-6 offset-md-6">
            <div class="cart-total">
                <p class="h4">Order Total: <span> {{ Cart::subtotal() }}</span></p><br>
                <a href="{{ route('cart.empty') }}" class="btn btn-danger btn-block mb-3">Empty Cart</a>
                <a href="{{ route('checkout') }}" class="btn btn-success btn-block">Checkout</a>
            </div>
        </div>
    </div>
</div>




<script src="{{ asset('web') }}/assets/js/jquery-3.5.1.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.qty').on('change', function() {
            var $input = $(this);
            var rowId = $input.data('id');
            var qty = parseInt($input.val());
            var min = parseInt($input.attr('min'));
            var max = parseInt($input.attr('max'));

            // Validate quantity limits
            if (qty < min) {
                alert('Quantity cannot be less than ' + min);
                $input.val(min);
                qty = min;
            } else if (qty > max) {
                alert('Quantity cannot be more than available stock (' + max + ')');
                $input.val(max);
                qty = max;
            }

            // Send AJAX request to update cart quantity
            $.ajax({
                url: '{{ route("cart.update") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    rowId: rowId,
                    qty: qty
                },
                success: function(response) {
                    // Update price cell (price x qty)
                    var row = $('input.qty[data-id="' + rowId + '"]').closest('tr');
                    row.find('td:nth-child(5)').text(response.price + ' x ' + response.qty);
                    // Update total cell
                    row.find('td:nth-child(6)').text(response.total);
                    // Update subtotal
                    $('.cart-total span').text(response.subtotal);
                },
                error: function(xhr) {
                    alert(xhr.responseJSON?.error || 'Failed to update quantity');
                }
            });
        });
    });


    // Remove Product
$('body').on('click', '.remove-product', function() {
    let rowId = $(this).data('id');
    let row = $(this).closest('tr');

    $.ajax({
        url: '{{ url('cart-product/remove') }}/' + rowId,
        type: 'GET',
        success: function(response) {
            if (response.success) {
                toastr.success(response.success);
                // Remove the row immediately for smoother UX
                row.remove();

                // Wait a short time before reloading totals
                setTimeout(() => {
                    location.reload();
                }, 800);
            } else if (response.error) {
                toastr.error(response.error);
            }
        },
        error: function(xhr) {
            toastr.error(xhr.responseJSON?.error || 'Failed to remove product. Please try again.');
        }
    });
});



    function updateCartRowId(row, newRowId, price, qty, total, subtotal) {
    row.find('.qty').data('id', newRowId);
    row.find('.color').data('id', newRowId);
    row.find('.size').data('id', newRowId);
    row.find('.remove-product').data('id', newRowId);

    row.find('td:nth-child(5)').text(price + ' x ' + qty);
    row.find('td:nth-child(6)').text(total);
    $('.cart-total span').text(subtotal);
}

// Handle color change
$('body').on('change', '.color', function () {
    var $select = $(this);
    var row = $select.closest('tr');
    var rowId = $select.data('id');
    var color = $select.val();

    $.ajax({
        url: '{{ route("cart.updateoption") }}',
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            rowId: rowId,
            option: 'color',
            value: color
        },
        success: function (response) {
            toastr.success('Color updated successfully');
            if (response.newRowId) {
                updateCartRowId(row, response.newRowId, response.price, response.qty, response.total, response.subtotal);
            }
        },
        error: function (xhr) {
            toastr.error(xhr.responseJSON?.error || 'Failed to update color');
        }
    });
});

// Handle size change
$('body').on('change', '.size', function () {
    var $select = $(this);
    var row = $select.closest('tr');
    var rowId = $select.data('id');
    var size = $select.val();

    $.ajax({
        url: '{{ route("cart.updateoption") }}',
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            rowId: rowId,
            option: 'size',
            value: size
        },
        success: function (response) {
            toastr.success('Size updated successfully');
            if (response.newRowId) {
                updateCartRowId(row, response.newRowId, response.price, response.qty, response.total, response.subtotal);
            }
        },
        error: function (xhr) {
            toastr.error(xhr.responseJSON?.error || 'Failed to update size');
        }
    });
});



</script>



@endsection
