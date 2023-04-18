<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Api\AuthController;
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

// route to get the sanctum csrf token
Route::get('/sanctum/csrf-cookie', function (Request $request) {
    return response()->json([
        'csrf_token' => csrf_token(),
    ]);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::apiResource('events', EventsController::class)->middleware('auth:sanctum');

// Route::post('/create', [EventsController::class,'store'])->middleware('auth:sanctum');
Route::get('/auth/events', [EventsController::class,'index']);

