<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Web\AdminController;
use App\Http\Controllers\Web\CropController;
use App\Http\Controllers\Web\DistributionController;
use App\Http\Controllers\Web\DistrictController;
use App\Http\Controllers\Web\ExpertController;
use App\Http\Controllers\Web\FarmController;
use App\Http\Controllers\Web\FarmerController;
use App\Http\Controllers\Web\GMBPriceController;
use App\Http\Controllers\Web\PerfomingFarmerController;
use App\Http\Controllers\Web\SoilTypeController;
use App\Http\Controllers\Web\WeatherController;
use App\Http\Controllers\Web\YieldController;
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

//Route::get('/', 'AuthController@index')->name('index');
Route::group(['middleware'=>'guest'],function () {
    Route::get('/', [AuthController::class, 'index'])->name('index');
    Route::post('/', [AuthController::class, 'login'])->name('login');

});

Route::group(['middleware'=>'auth'],function () {
    Route::resource('admin',AdminController::class);
    Route::resource('crop',CropController::class);
    Route::resource('soil_type',SoilTypeController::class);
    Route::resource('district',DistrictController::class);
    Route::resource('farm',FarmController::class);
    Route::resource('farmer',FarmerController::class);
    Route::resource('gmb',GMBPriceController::class);
    Route::resource('distribution',DistributionController::class);
    Route::resource('weather',WeatherController::class);
    Route::resource('expert',ExpertController::class);
    Route::resource('yield',YieldController::class);
    Route::resource('pf',PerfomingFarmerController::class);


    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
