<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SliderController;
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
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
