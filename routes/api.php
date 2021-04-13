<?php

use App\Hill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiControllers\HillController;
use App\Http\Controllers\ApiControllers\TripController;
use App\Http\Controllers\ApiControllers\UserController;
use App\Http\Controllers\ApiControllers\MountainController;

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

Route::get('/hills', [HillController::class, 'index']);
Route::get('/hill/{id}', [HillController::class, 'show']);


Route::get( '/mountains', [MountainController::class, 'index']);

Route::get('/trips', [TripController::class, 'index']);
Route::get('/trip/{id}', [TripController::class, 'show']);
Route::post( '/trips', [TripController::class, 'store'] );


Route::get('/users', [UserController::class, 'index']);
Route::get('/user/{id}', [UserController::class, 'show']);
Route::get('/current-user', [UserController::class, 'currentUserId']);
