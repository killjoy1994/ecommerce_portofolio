<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/categories', 'categories');
    Route::get('/categories/{categories_slug}', 'products');
    Route::get('/filter', 'filterProducts')->name('products.filter');
    Route::get('/categories/{categories_slug}/{product_slug}', 'productDetail');
});

Route::controller(CartController::class)->group(function() {
    Route::get('/cart', 'index')->middleware(['auth']);
    Route::post('/cart', 'store')->middleware(['auth']);
    Route::post('/delete-cart-item', 'destroyProduct')->middleware(['auth']);
    Route::post('/update-cart', 'updateCart')->middleware(['auth']);
});

Route::middleware(['auth'])->group(function() {
    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/orders/{id}', [OrderController::class, 'orderDetail']);
});

Route::get('/checkout', [CheckoutController::class, 'index'])->middleware(['auth']);
Route::post('/place-order', [CheckoutController::class, 'store'])->middleware(['auth']);

Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/create', [CategoryController::class, 'create']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit']);
    Route::put('/categories/{id}', [CategoryController::class, 'update']);
    Route::get('/categories/{id}/delete', [CategoryController::class, 'destroy']);

    Route::get('/brands', [BrandController::class, 'index']);
    Route::get('/brands/create', [BrandController::class, 'create']);
    Route::post('/brands', [BrandController::class, 'store']);

    Route::get('/getbrand', [ProductController::class, 'getBrand']);

    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/create', [ProductController::class, 'create']);
    Route::post('/products', [ProductController::class, 'store']);
    Route::get('/products/{id}/edit', [ProductController::class, 'edit']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::get('/products/{id}/delete', [ProductController::class, 'destroy']);

    Route::get('/product-image/{id}/delete', [ProductController::class, 'destroyImage']);

    Route::get('/sliders', [SliderController::class, 'index']);
    Route::get('/sliders/create', [SliderController::class, 'create']);
    Route::post('/sliders', [SliderController::class, 'store']);
    Route::get('/sliders/{id}/edit', [SliderController::class, 'edit']);
    Route::put('/sliders/{id}', [SliderController::class, 'update']);
    Route::get('/sliders/{id}/delete', [SliderController::class, 'destroy']);

    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/create', [UserController::class, 'create']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{id}/edit', [UserController::class, 'edit']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::get('/users/{id}/delete', [UserController::class, 'destroy']);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
