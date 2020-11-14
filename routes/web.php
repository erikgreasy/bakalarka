<?php

use App\Hill;
use App\User;
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
    return view( 'homepage' );
})->middleware('auth');


Route::resource('hills', 'HillController');
Route::resource('trips', 'TripController');
Route::resource('users', 'UserController');

Route::get( 'my-profile', function() {
    return view( 'users.show', [
        'user'  => Auth::user()
    ] );
} );
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::get('images', 'ImageController@index');