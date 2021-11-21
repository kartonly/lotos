<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'user'], function () {
    Route::get('/','\App\Http\Controllers\API\User\UsersController@index');
    Route::put('update','\App\Http\Controllers\API\User\UsersController@update');
    Route::get('myroom','\App\Http\Controllers\API\User\UsersController@myBookings');
    Route::post('myroom/{booking}','\App\Http\Controllers\API\User\UsersController@myBookingsDelete');
});


