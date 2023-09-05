<?php

Route::group([

    'namespace'=>'Admin',

] ,function () {

    Route::group([ 'prefix' => 'nations',  'as' => 'nations.'], function() {
        Route::post('/store', 'nationsController@store')->name('store');
        Route::get('/create', 'nationsController@create')->name('create');
        Route::get('/index', 'nationsController@index')->name('index');
        Route::get('/activateNation', 'nationsController@activateNation')->name('activateNation');
        Route::get('/getNations', 'nationsController@getNations')->name('getNations');
        Route::get('/delete/{nation}', 'nationsController@destroy')->name('delete');
    });




});
