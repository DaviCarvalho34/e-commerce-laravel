<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [App\Http\Controllers\FontendController::class, 'index']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//admin
Route::get('admin/home', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
Route::get('admin', [App\Http\Controllers\Admin\LoginController::class, 'showLoginForm'])->name('login.admin');
Route::post('admin',[App\Http\Controllers\Admin\LoginController::class, 'login']);
Route::get('admin/logout',[App\Http\Controllers\AdminController::class, 'logout'])->name('admin.logout');

#Admin Route
//Category section
Route::get('admin/categories', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('admin.category');
Route::post('admin/categories-store',[App\Http\Controllers\Admin\CategoryController::class,'StoreCat'])->name('store.category');
Route::get('admin/categories/edit/{cat_id}', [App\Http\Controllers\Admin\CategoryController::class, 'Edit']);
Route::post('admin/categories-update',[App\Http\Controllers\Admin\CategoryController::class,'UpdateCat'])->name('update.category');
Route::get('admin/categories/delete/{cat_id}', [App\Http\Controllers\Admin\CategoryController::class, 'Delete']);
Route::get('admin/categories/inactive/{cat_id}', [App\Http\Controllers\Admin\CategoryController::class, 'Inactive']);
Route::get('admin/categories/active/{cat_id}', [App\Http\Controllers\Admin\CategoryController::class, 'Active']);

//Brand
Route::get('admin/brand', [App\Http\Controllers\Admin\BrandController::class, 'index'])->name('admin.brand');
Route::post('admin/brand-store',[App\Http\Controllers\Admin\BrandController::class,'Store'])->name('store.brand');
Route::get('admin/brand/edit/{cat_id}', [App\Http\Controllers\Admin\BrandController::class, 'Edit']);
Route::post('admin/brand-update',[App\Http\Controllers\Admin\BrandController::class,'UpdateBrand'])->name('update.brand');
Route::get('admin/brand/delete/{cat_id}', [App\Http\Controllers\Admin\BrandController::class, 'Delete']);

Route::get('admin/brand/inactive/{cat_id}', [App\Http\Controllers\Admin\BrandController::class, 'Inactive']);
Route::get('admin/brand/active/{cat_id}', [App\Http\Controllers\Admin\BrandController::class, 'Active']);

//Products
Route::get('admin/products/add-products', [App\Http\Controllers\Admin\ProductController::class, 'addProduct'])->name('add-products');
Route::post('admin/products/store',[App\Http\Controllers\Admin\ProductController::class, 'storeProduct'])->name('store-products');
Route::get('admin/products/manage',[App\Http\Controllers\Admin\ProductController::class, 'manageProduct'])->name('manage-products');
Route::get('admin/products/edit/{proudct_id}',[App\Http\Controllers\Admin\ProductController::class, 'editProduct']);
Route::post('admin/products/update', [App\Http\Controllers\Admin\ProductController::class, 'updateProduct'])->name('update-products');
Route::post('admin/products/image-update',[App\Http\Controllers\Admin\ProductController::class, 'updateImage'])->name('update-image');

Route::get('admin/products/delete/{product_id}',[App\Http\Controllers\Admin\ProductController::class, 'destroy']);
Route::get('admin/products/inactive/{product_id}',[App\Http\Controllers\Admin\ProductController::class, 'Inactive']);
Route::get('admin/products/active/{product_id}',[App\Http\Controllers\Admin\ProductController::class, 'Active']);

//Cupon
Route::get('admin/coupon',[App\Http\Controllers\Admin\CouponController::class, 'index'])->name('admin.coupon');
Route::post('admin/coupon-store',[App\Http\Controllers\Admin\CouponController::class, 'Store'])->name('store.coupon');
Route::get('admin/coupon/edit/{coupon_id}',[App\Http\Controllers\Admin\CouponController::class, 'couponEdit']);
Route::post('admin/coupon-update',[App\Http\Controllers\Admin\CouponController::class, 'update'])->name('update.coupon');
Route::get('admin/coupon/delete/{coupon_id}',[App\Http\Controllers\Admin\CouponController::class, 'couponDelete']);
Route::get('admin/coupon/inactive/{coupon_id}',[App\Http\Controllers\Admin\CouponController::class, 'Inactive']);
Route::get('admin/coupon/active/{coupon_id}',[App\Http\Controllers\Admin\CouponController::class, 'Active']);

Route::get('admin/orders',[App\Http\Controllers\Admin\CouponController::class, 'orderIndex'])->name('admin.orders');
Route::get('admin/orders/view/{id}',[App\Http\Controllers\Admin\CouponController::class, 'viewOrder']);

//Cart
Route::post('add/to-cart/{product_id}',[App\Http\Controllers\CartController::class, 'addToCart']);
Route::get('cart',[App\Http\Controllers\CartController::class, 'cartPage']);
Route::get('cart/destroy/{cart_id}',[App\Http\Controllers\CartController::class, 'destroy']);
Route::post('cart/quantity/update/{cart_id}',[App\Http\Controllers\CartController::class, 'quantityUpdate']);
Route::post('coupon/apply',[App\Http\Controllers\CartController::class, 'applyCoupon']);
Route::post('coupon/destroy',[App\Http\Controllers\CartController::class, 'couponDestroy']);

//Wishlist
Route::get('add/to-wishlist/{prouct_id}',[App\Http\Controllers\WishlistController::class, 'addToWishList']);
Route::get('wishlist',[App\Http\Controllers\WishlistController::class, 'wishPage']);
Route::get('wishlist/destroy/{wishlist_id}',[App\Http\Controllers\WishlistController::class, 'destroy']);

//Product
Route::get('product/details/{product_id}',[App\Http\Controllers\FontendController::class, 'productDetail']);

//Checkout
Route::get('checkout', [App\Http\Controllers\CheckoutController::class, 'index']);
Route::post('place/order',[App\Http\Controllers\OrderController::class, 'storeOrder'])->name('place-order');
Route::get('order/success',[App\Http\Controllers\OrderController::class, 'orderSuccess']);
