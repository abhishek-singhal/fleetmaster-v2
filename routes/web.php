<?php

//HOMEPAGE
Route::get('/', 'HomeController@index');

//LOGIN PAGES
Route::get('login', 'AuthController@redirectToSteam');

Route::get('login/handle', 'AuthController@handle');

//LOGOUT
Route::get('logout', 'Auth\LoginController@logout')->name('logout');


//DASHBOARD
Route::get('dashboard', 'HomeController@dashboard')->middleware('LoginAuth');

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

//ABSENT
Route::get('absent', 'AbsentController@show');

Route::post('absent', 'AbsentController@store');

//EVENT
Route::get('event/create', 'EventController@create');

Route::post('event/create', 'EventController@store');

Route::get('event', 'EventController@show');

Route::post('event/edit', 'EventController@update');

Route::get('event/{id}', 'EventRoleController@show');

Route::get('event/{id}/edit', 'EventController@edit');

//EVENT ROLE
Route::post('role/yourrole', 'EventRoleController@takeRole');

Route::post('role/confirm', 'EventRoleController@confirm');

Route::post('role/giverole', 'EventRoleController@roleGive');

