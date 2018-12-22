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
