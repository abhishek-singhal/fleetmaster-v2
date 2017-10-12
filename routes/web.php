<?php

//HOMEPAGE
Route::get('/', 'HomeController@index');

//LOGIN PAGES
Route::get('login', 'AuthController@redirectToSteam')->middleware('LoginAuth');

Route::get('login/handle', 'AuthController@handle')->middleware('LoginAuth');

//LOGOUT
Route::get('logout', 'Auth\LoginController@logout')->name('logout');


//DASHBOARD
Route::get('dashboard', 'HomeController@dashboard')->middleware('LoginAuth');

//MEMBERS
Route::get('members', 'MembersController@members');

Route::get('members/new', 'MembersController@new')->middleware('Supervisor');

Route::post('members/new', 'MembersController@newUpdate')->middleware('Supervisor');

Route::get('members/all', 'MembersController@all')->middleware('Supervisor');

Route::post('members/all', 'MembersController@allUpdate')->middleware('Supervisor');

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

Route::get('event/new', 'EventController@new')->middleware('Supervisor');

Route::post('event/new', 'EventController@approve')->middleware('Supervisor');

Route::get('event/{id}', 'EventRoleController@show');

Route::get('event/{id}/edit', 'EventController@edit');

//EVENT ROLE
Route::post('role/yourrole', 'EventRoleController@takeRole');

Route::post('role/confirm', 'EventRoleController@confirm')->middleware('Supervisor');

Route::post('role/giverole', 'EventRoleController@roleGive')->middleware('Supervisor');

Route::post('role/removedriver', 'EventRoleController@driverRemove')->middleware('Supervisor');

Route::post('uploadsave', 'EventRoleController@uploadSave');

Route::post('deletesave', 'EventRoleController@deleteSave');

//CONTACT US
Route::get('contact/create', 'ContactController@store');

Route::get('contact/{id?}', 'ContactController@show')->middleware('Supervisor');

Route::post('contact', 'ContactController@status')->middleware('Supervisor');
