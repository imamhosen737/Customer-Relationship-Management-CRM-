<?php

use Illuminate\Http\Request;
use App\Http\Controllers\GanntChart;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstimateController;

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
Route::get('/project/{id}', [GanntChart::class, 'show']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/get_item/{id}', [EstimateController::class, 'getItem']);
