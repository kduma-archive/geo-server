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

Route::get('/positions', function (\Illuminate\Http\Request $request) {
    return \App\Http\Resources\PositionResource::collection(\App\Position::latest('time')->with('Locator')->paginate(100));
});
Route::get('/position', function (\Illuminate\Http\Request $request) {
    $positions = \App\Position::latest('time')->with('Locator')->take(99)->get();
    $pos = $positions->first();
    
    $counter = 1;
    $pins = $positions->map(function (\App\Position $position) use (&$counter) {
        $pin_class = ($position->is_from_gsm ? 'pm2wtm' : 'pm2rdm').$counter++;
        return "{$position->longitude},{$position->latitude},{$pin_class}";
    })->reverse()->implode('~');
        
    return response(<<<HTML
<body style="text-align: center">
<img style="max-width: 100%" width="650" src="https://static-maps.yandex.ru/1.x/?lang=en-US&ll={$pos->longitude},{$pos->latitude}&z=12&l=map,trf&size=650,450&pt={$pins}" alt="Yandex Map of {$pos->longitude},{$pos->latitude}">
</body>
HTML
    );
});

Route::get('/incoming_data', function () {
    return response(
        json_encode(\App\IncomingData::all(['frame', 'created_at'])->toArray(), JSON_PRETTY_PRINT),
        200, 
        [
            'Content-Type' => 'Text/Plain'
        ]
    );
});