<?php

//HOMEPAGE
Route::get('/', 'HomeController@index');

//LOGIN PAGES
Route::get('login', 'AuthController@redirectToSteam');
Route::get('login/handle', 'AuthController@handle');

//LOGOUT
Route::get('logout', 'Auth\LoginController@logout')->name('logout');


//CMS
Route::get('dashboard', 'HomeController@dashboard');

//MEMBERS
Route::get('members', 'MembersController@members');

Route::get('members/new', 'MembersController@new');

Route::post('members/new', 'MembersController@newUpdate');

Route::get('members/all', 'MembersController@all');

Route::post('members/all', 'MembersController@allUpdate');

//USER
Route::post('user/skin', 'UserController@skin');

Route::get('profile/edit', 'UserController@editProfile');

Route::get('profile/{id?}', 'UserController@showProfile');