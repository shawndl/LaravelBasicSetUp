<?php

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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');


Route::group(['middleware' => 'auth'], function(){
    Route::get('dashboard', 'UserAccount\DashboardController@index')->name('dashboard');
});

/**
 * Account
 */
Route::group(['prefix' => 'account', 'middleware' => ['auth'], 'as' => 'account.'], function (){
    Route::get('/', 'UserAccount\AccountController@index')->name('index');

    /**
     * Profile
     */
    Route::get('/profile', 'UserAccount\ProfileController@index')->name('profile.index');
    Route::post('/profile', 'UserAccount\ProfileController@store')->name('profile.store');

    /**
     * Password
     */
    Route::get('/password', 'UserAccount\PasswordController@index')->name('password.index');
    Route::post('/password', 'UserAccount\PasswordController@store')->name('password.store');
});

/**
 * activation
 */
Route::group(['prefix' => 'activation', 'as' => 'activation.', 'middleware' => ['guest']], function(){

    /**
     * resend activation
     */
    Route::get('/resend', 'Auth\ActivationResendController@index')->name('resend.index');
    Route::post('/resend', 'Auth\ActivationResendController@store')->name('resend.store');

    Route::get('/{confirmation_token}', 'Auth\ActivationController@activate')->name('activate');

});