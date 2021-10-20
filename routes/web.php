<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\Users\LoginController;
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

Route::get('admin/login',[LoginController::class, 'index'])->name('login');
Route::post('admin/login/store',[LoginController::class, 'store']);


Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function(){
        Route::get('/',[MainController::class, 'index']);
        Route::get('home',[MainController::class, 'index'])->name('admin');

        #menu
        Route::prefix('categories')->group(function(){
            Route::get('add', [CategoryController::class, 'create']);
            Route::post('add', [CategoryController::class, 'store']);
            Route::get('list',[CategoryController::class, 'index']);
            Route::get('edit/{category}',[CategoryController::class, 'show']);
            Route::post('edit/{category}',[CategoryController::class, 'update']);
            Route::delete('destroy',[CategoryController::class, 'destroy']);
        });
    });
});
