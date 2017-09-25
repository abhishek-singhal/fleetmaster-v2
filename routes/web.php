<?php

Route::get('/', function () {
    return Auth::user();
});

Route::get('auth/steam', 'AuthController@redirectToSteam')->name('auth.steam');
Route::get('auth/steam/handle', 'AuthController@handle')->name('auth.steam.handle');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
