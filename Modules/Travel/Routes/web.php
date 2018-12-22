<?php

Route::prefix('travels')->middleware(['auth'])->group(function () {
    Route::resource('/', 'TravelsController');
});
