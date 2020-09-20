<?php

use App\Http\Controllers\ApiController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/login', [ApiController::class, 'login']);
Route::post('/register', [ApiController::class, 'registerFarmer']);
Route::get('/view_prices', [ApiController::class, 'viewGMBPrices']);
Route::get('/distribution/{email}', [ApiController::class, 'viewDistributions']);
Route::post('/register', [ApiController::class, 'registerFarmer']);
Route::post('/yield', [ApiController::class, 'saveYield']);
Route::get('/yield/{email}', [ApiController::class, 'getFarmerYields']);
Route::get('/notifications/{email}', [ApiController::class, 'viewWeatherNotifications']);
