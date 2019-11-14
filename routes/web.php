<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/incoming_data', function () {
    return response(
        json_encode(\App\IncomingData::all(['frame', 'created_at'])->toArray(), JSON_PRETTY_PRINT),
        200, 
        [
            'Content-Type' => 'Text/Plain'
        ]
    );
});