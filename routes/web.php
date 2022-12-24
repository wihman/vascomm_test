<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth as Auth;
use App\Http\Controllers\AuthController;

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
Route::get('/', [\App\Http\Controllers\PublicController::class, 'index'])->name('home.index');
Route::get('/public/banner', [\App\Http\Controllers\PublicController::class, 'dataBanner'])->name('home.banner');
Route::get('/public/product', [\App\Http\Controllers\PublicController::class, 'dataProduct'])->name('home.dataproduct');
Route::post('/public/registeruser', [\App\Http\Controllers\PublicController::class, 'registerUser'])->name('home.registeruser');

Route::get('/loginuser', [\App\Http\Controllers\PublicController::class, 'loginUser'])->name('auth.loginuser');
Route::post('/loginuser', [\App\Http\Controllers\PublicController::class, 'loginUserPost'])->name('auth.loginuserpost');

Route::get('/admin/', [AuthController::class, 'showFormLogin'])->name('login');
Route::get('/login', [AuthController::class, 'showFormLogin']);
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/profile', [\App\Http\Controllers\PublicController::class, 'profile'])->name('profile');

    Route::prefix('admin')->middleware(['auth', 'admin'])->group(function() {
        Route::view('/app/{path}', 'main')
            ->where('path', '^(?!api|css|jpg|png).*$')
            ->name('main');

        Route::get('/api/products', [\App\Http\Controllers\ProductController::class, 'index']);
        Route::post('/api/products', [\App\Http\Controllers\ProductController::class, 'store']);
        Route::post('/api/products/{id}', [\App\Http\Controllers\ProductController::class, 'update']);
        Route::delete('/api/products/{id}', [\App\Http\Controllers\ProductController::class, 'destroy']);

        Route::get('/api/banner', [\App\Http\Controllers\BannerController::class, 'index']);
        Route::post('/api/banner', [\App\Http\Controllers\BannerController::class, 'store']);
        Route::post('/api/banner/{id}', [\App\Http\Controllers\BannerController::class, 'update']);
        Route::delete('/api/banner/{id}', [\App\Http\Controllers\BannerController::class, 'destroy']);

        Route::get('/api/users', [\App\Http\Controllers\CustomerController::class, 'index']);
        Route::post('/api/users/approve/{id}', [\App\Http\Controllers\CustomerController::class, 'approve']);
        Route::post('/api/users/reject/{id}', [\App\Http\Controllers\CustomerController::class, 'reject']);
    });
});

Auth::routes();
