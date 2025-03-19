<?php

use App\Http\Controllers\FrontendCotroller;
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


Route::get('/', function () {
    $error = 0;
    return view('auth.login')->with('error', $error);
});

Route::post('/auth', [FrontendCotroller::class, 'login'])->name('login');

Route::post('/auth/register', [FrontendCotroller::class, 'register'])->name('register');

Route::post('/logout', [FrontendCotroller::class, 'logout'])->name('logout');
Route::get('/index', [FrontendCotroller::class, 'index'])->name('index');

Route::get('/products', [FrontendCotroller::class, 'products'])->name('products');
Route::post('/delete/product', [FrontendCotroller::class, 'deleteProduct'])->name('deleteP');
Route::post('/store/product', [FrontendCotroller::class, 'storeProduct'])->name('storeP');
Route::post('/update/product', [FrontendCotroller::class, 'updateProduct'])->name('updateP');



Route::get('/orders', [FrontendCotroller::class, 'Orders'])->name('orders');
Route::post('/delete/order', [FrontendCotroller::class, 'deleteOrder'])->name('deleteO');
Route::post('/update/order', [FrontendCotroller::class, 'updateOrder'])->name('updateO');
Route::post('/store/order', [FrontendCotroller::class, 'storeOrders'])->name('storeO');

Route::get('/register', function () {
    $error = 0;
    return view('auth.register')->with('error', $error);
});
