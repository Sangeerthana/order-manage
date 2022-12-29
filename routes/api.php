<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/user-register', [App\Http\Controllers\Auth\siteAuthController::class, 'userRegister']);
Route::post('/user-auth', [App\Http\Controllers\Auth\siteAuthController::class, 'userAuth']);



Route::get('/get-orders', [App\Http\Controllers\Order\OrderActionController::class, 'getOrders']);
Route::get('/get-ebay-orders', [App\Http\Controllers\Order\EbayOrderController::class, 'ebay_GetOrders']);
Route::get('/test', [App\Http\Controllers\Order\OrderActionController::class, 'test']);

Route::post('/add-item', [App\Http\Controllers\AdditemController::class, 'addChannel']);

Route::get('/get-allorders', [App\Http\Controllers\Orders\OrdersActionController::class, 'getAllOrders']);
Route::post('/get-alldata', [App\Http\Controllers\Orders\OrdersActionController::class, 'getData']);



Route::get('/get-allstatus', [App\Http\Controllers\Order\OrderActionController::class, 'getAllStatus']);
Route::get('/get-allchannel', [App\Http\Controllers\Order\OrderActionController::class, 'getAllChannel']);
Route::get('/get-allflags', [App\Http\Controllers\Order\OrderActionController::class, 'getAllFlags']);
Route::post('/get-graphdata', [App\Http\Controllers\Order\OrderActionController::class, 'getGraphData']);
Route::post('/get-summary', [App\Http\Controllers\Order\OrderActionController::class, 'getOrdersSummary']);
