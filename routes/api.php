<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HallController;
use App\Http\Controllers\TimeSlotController;

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

// Used for ajax
Route::get('/get_halls', [HallController::class, 'show_halls']);
Route::get('/get_time_slots', [TimeSlotController::class, 'show_time_slots']);
