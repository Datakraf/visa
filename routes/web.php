<?php

Auth::routes();
Route::get('/', ['uses' => 'Auth\LoginController@showLoginForm']);

Route::group(['middleware' => 'auth'], function () {
    Route::resource('users', 'UsersController');
    Route::resource('roles', 'RolesController');
    Route::get('myprofile', 'UsersController@myprofile');
    Route::post('myprofile/update/{id}', 'UsersController@profileUpdate')->name('profile.update');
    Route::get('notifications', 'NotificationsController@index')->name('notifications');
    Route::post('read/{id}/{application_id}', 'NotificationsController@markAsRead')->name('notifications.read');
});
