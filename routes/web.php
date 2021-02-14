<?php

use App\Log;
use App\Hill;
use App\Trip;
use App\User;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    // user logged in
    if( Auth::check() ) {
        return view( 'homepage', [
            'trips' => Trip::latest()->take(3)->get(),
            'users' => User::all(),
            'hills' => Hill::all(),
        ] );
    }

    return view( 'welcome' );
})->name( 'welcome' );

Auth::routes();


Route::get('hills/filter', 'HillController@filter');
Route::resource('hills', 'HillController');

Route::get('trips/filter', 'TripController@filter');
Route::resource('trips', 'TripController');


Route::get( 'users/filter', 'UserController@filter' );
Route::resource('users', 'UserController')->only([
    'index', 'show', 'edit', 'store', 'update'
]);
Route::resource('mountains', 'MountainController');


Route::get( 'my-profile', function() {
    return view( 'users.show', [
        'user'  => Auth::user(),
        'hills' => Hill::all()
    ] );
} )->middleware( 'auth' );


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get( '/hills/{hill}/track', 'HillController@track' );


Route::post( '/hills/{hill}/track', 'LogController@log' );
Route::post( '/trips/tracking', 'TripController@handle_tracking_trip' );

Route::resource('userhillwishlist', 'UserHillWishlistController');


Route::get('images', 'ImageController@index');
