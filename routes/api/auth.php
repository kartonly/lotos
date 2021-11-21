<?php

use Illuminate\Support\Facades\Route;

Route::post('login', 'LoginController');
Route::post('register', 'RegisterController');
Route::post('logout', 'LogoutController')->middleware('auth');

Route::group(['prefix' => 'rooms'], function () {
    Route::get('/','\App\Http\Controllers\API\User\RoomsController@index');
    Route::get('/{room}','\App\Http\Controllers\API\User\RoomsController@item');
    Route::post('/booking/{room}','\App\Http\Controllers\API\User\RoomsController@booking')->middleware('auth');
    Route::get('/booking/{room}','\App\Http\Controllers\API\User\RoomsController@bookingGet');
    Route::post('/booking/checksum/{room}','\App\Http\Controllers\API\User\RoomsController@checkSum');
    Route::post('/booking','\App\Http\Controllers\API\User\RoomsController@dates');
    Route::post('/services','\App\Http\Controllers\API\User\RoomsController@getServices');
});
