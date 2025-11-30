<style>
   /* Loader Spinner */
   .loader {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      border: 8px solid #f3f3f3;
      border-top: 8px solid #3498db;
      border-radius: 50%;
      width: 50px;
      height: 50px;
      z-index: 9999;
      animation: spin 1s linear infinite;
   }

   @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
   }

   .modal-body {
      padding: 20px;
   }

   .product-image img {
      max-width: 100%;
      height: auto;
      object-fit: cover;
   }

   .form-control-sm {
      font-size: 0.875rem;
   }

   .loading {
      font-size: 12px;
      margin-left: 5px;
   }
</style>

@php
   $color = explode(',', $product->color);
   $sizes = explode(',', $product->size);
@endphp

{{-- Loader --}}
<div class="loader"></div>

{{-- Product Quick View --}}
<div class="modal-body product_view d-none">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-5 product-image mb-3">
            <img src="{{ asset('uploads/product/'.$product->thumbnail) }}" alt="{{ $product->name }}">
         </div>
         <div class="col-md-7">
            <h4 class="mb-2">{{ $product->name }}</h4>
            <p class="text-muted mb-1">
               Category : {{ $product->category_name ?? $product->category->name ?? 'N/A' }}
            </p>
            <p class="text-muted mb-1">
               Subcategory : {{ $product->subcategory_name ?? $product->subcategory->subcategory_name ?? 'N/A' }}
            </p>
            <p class="mb-1">Brand : {{ $product->brand_name ?? $product->brand->brand_name ?? 'N/A' }}</p>
            <p>
               Stock : 
               @if($product->stock_quantity < 1)
                  <span class="badge bg-danger">Out of Stock</span>
               @else
                  <span class="badge bg-success">In Stock</span>
               @endif
            </p>

            <div class="mb-3">
               @if($product->discount_price == NULL)
                  <span class="h5">Price: ${{ $product->selling_price }}</span>
               @else
                  <span class="h5 text-success"><del class="text-danger">${{ $product->selling_price }}</del> ${{ $product->discount_price }}</span>
               @endif
            </div>

            {{-- Add to Cart Form --}}
            <form action="{{ route('add.to.cart.quickview') }}" method="POST" id="add_cart_form">
               @csrf
               <input type="hidden" name="id" value="{{ $product->id }}">

               @if($product->discount_price==NULL)
               <input type="hidden" name="price" value="{{ $product->selling_price }}">
               @else
               <input type="hidden" name="price" value="{{$product->discount_price}}">
               @endif
               <div class="row">
                  <div class="col-4 mb-2">
                     <label>Quantity</label>
                     <input type="number" name="qty" min="1" max="{{ $product->stock_quantity }}" value="1" class="form-control form-control-sm">
                  </div>

                  @if(!empty($product->color))
                  <div class="col-4 mb-2">
                     <label>Color</label>
                     <select name="color" class="form-control form-control-sm">
                        @foreach($color as $c)
                           <option value="{{ $c }}">{{ $c }}</option>
                        @endforeach
                     </select>
                  </div>
                  @endif

                  @if(!empty($product->size))
                  <div class="col-4 mb-3">
                     <label>Size</label>
                     <select name="size" class="form-control form-control-sm">
                        @foreach($sizes as $size)
                           <option value="{{ $size }}">{{ $size }}</option>
                        @endforeach
                     </select>
                  </div>
                  @endif

                  <div class="col-12">
                     @if($product->stock_quantity > 0)
                        <button type="submit" class="btn btn-primary btn-sm">
                           Add to Cart <span class="loading d-none">...</span>
                        </button>
                     @else
                        <button type="button" class="btn btn-secondary btn-sm" disabled>Out of Stock</button>
                     @endif
                  </div>
               </div>

               
            </form>
         </div>
      </div>
   </div>
</div>

{{-- Loader Removal --}}
<script>
   $(document).ready(function () {
      setTimeout(function () {
         $('.loader').fadeOut();
         $('.product_view').removeClass('d-none');
      }, 500);
   });
</script>

{{-- Add to Cart AJAX --}}
<script>
   $('#add_cart_form').submit(function (e) {
      e.preventDefault();

      const form = $(this);
      const button = form.find('button[type="submit"]');
      $('.loading').removeClass('d-none');
      button.prop('disabled', true);

      $.ajax({
         url: form.attr('action'),
         type: 'POST',
         data: form.serialize(),
         dataType: 'json',
         processData: true,
         success: function (response) {
            $('.loading').addClass('d-none');
            button.prop('disabled', false);

            if (response.success) {
               toastr.success(response.success);
               form[0].reset();
               cart();
            } else if (response.error) {
               toastr.error(response.error);
               if (response.redirect) {
                  setTimeout(() => window.location.href = response.redirect, 1200);
               }
            } else {
               toastr.warning('Unexpected response from server.');
            }
         },
         error: function (xhr) {
            $('.loading').addClass('d-none');
            button.prop('disabled', false);

            if (xhr.status === 422) {
               const errors = xhr.responseJSON.errors;
               for (let field in errors) {
                  toastr.error(errors[field][0]);
               }
            } else if (xhr.status === 401) {
               toastr.error('Please login to continue.');
               setTimeout(() => window.location.href = "{{ route('login') }}", 1000);
            } else {
               toastr.error('Something went wrong. Please try again.');
            }
         }
      });
   });
</script>

