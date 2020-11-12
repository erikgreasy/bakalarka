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

Route::get('/profile', function () {
    return view( 'profile', [
        'user'  => Auth::user()
    ] );
})->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/users', function() {
    return view('users', [
        'users'     => User::all()
    ]);
});