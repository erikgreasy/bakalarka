<?php

use App\Hill;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiControllers\LogController;
use App\Http\Controllers\ApiControllers\AuthController;
use App\Http\Controllers\ApiControllers\HillController;
use App\Http\Controllers\ApiControllers\TripController;
use App\Http\Controllers\ApiControllers\UserController;
use App\Http\Controllers\ApiControllers\MountainController;
use App\Http\Controllers\ApiControllers\WishlistController;

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
// Route::post('/login', [AuthController::class, 'login']);
// Route::post('/register', [AuthController::class, 'register']);

Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::get('/hills', [HillController::class, 'index']);
    Route::get('/wishlists', [WishlistController::class, 'index']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/logs', [LogController::class, 'store']);

});

Route::get('/user', function (Request $request) {
    return new UserResource( $request->user() );
});

Route::get('/hill/{id}', [HillController::class, 'show']);
Route::post('/hill/{id}/wishlist', [WishlistController::class, 'store']);
Route::get('/hill/{id}/wishlist', [WishlistController::class, 'show']);
Route::delete('/hill/{id}/wishlist', [WishlistController::class, 'destroy']);


Route::get( '/mountains', [MountainController::class, 'index']);

Route::get('/trips', [TripController::class, 'index']);
Route::get('/trip/{id}', [TripController::class, 'show']);
Route::post( '/trips', [TripController::class, 'store'] );
Route::put('/trip/{id}', [TripController::class, 'update']);
Route::delete('/trip/{id}', [TripController::class, 'destroy']);
Route::post('/end-trip', [TripController::class, 'endTrip']);



Route::get('/users', [UserController::class, 'index']);
Route::get('/user/{id}', [UserController::class, 'show']);
Route::put('/user/{id}', [UserController::class, 'update']);
Route::get('/users/top', [UserController::class, 'topUsers']);
