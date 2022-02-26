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
    Route::post('reply-contact/{id}', 'ContactController@replyContact')->name('contact.reply');
    Route::resource('contact', 'ContactController');
    Route::resource('contact_type', 'ContactTypeController');
    Route::post('contact_type/{id}/ban', 'ContactTypeController@ban')->name('contact_type.ban');
    Route::post('contact_type/{id}/activate', 'ContactTypeController@activate')->name('contact_type.activate');
    Route::resource('slider', 'SliderController');
    Route::post('slider/{id}/ban', 'SliderController@ban')->name('slider.ban');
    Route::post('slider/{id}/activate', 'SliderController@activate')->name('slider.activate');
    Route::get('social', 'SocialController@social')->name('social.edit');
    Route::post('social', 'SocialController@updateSocial')->name('social.updateSocial');
    Route::get('page/{type}/{for}', 'PageController@page')->name('page.edit');
    Route::put('page/{id}', 'PageController@update')->name('page.update');

    Route::post('city/upload-excel', 'CityController@uploadExcel')->name('city.upload-excel');
    Route::resource('city', 'CityController');
    Route::post('city/{id}/ban', 'CityController@ban')->name('city.ban');
    Route::post('city/{id}/activate', 'CityController@activate')->name('city.activate');
//formula-content-classifications
    Route::get('/formula-content-classifications', 'FormulaContentOfNutrientsController@classifications')->name('formula_content.classifications');
    Route::get('/formula-content-classifications/create', 'FormulaContentOfNutrientsController@createClassifications')->name('formula_content.create_classifications');

    Route::get('/formula-content-classifications/create', 'FormulaContentOfNutrientsController@createClassifications')->name('formula_content.create_classification');
    Route::get('/formula-content-classifications/{id}/edit', 'FormulaContentOfNutrientsController@editClassifications')->name('formula_content.edit_classification');
    Route::put('/formula-content-classifications/{id}/update', 'FormulaContentOfNutrientsController@updateClassifications')->name('formula_content.update_classification');
    Route::post('/formula-content-classifications/store', 'FormulaContentOfNutrientsController@storeClassifications')->name('formula_content.store_classification');

    Route::post('/formula-content-classifications/{id}/ban', 'FormulaContentOfNutrientsController@ban')->name('formula_content.ban_classification');
    Route::post('/formula-content-classifications/{id}/activate', 'FormulaContentOfNutrientsController@activate')->name('formula_content.activate_classification');
//formula_nutrient_drop_downs
    Route::get('/formula_nutrients', 'FormulaContentOfNutrientsController@formula_nutrients')->name('formula_content.formula_nutrients');
    Route::post('/formula_nutrients/{id}/ban', 'FormulaContentOfNutrientsController@ban_formula_nutrients')->name('formula_content.ban_formula_nutrient');
    Route::post('/formula_nutrients/{id}/activate', 'FormulaContentOfNutrientsController@activate_formula_nutrients')->name('formula_content.activate_formula_nutrient');

    Route::get('/formula-nutrients/create', 'FormulaContentOfNutrientsController@createFormulaNutrients')->name('formula_content.create_formula_nutrient');
    Route::get('/formula-nutrients/{id}/edit', 'FormulaContentOfNutrientsController@editFormulaNutrients')->name('formula_content.edit_formula_nutrient');
    Route::put('/formula-nutrients/{id}/update', 'FormulaContentOfNutrientsController@updateFormulaNutrients')->name('formula_content.update_formula_nutrient');
    Route::post('/formula-nutrients/store', 'FormulaContentOfNutrientsController@storeFormulaNutrients')->name('formula_content.store_formula_nutrient');
//ClinicalStatus
    Route::post('/ClinicalStatus/{id}/ban', 'ClinicalStatusController@ban')->name('ClinicalStatus.ban');
    Route::post('/ClinicalStatus/{id}/activate', 'ClinicalStatusController@activate')->name('ClinicalStatus.activate');
    Route::resource('ClinicalStatus', 'ClinicalStatusController');
//formula_nutrient
    Route::resource('formula_nutrient', 'FormulaNutrientController');
//nutrient
    Route::post('/Nutrient/{id}/ban', 'NutrientController@ban')->name('Nutrient.ban');
    Route::post('/Nutrient/{id}/activate', 'NutrientController@activate')->name('Nutrient.activate');
    Route::resource('Nutrient', 'NutrientController');
//factor
    Route::post('/Factor/{id}/ban', 'FactorController@ban')->name('Factor.ban');
    Route::post('/Factor/{id}/activate', 'FactorController@activate')->name('Factor.activate');
    Route::resource('Factor', 'FactorController');
//drug
    Route::post('/Drug/{id}/ban', 'DrugController@ban')->name('Drug.ban');
    Route::post('/Drug/{id}/activate', 'DrugController@activate')->name('Drug.activate');
    Route::resource('Drug', 'DrugController');
//LapTest
    Route::resource('LapTest', 'LapTestController');
//RDA
    Route::post('/RdaCategory/{id}/ban', 'RdaController@ban')->name('RdaCategory.ban');
    Route::post('/RdaCategory/{id}/activate', 'RdaController@activate')->name('RdaCategory.activate');

    Route::post('/AgeCategory/{id}/ban', 'RdaController@ban')->name('AgeCategory.ban');
    Route::post('/AgeCategory/{id}/activate', 'RdaController@activate')->name('AgeCategory.activate');

    Route::get('/RdaCategory', 'RdaController@listRdaCategory')->name('RdaCategory.index');
    Route::get('/RdaCategory/create', 'RdaController@createRdaCategory')->name('RdaCategory.create');
    Route::get('/RdaCategory/{id}/edit', 'RdaController@editRdaCategory')->name('RdaCategory.edit');
    Route::put('/RdaCategory/{id}/update', 'RdaController@updateRdaCategory')->name('RdaCategory.update');
    Route::post('/RdaCategory/store', 'RdaController@storeRdaCategory')->name('RdaCategory.store');

    Route::get('/AgeCategory', 'RdaController@listAgeCategory')->name('AgeCategory.index');
    Route::get('/AgeCategory/create', 'RdaController@createAgeCategory')->name('AgeCategory.create');
    Route::get('/AgeCategory/{id}/edit', 'RdaController@editAgeCategory')->name('AgeCategory.edit');
    Route::put('/AgeCategory/{id}/update', 'RdaController@updateAgeCategory')->name('AgeCategory.update');
    Route::post('/AgeCategory/store', 'RdaController@storeAgeCategory')->name('AgeCategory.store');

    Route::get('/AgeCategory/{id}/DietaryAllowance', 'DietaryAllowanceController@DietaryAllowance')->name('AgeCategory.DietaryAllowance');
    Route::get('/AgeCategory/{id}/DietaryAllowance/create', 'DietaryAllowanceController@DietaryAllowanceCreate')->name('DietaryAllowance.create');
    Route::get('/DietaryAllowance/{id}/edit', 'DietaryAllowanceController@DietaryAllowanceEdit')->name('DietaryAllowance.edit');
    Route::put('/DietaryAllowance/{id}/update', 'DietaryAllowanceController@DietaryAllowanceUpdate')->name('DietaryAllowance.update');
    Route::post('/DietaryAllowance/store', 'DietaryAllowanceController@DietaryAllowanceStore')->name('DietaryAllowance.store');

});
