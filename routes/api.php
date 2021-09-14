<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Middleware\JwtTokenIsValid;

Route::group([
    'namespace' => 'App\Http\Controllers\Api',
    'prefix' => 'v1',
    'middleware'=>'log.route'
], function () {
    // AUTH
    Route::group(['namespace' => 'Auth', 'prefix' => 'auth'], function () {
        Route::post('register', 'RegisterController@register');
        Route::post('resend-email-verification', 'VerifyController@resendEmailVerification');
        Route::post('verify-email', 'VerifyController@verifyEmail');
        Route::post('login', 'LoginController@login');
        // ForgotPassword
        Route::group(['prefix' => 'password'], function () {
            Route::put('update', 'SettingController@updatePassword')->middleware(JwtTokenIsValid::class);
            Route::post('set', 'ResetPasswordController@setNewPassword');
            Route::post('forgot', 'ResetPasswordController@forgotPassword');
            Route::post('resend', 'ResetPasswordController@resend');
            Route::post('code', 'ResetPasswordController@checkCode');
        });
        Route::post('upload-image', 'SettingController@uploadImage');

        // AuthedUser
        Route::group([
            'middleware' => JwtTokenIsValid::class,
        ], function () {
            Route::post('logout', 'LoginController@logout');
            Route::put('update', 'SettingController@updateProfile');
            Route::post('request-update-phone', 'SettingController@requestUpdatePhone');
            Route::post('update-phone', 'SettingController@updatePhone');
        });
    });
    // General
    Route::group(['namespace' => 'General', 'prefix' => 'general'], function () {
        Route::get('settings', 'SettingController@getSettings');
        Route::get('cities', 'DropDownController@cities');
        Route::get('pages/{user_type}/{type}', 'PageController@getPage');

        Route::post('upload-clinical-status','DropDownController@uploadClinicalStatus');
        Route::post('upload-drugs','DropDownController@uploadDrugs');
        Route::post('upload-formula-nutrients','DropDownController@uploadFormulanutrients');
        Route::post('upload-lap-tests','DropDownController@uploadLapTests');
        Route::post('upload-cities','DropDownController@uploadCities');
    });
    //Home
    Route::group(['namespace' => 'Home', 'prefix' => 'home'], function () {
        Route::get('slider', 'SliderController@index');
    });
    Route::get('contact-types', 'Contact\ContactController@contactTypes');

    //Authed end points
    Route::group([
        'middleware' => JwtTokenIsValid::class,
    ], function () {
        //Contact
        Route::group([
            'namespace' => 'Contact'
        ], function () {
            Route::post('contact', 'ContactController@store');
        });
        //Notification
        Route::group([
            'namespace' => 'Notification',
        ], function () {
            Route::group(['prefix' => 'notifications'], function () {
                Route::get('/', 'NotificationController@index');
                Route::get('/{id}', 'NotificationController@show');
            });
        });
        // TubeFeedingFormula
        Route::group(['namespace' => 'TubeFeedingFormula', 'prefix' => 'tube-feeding-formula'], function () {
            Route::get('classifications', 'DropDownController@formulaNutrientsClassifications');
            Route::get('classifications/{id}/tube-feeding', 'DropDownController@tubeFeedings');
            Route::post('single-calc', 'TubeFeedingFormulaController@singleCalc');
            Route::post('twice-calc', 'TubeFeedingFormulaController@twiceCalc');
        });
        //CaloriesIntake
        Route::group(['namespace' => 'CaloriesIntake', 'prefix' => 'calories-intake'], function () {
            Route::get('clinical-status', 'CaloriesIntakeController@ClinicalStatus');
            Route::post('healthy-calc', 'CaloriesIntakeController@healthyCalc');
            Route::post('hospitalized-calc', 'CaloriesIntakeController@hospitalizedCalc');
        });
        //IdealBodyWeight
        Route::group(['namespace' => 'IdealBodyWeight', 'prefix' => 'ideal-body-weight'], function () {
            Route::post('calc', 'IdealBodyWeightController@calc');
        });
        //LaboratoryTest
        Route::group(['namespace' => 'LaboratoryTest', 'prefix' => 'laboratory-tests'], function () {
            Route::get('types', 'LaboratoryTestController@types');
            Route::get('types/{id}/factor', 'LaboratoryTestController@factors');
            Route::post('calc', 'LaboratoryTestController@calc');
        });
        //LaboratoryTest
        Route::group(['namespace' => 'NutrientFactor', 'prefix' => 'nutrient-factors'], function () {
            Route::get('nutrient', 'NutrientFactorController@nutrients');
//            Route::get('nutrient/{id}/drug', 'NutrientFactorController@drugs');
            Route::get('drug', 'NutrientFactorController@drugs');
            Route::post('calc', 'NutrientFactorController@calc');
        });
    });


});
