<?php

use App\Http\Controllers\ApiGatewayController;
use App\Http\Controllers\ApiGatewayOrderController;
use App\Http\Controllers\ApiGatewayProductcController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use MongoDB\Client;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->middleware(['api', 'jwt.verify'])->group(function () {
    Route::prefix('products')->group(function () {
        //rutas de productos
        Route::get('/', [ApiGatewayProductcController::class, 'products']);
        Route::get('/low', [ApiGatewayProductcController::class, 'getLowProducts']);
        Route::post('/store', [ApiGatewayProductcController::class, 'storeProduct']);
        Route::get('/{id}', [ApiGatewayProductcController::class, 'showProduct']);
        Route::put('/{id}', [ApiGatewayProductcController::class, 'updateProduct']);
        Route::delete('/{id}', [ApiGatewayProductcController::class, 'deleteProduct']);
    });

    Route::prefix('orders')->group(function () {
        //rutas de ordenes
        Route::get('/', [ApiGatewayOrderController::class, 'Order']);
        Route::post('/store', [ApiGatewayOrderController::class, 'storeOrder']);
        Route::get('/{id}', [ApiGatewayOrderController::class, 'showOrder']);
        Route::put('/{id}', [ApiGatewayOrderController::class, 'updateOrder']);
        Route::delete('/{id}', [ApiGatewayOrderController::class, 'deleteOrder']);
    });
    Route::get('/token', [ApiGatewayController::class, 'checkToken']);
});
//rutas de autenticacion
Route::prefix('v1/auth')->group(function () {
    Route::post('/login', [ApiGatewayController::class, 'login']);
    Route::post('/logout', [ApiGatewayController::class, 'logout']);
    Route::post('/register', [ApiGatewayController::class, 'register']);
});
