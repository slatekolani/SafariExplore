<?php

Route::group([

    'namespace'=>'Admin',

] ,function () {

    Route::group([ 'prefix' => 'tourOperatorCompaniesManagement',  'as' => 'tourOperatorCompaniesManagement.'], function() {
        Route::get('/index', 'tourOperatorCompaniesManagementController@index')->name('index');
        Route::get('/verifiedTourOperatorsCompaniesIndex', 'tourOperatorCompaniesManagementController@verifiedTourOperatorsCompaniesIndex')->name('verifiedTourOperatorsCompaniesIndex');
        Route::get('/unverifiedTourOperatorsCompaniesIndex', 'tourOperatorCompaniesManagementController@unverifiedTourOperatorsCompaniesIndex')->name('unverifiedTourOperatorsCompaniesIndex');
        Route::get('/getTourOperatorsCompanies', 'tourOperatorCompaniesManagementController@getTourOperatorsCompanies')->name('getTourOperatorsCompanies');
        Route::get('/getVerifiedTourOperatorsCompanies', 'tourOperatorCompaniesManagementController@getVerifiedTourOperatorsCompanies')->name('getVerifiedTourOperatorsCompanies');
        Route::get('/getUnverifiedTourOperatorsCompanies', 'tourOperatorCompaniesManagementController@getUnverifiedTourOperatorsCompanies')->name('getUnverifiedTourOperatorsCompanies');
        Route::get('/ActivateOrDeactivateCompany', 'tourOperatorCompaniesManagementController@ActivateOrDeactivateCompany')->name('ActivateOrDeactivateCompany');
        Route::get('/deletedTourCompaniesIndex', 'tourOperatorCompaniesManagementController@deletedTourCompaniesIndex')->name('deletedTourCompaniesIndex');
        Route::get('/getDeletedTourOperatorCompanies', 'tourOperatorCompaniesManagementController@getDeletedTourOperatorCompanies')->name('getDeletedTourOperatorCompanies');
    });




});
