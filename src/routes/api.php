<?php

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

use App\Http\Controllers\HealthCheckController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\ZipController;

Route::middleware('api')
    ->get('health-check', '\\' . HealthCheckController::class . '@index')
    ->name('api.health-check');

Route::group(['middleware' => ['api'], 'prefix' => 'v1'], function () {

    Route::get('zip/code/{code}', '\\' . ZipController::class . '@showByZip')
        ->where('code', '\d{1,5}')
        ->name('api.v1.zip.show');

    Route::get('zip/city/{city}', '\\' . ZipController::class . '@showByCity')
        ->where('city', '[\w\s]+')
        ->name('api.v1.city.show');

    Route::post('import/file-csv', '\\' . ImportController::class . '@store')
        ->name('api.v1.import');

});
