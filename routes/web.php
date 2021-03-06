<?php

use App\Http\Controllers\Admin\CartController as AdminCartController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController as ControllersCategoryController;
use App\Http\Controllers\MainController as ControllersMainController;
use App\Http\Controllers\ProductController as ControllersProductController;
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

Route::get('admin/login',[LoginController::class, 'index'])->name('login');
Route::post('admin/login/store',[LoginController::class, 'store']);


Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function(){
        Route::get('/',[MainController::class, 'index']);
        Route::get('home',[MainController::class, 'index'])->name('admin');

        #category
        Route::prefix('categories')->group(function(){
            Route::get('add', [CategoryController::class, 'create']);
            Route::post('add', [CategoryController::class, 'store']);
            Route::get('list',[CategoryController::class, 'index']);
            Route::get('edit/{category}',[CategoryController::class, 'show']);
            Route::post('edit/{category}',[CategoryController::class, 'update']);
            Route::delete('destroy',[CategoryController::class, 'destroy']);
        });

        #product
        Route::prefix('products')->group(function(){
            Route::get('add', [ProductController::class, 'create']);
            Route::post('add', [ProductController::class, 'store']);
            Route::get('list',[ProductController::class, 'index']);
            Route::get('edit/{product}',[ProductController::class, 'show']);
            Route::post('edit/{product}',[ProductController::class, 'update']);
            Route::delete('destroy',[ProductController::class, 'destroy']);
        });
        
        #slider
        Route::prefix('sliders')->group(function(){
            Route::get('add', [SliderController::class, 'create']);
            Route::post('add', [SliderController::class, 'store']);
            Route::get('list',[SliderController::class, 'index']);
            Route::get('edit/{slider}',[SliderController::class, 'show']);
            Route::post('edit/{slider}',[SliderController::class, 'update']);
            Route::delete('destroy',[SliderController::class, 'destroy']);
        });

        #upload
        Route::post('upload/services', [UploadController::class, 'store']);

        #cart
        Route::get('carts/customer', [AdminCartController::class, 'index']);
        Route::get('carts/customers/view/{customer}', [AdminCartController::class, 'show']);
        Route::post('carts/customers/view/{customer}',[AdminCartController::class, 'update']);
    });
});

Route::get('/', [ControllersMainController::class, 'index']);

Route::post('/services/load-product', [ControllersMainController::class, 'loadProduct']);

Route::get('category/{id}-{slug}.html', [ControllersCategoryController::class, 'index']);
Route::get('product/{id}-{slug}.html', [ControllersProductController::class, 'index']);

Route::post('add-cart', [CartController::class, 'index']);
Route::get('carts', [CartController::class, 'show']);
Route::post('update-cart', [CartController::class, 'update']);
Route::get('carts/delete/{id}', [CartController::class, 'remove']);
Route::post('carts', [CartController::class, 'addCart']);
