<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/users/{id}/photo', [App\Http\Controllers\HomeController::class, 'updatePhoto'])->name('users.updatePhoto');
Route::post('/shipping/update', [App\Http\Controllers\HomeController::class, 'UpdateShipping'])->name('update.shipping');

Route::get('/customer/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('customer.logout');


Route::group(['namespace'=>'App\Http\Controllers\Frontend'], function(){


    Route::get('/','IndexController@index');
    Route::get('/product-details/{slug}','IndexController@ProductDetails')->name('product.details');
    Route::get('/product-quick-view/{id}','IndexController@ProductQuickView');

    //__campaign__//
    Route::get('/campain/products/{id}','IndexController@CampaignProduct')->name('frontend.campaign.product');   
    Route::get('/camapign-product-details/{slug}','IndexController@CampaignProductDetails')->name('campaign.product.details');

    //cart
    Route::get('/all-cart','CartController@AllCart')->name('all.cart'); //ajax request for subtotal
    Route::get('/my-cart','CartController@MyCart')->name('cart');
    Route::get('/cart/empty','CartController@EmptyCart')->name('cart.empty');
    Route::get('/cart-product/remove/{rowId}','CartController@RemoveProduct');

    Route::get('/checkout','CheckoutController@Checkout')->name('checkout');
    Route::post('/apply/coupon','CheckoutController@ApplyCoupon')->name('apply.coupon');
    Route::get('/remove/coupon','CheckoutController@RemoveCoupon')->name('coupon.remove');
    Route::post('/order/place','CheckoutController@OrderPlace')->name('order.place');

    Route::post('/addtocart','CartController@AddToCartQV')->name('add.to.cart.quickview');

    Route::get('/cartproduct/updateqty/{rowId}/{qty}','CartController@updateQuantity');

    Route::post('/cart-update','CartController@CartUpdate')->name('cart.update');
    Route::post('/cart-update-option','CartController@UpdateOption')->name('cart.updateoption');

        

    //wishlist
    Route::get('/wishlist','CartController@wishlist')->name('wishlist');
    Route::get('/clear/wishlist','CartController@Clearwishlist')->name('clear.wishlist');
    Route::get('/add/wishlist/{id}','CartController@AddWishlist')->name('add.wishlist');
    Route::get('/wishlist/product/delete/{id}','CartController@WishlistProductdelete')->name('wishlistproduct.delete');


    //Custom page view
    Route::get('/page/{page_slug}','IndexController@ViewPage')->name('view.page');

    //page view
    Route::get('/blog/{slug}/','IndexController@BlogPage')->name('blog-single.page');

    Route::get('/about','IndexController@About')->name('about');
    Route::get('/news','IndexController@Blog')->name('news');
    Route::get('/service','IndexController@Service')->name('service');
    Route::get('/project','IndexController@Project')->name('project');
    Route::get('/contact','IndexController@Contact')->name('contact-us');
    Route::post('/contact/message','IndexController@ContactMessage')->name('contact.message');

    //setting profile
    Route::get('/home/setting','ProfileController@setting')->name('customer.setting'); 
    Route::post('/home/password/update','ProfileController@PasswordChange')->name('customer.password.change');

    Route::get('/my/order','ProfileController@MyOrder')->name('my.order'); 
    Route::get('/view/order/{id}','ProfileController@ViewOrder')->name('view.order'); 

    //user review for product
    Route::post('/store/review','ReviewController@store')->name('store.review');

    Route::get('/write/review','ReviewController@write')->name('write.review');
    Route::post('/store/website/review','ReviewController@StoreWebsiteReview')->name('store.website.review');

    //support ticket
    Route::get('/open/ticket','ProfileController@ticket')->name('open.ticket');
    Route::get('/new/ticket','ProfileController@NewTicket')->name('new.ticket');
    Route::post('/store/ticket','ProfileController@StoreTicket')->name('store.ticket');
    Route::get('/show/ticket/{id}','ProfileController@ticketShow')->name('show.ticket');
    Route::post('/reply/ticket','ProfileController@ReplyTicket')->name('reply.ticket');

});
