<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'users'], function () {
    Route::get('/','\App\Http\Controllers\API\Admin\UsersController@index');
    Route::get('{user}','\App\Http\Controllers\API\Admin\UsersController@item');
    Route::put('{user}/update','\App\Http\Controllers\API\Admin\UsersController@update');
    Route::delete('{user}/delete', '\App\Http\Controllers\API\Admin\UsersController@update');
    Route::get('userrole','\App\Http\Controllers\API\Admin\UsersController@users');
});

Route::group(['prefix' => 'rooms'], function () {
    Route::get('/','\App\Http\Controllers\API\Admin\RoomsController@index');
    Route::get('/{room}','\App\Http\Controllers\API\Admin\RoomsController@item');
    Route::get('/disabled/{room}','\App\Http\Controllers\API\User\RoomsController@disabled');
    Route::delete('/delete/{room}','\App\Http\Controllers\API\User\RoomsController@delete');
});

Route::group(['prefix' => 'bookings'], function () {
    Route::get('/','\App\Http\Controllers\API\Admin\BookingsController@index');
    Route::get('/{booking}','\App\Http\Controllers\API\Admin\BookingsController@item');
    Route::get('/disabled/{booking}','\App\Http\Controllers\API\User\BookingsController@disabled');
    Route::delete('/delete/{booking}','\App\Http\Controllers\API\User\BookingsController@delete');
});

Route::group(['prefix' => 'services'], function () {
    Route::get('/','\App\Http\Controllers\API\Admin\ServicesController@index');
    Route::get('/{service}','\App\Http\Controllers\API\Admin\ServicesController@item');
    Route::get('/disabled/{service}','\App\Http\Controllers\API\User\ServicesController@disabled');
    Route::delete('/delete/{service}','\App\Http\Controllers\API\User\ServicessController@delete');
});
