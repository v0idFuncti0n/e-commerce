<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CouponController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// for test purposes
Route::get('/test', function () {
    $to_name = 'Anas';
    $to_email = 'lakchouchanas@gmail.com';
    $data = array('name' => 'Anas', 'body' => 'A test mail');
    Mail::send('welcome', $data, function ($message) use ($to_name, $to_email) {
        $message->to($to_email, $to_name)
            ->subject('Laravel Test Mail');
        $message->from(env('MAIL_USERNAME'), 'Test Mail');
    });
    return '';
});



/*Route::get('/404', function () {
    return view('frontpage.cart');
})->name('404');*/

Route::group(['middleware' => ['is_authenticated', 'role:admin'], 'prefix' => 'admin'], function () {

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'showDashboard'])->name('admin.dashboard');


    Route::group(['prefix' => 'categories'], function () {
        // categories routes
        Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories');
        Route::post('/categories/store', [CategoryController::class, 'store'])->name('admin.categories.store');
        Route::delete('/categories/delete/{id}', [CategoryController::class, 'delete'])->name('admin.categories.delete');
        Route::put('/categories/update/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');

        Route::post('/get-sub-categories/{id}',[CategoryController::class, 'getSubCategories'])->name('admin.categories.getSubCategories');

        // sub categories routes
        Route::get('/sub-categories', [SubCategoryController::class, 'index'])->name('admin.subCategories');
        Route::post('/sub-categories', [SubCategoryController::class, 'index'])->name('admin.subCategories');
        Route::post('/sub-categories/store', [SubCategoryController::class, 'store'])->name('admin.subCategories.store');
        Route::delete('/sub-categories/delete/{id}', [SubCategoryController::class, 'delete'])->name('admin.subCategories.delete');
        Route::put('/sub-categories/update/{id}', [SubCategoryController::class, 'update'])->name('admin.subCategories.update');
    });

    // product routes
    Route::group(['prefix' => 'products'], function () {
        Route::get('/all', [ProductController::class, 'index'])->name('admin.products');
        Route::get('/create', [ProductController::class, 'create'])->name('admin.products.create');
        Route::post('/store', [ProductController::class, 'store'])->name('admin.products.store');
        Route::delete('/delete/{id}', [ProductController::class, 'delete'])->name('admin.products.delete');
        Route::post('/edit/{id}', [ProductController::class, 'edit'])->name('admin.products.edit');
        Route::post('/update/{id}', [ProductController::class, 'update'])->name('admin.products.update');
        Route::post('/toggle-status/{id}', [ProductController::class, 'toggleStatus'])->name('admin.products.status');
        Route::get('/get-product-images/{id}', [ProductController::class, 'getImages'])->name('admin.products.images');
    });

    // coupon
    Route::get('/coupons', [CouponController::class, 'Coupon'])->name('admin.coupons');
    Route::post('/coupons/store', [CouponController::class, 'StoreCoupon'])->name('admin.coupon.store');

    //order
    Route::get('/orders', [\App\Http\Controllers\OrdersController::class, 'adminShowAllOrders'])->name('admin.orders');
    Route::get('/orders/orders-items/{id}', [\App\Http\Controllers\OrdersController::class, 'adminShowOrdersItems'])->name('admin.orders.items');
    Route::post('/orders/ship/{id}', [\App\Http\Controllers\OrdersController::class, 'shipOrder'])->name('admin.orders.ship');



});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// For Clear cache
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

Route::delete('/coupons/delete/{id}', [CouponController::class, 'deletecoupon'])->name('admin.coupon.delete');
Route::put('/coupons/update/{id}', [CouponController::class, 'EditCoupon'])->name('admin.coupon.update');

Route::get('/product/{product}', [\App\Http\Controllers\HomeController::class, 'showProduct'])->name('showProduct');
Route::post('/product', [\App\Http\Controllers\HomeController::class, 'showSearchProduct'])->name('showSearchProduct');

Route::post('/cart/data/store/{id}', [\App\Http\Controllers\CartController::class, 'addToCart'])->name('addToCart');
Route::post('/cart/data/remove/{rowId}/{productId}', [\App\Http\Controllers\CartController::class, 'removeFromCart'])->name('removeFromCart');
Route::get('/cart/showCart', [\App\Http\Controllers\HomeController::class, 'showCart'])->name('showCart');
Route::post('/cart/incrementItem/{rowId}/{id}', [\App\Http\Controllers\CartController::class, 'incrementItem'])->name('incrementItem');
Route::post('/cart/decrementItem/{rowId}/{id}', [\App\Http\Controllers\CartController::class, 'decrementItem'])->name('decrementItem');

Route::post('stripe/order', [\App\Http\Controllers\StripeController::class, 'stripeOrder'])->name('stripe.order');

Route::post('/product/apply-coupon', [\App\Http\Controllers\CartController::class, 'applyCoupon'])->name('apply-coupon');
Route::post('/product/remove-coupon', [\App\Http\Controllers\CartController::class, 'removeCoupon'])->name('remove-coupon');

Route::get('/my-orders', [\App\Http\Controllers\OrdersController::class, 'showOrders'])->name('show.orders');
Route::get('/my-orders/order-items/{id}', [\App\Http\Controllers\OrdersController::class, 'showOrdersItems'])->name('show.orders.items');

//PDF invoice
Route::post('/orders/pdf', [\App\Http\Controllers\OrdersController::class, 'downloadInvoicePDF'])->name('admin.orders.invoice');

// 404 for undefined routes
/*Route::any('/{page?}', function () {
    return View::make('pages.error-pages.error-404');
})->where('page', '.*');*/

Route::redirect('/', '/products');
Route::redirect('/products', '/products/all');
Route::get('/products/{category?}/{subCategory?}', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

