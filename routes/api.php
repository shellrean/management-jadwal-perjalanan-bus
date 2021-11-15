<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\BusController;

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

Route::get('buses', [BusController::class, 'index']);
Route::post('buses', [BusController::class, 'store']);
Route::get('buses/{bus}', [BusController::class, 'show']);
Route::put('buses/{bus}', [BusController::class, 'update']);
Route::delete('buses/{bus}' , [BusController::class, 'destroy']);
