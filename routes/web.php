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

Route::get('/', [AuthController::class, 'showFormLogin'])->name('login');
Route::get('/login', [AuthController::class, 'showFormLogin']);
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::view('/app/{path}', 'main')
    ->where('path', '^(?!api|css|jpg|png).*$')
    ->name('main');
});

Auth::routes();
