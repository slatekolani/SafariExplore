<?php


Route::group([

    'namespace' => 'TourOperator\TourOperatorPackages',

], function () {

    Route::group(['prefix' => 'tourPackages', 'as' => 'tourPackages.'], function () {
        Route::get('/create/{tourOperator}', 'TourPackagesController@create')->name('create');
        Route::get('/index/{tourOperator}', 'TourPackagesController@index')->name('index');
        Route::get('/delete/{tourOperator}', 'TourPackagesController@destroy')->name('delete');
        Route::get('/show/{tourPackage}', 'TourPackagesController@show')->name('show');
        Route::get('/delete/{tourPackage}', 'TourPackagesController@destroy')->name('delete');
        Route::post('/store', 'TourPackagesController@store')->name('store');
        Route::get('/edit/{tourPackage}', 'TourPackagesController@edit')->name('edit');
        Route::put('/update/{tourPackage}', 'TourPackagesController@update')->name('update');
        Route::get('/ActivateOrDeactivateTourPackage', 'TourPackagesController@ActivateOrDeactivateTourPackage')->name('ActivateOrDeactivateTourPackage');
        Route::get('/recentPostedTourPackagesIndex/{tourOperator}', 'TourPackagesController@recentPostedTourPackagesIndex')->name('recentPostedTourPackagesIndex');
        Route::get('/getRecentPostedTourPackages/{tourOperator}', 'TourPackagesController@getRecentPostedTourPackages')->name('getRecentPostedTourPackages');
        Route::get('/verifiedTourPackagesIndex/{tourOperator}', 'TourPackagesController@verifiedTourPackagesIndex')->name('verifiedTourPackagesIndex');
        Route::get('/getVerifiedTourPackages/{tourOperator}', 'TourPackagesController@getVerifiedTourPackages')->name('getVerifiedTourPackages');
        Route::get('/unverifiedTourPackagesIndex/{tourOperator}', 'TourPackagesController@unverifiedTourPackagesIndex')->name('unverifiedTourPackagesIndex');
        Route::get('/getUnVerifiedTourPackages/{tourOperator}', 'TourPackagesController@getUnVerifiedTourPackages')->name('getUnVerifiedTourPackages');
        Route::get('/nearToursToBeConductedIndex/{tourOperator}', 'TourPackagesController@nearToursToBeConductedIndex')->name('nearToursToBeConductedIndex');
        Route::get('/getNearToursToBeConducted/{tourOperator}', 'TourPackagesController@getNearToursToBeConducted')->name('getNearToursToBeConducted');
        Route::get('/expiredTourPackagesIndex/{tourOperator}', 'TourPackagesController@expiredTourPackagesIndex')->name('expiredTourPackagesIndex');
        Route::get('/getExpiredTourPackages/{tourOperator}', 'TourPackagesController@getExpiredTourPackages')->name('getExpiredTourPackages');
        Route::get('/getCompanyTourPackages/{tourOperator}', 'TourPackagesController@getCompanyTourPackages')->name('getCompanyTourPackages');
        Route::get('/companyTourPackagesIndex/{tourOperator}', 'TourPackagesController@companyTourPackagesIndex')->name('companyTourPackagesIndex');
        Route::get('/deletedTourPackagesIndex/{tourOperator}', 'TourPackagesController@deletedTourPackagesIndex')->name('deletedTourPackagesIndex');
        Route::get('/getDeletedTourPackages/{tourOperator}', 'TourPackagesController@getDeletedTourPackages')->name('getDeletedTourPackages');
        Route::get('/restoreDeletedTourPackages/{tourPackage}', 'TourPackagesController@restoreDeletedTourPackages')->name('restoreDeletedTourPackages');
    });


});
