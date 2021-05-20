<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect()->route('admin.home');
});

Route::prefix('/admin')->name('admin.')->namespace('App\Http\Controllers\Admin')->group(function() {
    Route::namespace('Auth')->group(function(){
        Route::get('/login','LoginController@showLoginForm')->name('login');
        Route::post('/login','LoginController@login')->name('login.submit');
        Route::post('/logout','LoginController@logout')->name('logout');
        Route::get('/password/reset','ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('/password/email','ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::get('/password/reset/{token}','ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('/password/reset','ResetPasswordController@reset')->name('password.update');
    });
    Route::get('clear-all-notifications', 'NotificationController@clearAdminNotifications')->name('clear-all-notifications');
    Route::get('read-notification/{id}', 'NotificationController@readNotification')->name('read-notification');
    Route::get('/profile', 'AdminController@profile')->name('profile');
    Route::put('/profile', 'AdminController@updateProfile')->name('profile.update');
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('user', 'UserController');
    Route::post('user/{id}/ban', 'UserController@ban')->name('user.ban');
    Route::post('user/{id}/activate', 'UserController@activate')->name('user.activate');
    Route::post('notification/{id}','NotificationController@sendSingleNotification')->name('notification.send-single-notification');
    Route::resource('notification', 'NotificationController');
    Route::resource('contact', 'ContactController');
    Route::resource('contact_type', 'ContactTypeController');
    Route::post('contact_type/{id}/ban', 'ContactTypeController@ban')->name('contact_type.ban');
    Route::post('contact_type/{id}/activate', 'ContactTypeController@activate')->name('contact_type.activate');
    Route::resource('slider', 'SliderController');
    Route::post('slider/{id}/ban', 'SliderController@ban')->name('slider.ban');
    Route::post('slider/{id}/activate', 'SliderController@activate')->name('slider.activate');
    Route::get('page/{type}/{for}', 'PageController@page')->name('page.edit');
    Route::put('page/{id}', 'PageController@update')->name('page.update');

    Route::resource('city', 'CityController');

    Route::get('/formula-content-classifications', 'FormulaContentOfNutrientsController@classifications')->name('formula_content.classifications');
    Route::post('/formula-content-classifications/{id}/ban', 'FormulaContentOfNutrientsController@ban')->name('formula_content.ban_classification');
    Route::post('/formula-content-classifications/{id}/activate', 'FormulaContentOfNutrientsController@activate')->name('formula_content.activate_classification');

    Route::get('/formula_nutrients', 'FormulaContentOfNutrientsController@formula_nutrients')->name('formula_content.formula_nutrients');
    Route::post('/formula_nutrients/{id}/ban', 'FormulaContentOfNutrientsController@ban_formula_nutrients')->name('formula_content.ban_formula_nutrient');
    Route::post('/formula_nutrients/{id}/activate', 'FormulaContentOfNutrientsController@activate_formula_nutrients')->name('formula_content.activate_formula_nutrient');


});
