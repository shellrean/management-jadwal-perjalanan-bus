<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\BusController;
use App\Http\Controllers\Api\SupirController;
use App\Http\Controllers\Api\TerminalController;
use App\Http\Controllers\Api\RuteController;

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

Route::apiResource('buses', BusController::class);
Route::apiResource('supirs', SupirController::class);
Route::apiResource('terminals', TerminalController::class);
Route::apiResource('rutes', RuteController::class);
