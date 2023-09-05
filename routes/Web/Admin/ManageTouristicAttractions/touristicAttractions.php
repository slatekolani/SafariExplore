<?php

Route::group([

    'namespace'=>'Admin',

] ,function () {

    Route::group([ 'prefix' => 'touristicAttractions',  'as' => 'touristicAttractions.'], function() {
        Route::get('/index', 'touristicAttractionsController@index')->name('index');
        Route::post('/store', 'touristicAttractionsController@store')->name('store');
        Route::get('/create', 'touristicAttractionsController@create')->name('create');
        Route::get('/getTouristicAttractions', 'touristicAttractionsController@getTouristicAttractions')->name('getTouristicAttractions');
        Route::get('/activateAttraction', 'touristicAttractionsController@activateAttraction')->name('activateAttraction');
        Route::get('/delete/{touristicAttraction}', 'touristicAttractionsController@destroy')->name('delete');
    });




});
