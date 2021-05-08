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

// Route::get('/', function () {
//     // user logged in
//     if( Auth::check() ) {
//         return view( 'homepage', [
//             'trips' => Trip::latest()->take(3)->get(),
//             'most_distance' => User::take(1)->withCount(['trips as distance' => function($query) {
//                 $query->select(DB::raw('sum(distance)'));
//             }])->orderBy('distance', 'DESC')->get()[0],
//             'most_trips'    => User::take(1)->withCount('trips')->orderBy( 'trips_count', 'desc' )->get()[0],
//             'most_time'     => User::take(1)->withCount(['trips as duration' => function($query) {
//                 $query->select(DB::raw('sum(duration)'));
//             }])->orderBy('duration', 'DESC')->get()[0],
//             'hills' => Auth::user()->getWishlistHills(),
//         ] );
//     }

//     return view( 'welcome' );
// })->name( 'welcome' );
// Route::get('/', function() {
//     return view('home');
// });

Auth::routes();


// Route::get('hills/filter', 'HillController@filter');
// Route::resource('hills', 'HillController');

// Route::get('trips/filter', 'TripController@filter');
// Route::resource('trips', 'TripController');


// Route::get( 'users/filter', 'UserController@filter' );
// Route::resource('users', 'UserController')->only([
//     'index', 'show', 'edit', 'store', 'update'
// ]);
// Route::resource('mountains', 'MountainController');


// Route::get( 'my-profile', function() {
//     // Call function from controller
//     return App::call('App\Http\Controllers\UserController@show', ['user' => Auth::user()]);
// } )->middleware( 'auth' );


// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/offline', function() {
//     return view('offline');
// });

// Route::get( '/hills/{hill}/track', 'HillController@track' );


// Route::post( '/hills/{hill}/track', 'LogController@log' );
// Route::post( '/trips/tracking', 'TripController@handle_tracking_trip' );

// Route::resource('userhillwishlist', 'UserHillWishlistController');


// Route::get('images', 'ImageController@index');

// Route::post( '/trips/{trip}/end-trip', 'TripController@addDuration' );
// Route::get('/login', function() {
//     return view('auth.login');
// })->name('login');

// Route::get('/register', function() {
//     return view('auth.register');
// })->name('register');
Route::get('/app-shell', function() {
    return view('home');
});

Route::get('/offline', function() {
    return view('offline');
});


Route::get('{any}', function () {
    
    return view('home');
    
})->where('any', '.*')->middleware('auth:sanctum'); 
