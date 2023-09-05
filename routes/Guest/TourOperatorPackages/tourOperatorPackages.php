<?php


Route::group([

    'namespace' => 'TourOperator\TourOperatorPackages',

], function () {

    Route::group(['prefix' => 'tourPackages', 'as' => 'tourPackages.'], function () {
        Route::get('/publicView/{tourPackage}', 'TourPackagesController@publicView')->name('publicView');
        Route::get('/allTourPackages', 'TourPackagesController@allTourPackages')->name('allTourPackages');
        Route::get('/recentPostedTourPackages', 'TourPackagesController@recentPostedTourPackages')->name('recentPostedTourPackages');
        Route::get('/search', 'TourPackagesController@search')->name('search');
        Route::get('/getAllTourPackagesOnSearch', 'TourPackagesController@getAllTourPackagesOnSearch')->name('getAllTourPackagesOnSearch');
    });


});
