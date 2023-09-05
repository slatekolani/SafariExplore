<?php


Route::group([

    'namespace' => 'TourOperator\TourPackageBookings',

], function () {

    Route::group(['prefix' => 'tourPackageBookings', 'as' => 'tourPackageBookings.'], function () {
        Route::get('/index/{tourPackage}', 'TourPackageBookingsController@index')->name('index');
        Route::get('/getTourPackageBookings/{tourPackage}', 'TourPackageBookingsController@getTourPackageBookings')->name('getTourPackageBookings');
        Route::get('/approveOrUnApproveBooking', 'TourPackageBookingsController@approveOrUnApproveBooking')->name('approveOrUnApproveBooking');
        Route::get('/view/{tourPackageBooking}', 'TourPackageBookingsController@show')->name('view');
        Route::get('/edit/{tourPackageBooking}', 'TourPackageBookingsController@edit')->name('edit');
        Route::put('/update/{tourPackageBooking}', 'TourPackageBookingsController@update')->name('update');
        Route::get('/getApprovedTourPackageBookings/{tourPackage}', 'TourPackageBookingsController@getApprovedTourPackageBookings')->name('getApprovedTourPackageBookings');
        Route::get('/ApprovedTourPackageBookingsIndex/{tourPackage}', 'TourPackageBookingsController@ApprovedTourPackageBookingsIndex')->name('ApprovedTourPackageBookingsIndex');
        Route::get('/getUnapprovedTourPackageBookings/{tourPackage}', 'TourPackageBookingsController@getUnapprovedTourPackageBookings')->name('getUnapprovedTourPackageBookings');
        Route::get('/unApprovedTourPackageBookingsIndex/{tourPackage}', 'TourPackageBookingsController@unApprovedTourPackageBookingsIndex')->name('unApprovedTourPackageBookingsIndex');
        Route::get('/tourPackageBookingsOverviewIndex', 'TourPackageBookingsController@tourPackageBookingsOverviewIndex')->name('tourPackageBookingsOverviewIndex');
        Route::get('/getTourPackageBookingsOverview', 'TourPackageBookingsController@getTourPackageBookingsOverview')->name('getTourPackageBookingsOverview');
        Route::get('/getTourPackageGeneralApprovedBookings', 'TourPackageBookingsController@getTourPackageGeneralApprovedBookings')->name('getTourPackageGeneralApprovedBookings');
        Route::get('/tourPackageGeneralApprovedBookingsIndex', 'TourPackageBookingsController@tourPackageGeneralApprovedBookingsIndex')->name('tourPackageGeneralApprovedBookingsIndex');
        Route::get('/tourPackageGeneralUnApprovedBookingsIndex', 'TourPackageBookingsController@tourPackageGeneralUnApprovedBookingsIndex')->name('tourPackageGeneralUnApprovedBookingsIndex');
        Route::get('/getTourPackageGeneralUnApprovedBookings', 'TourPackageBookingsController@getTourPackageGeneralUnApprovedBookings')->name('getTourPackageGeneralUnApprovedBookings');
        Route::get('/generateReviewLink/{tourPackageBooking}', 'TourPackageBookingsController@generateReviewLink')->name('generateReviewLink');
        Route::get('/downloadBookings/{tourPackage}', 'TourPackageBookingsController@downloadBookings')->name('downloadBookings');
    });


});
