<?php

Route::group(['prefix' => 'travels', 'middleware' => ['auth']], function () {
    Route::get('/', 'TravelsController@index')->name('travel.index');
    Route::get('create', 'TravelsController@create')->name('travel.create');
    Route::get('{id}/edit', 'TravelsController@edit')->name('travel.edit');
    Route::post('store', 'TravelsController@store')->name('travel.store');
    Route::post('{id}/update', 'TravelsController@update')->name('travel.update');
    Route::delete('{id}/delete', 'TravelsController@destroy')->name('travel.destroy');

    Route::get('/test', 'TestsController@index');
    Route::post('store/test', 'TestsController@store')->name('test.store');
});
