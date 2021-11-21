<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'users'], function () {
    Route::get('/','\App\Http\Controllers\API\Admin\UsersController@index');
    Route::get('{user}','\App\Http\Controllers\API\Admin\UsersController@item');
    Route::put('{user}/update','\App\Http\Controllers\API\Admin\UsersController@update');
    Route::post('{user}/delete', '\App\Http\Controllers\API\Admin\UsersController@update');
    Route::get('userrole','\App\Http\Controllers\API\Admin\UsersController@users');
});

Route::group(['prefix' => 'rooms'], function () {
    Route::get('/','\App\Http\Controllers\API\Admin\RoomsController@index');
    Route::get('/{room}','\App\Http\Controllers\API\Admin\RoomsController@item');
    Route::post('/disabled/{room}','\App\Http\Controllers\API\Admin\RoomsController@disabled');
    Route::delete('/delete/{room}','\App\Http\Controllers\API\Admin\RoomsController@delete');
});

Route::group(['prefix' => 'bookings'], function () {
    Route::get('/','\App\Http\Controllers\API\Admin\BookingsController@index');
    Route::get('/{booking}','\App\Http\Controllers\API\Admin\BookingsController@item');
    Route::post('/disabled/{booking}','\App\Http\Controllers\API\Admin\BookingsController@disabled');
    Route::delete('/delete/{booking}','\App\Http\Controllers\API\Admin\BookingsController@delete');
});

Route::group(['prefix' => 'services'], function () {
    Route::get('/','\App\Http\Controllers\API\Admin\ServicesController@index');
    Route::get('/{service}','\App\Http\Controllers\API\Admin\ServicesController@item');
    Route::get('/disabled/{service}','\App\Http\Controllers\API\Admin\ServicesController@disabled');
    Route::delete('/delete/{service}','\App\Http\Controllers\API\Admin\ServicessController@delete');
});
