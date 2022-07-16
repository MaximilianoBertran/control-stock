<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
 */

Route::prefix('')->namespace('Auth')->group(function () {

    // Logout
    Route::post('logout', 'LoginController@logout')->name('logout');

    Route::middleware('guest:backend')->group(function () {

        // Login
        Route::get('login', 'LoginController@showLoginForm')->name('login');
        Route::post('login', 'LoginController@login')->name('login');

        // Password reset
        Route::prefix('password')->group(function () {
            Route::get('reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');//estaba anulado
            Route::post('email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
            Route::get('reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
            Route::post('reset', 'ResetPasswordController@reset')->name('password.new');
        });

        // Email Verification.
        Route::get('email/verify', 'VerificationController@show')->name('verification.notice');
        Route::get('email/verify/{id}/{hash}', 'VerificationController@verify')->name('verification.verify');
        Route::post('email/resend', 'VerificationController@resend')->name('verification.resend');
    });
});


// Backend
Route::middleware('auth:backend')->group(function () {

    // Home
    Route::get('home', 'HomeController@index')->name('home');

    // Profile
    Route::prefix('profile')->group(function () {
        Route::get('edit', 'ProfileController@edit')->name('profile.edit');
        Route::put('update', 'ProfileController@update')->name('profile.update');
    });

    // Admin
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('', 'AdminsController@index')->name('index')->middleware('can:view-admins');
        Route::get('add', 'AdminsController@create')->name('create')->middleware('can:create-admins');
        Route::post('save', 'AdminsController@store')->name('store')->middleware('can:create-admins');
        Route::get('edit/{id}', 'AdminsController@edit')->name('edit')->middleware('can:edit-admins');
        Route::put('update/{id}', 'AdminsController@update')->name('update')->middleware('can:edit-admins');
        Route::delete('delete/{id}', 'AdminsController@destroy')->name('destroy')->middleware('can:delete-admins');
    });

    // Role
    Route::prefix('role')->name('role.')->group(function () {
        Route::get('', 'RolesController@index')->name('index')->middleware('can:view-roles');
        Route::get('add', 'RolesController@create')->name('create')->middleware('can:create-roles');
        Route::post('save', 'RolesController@store')->name('store')->middleware('can:create-roles');
        Route::get('edit/{id}', 'RolesController@edit')->name('edit')->middleware('can:edit-roles');
        Route::put('update/{id}', 'RolesController@update')->name('update')->middleware('can:edit-roles');
        Route::delete('delete/{id}', 'RolesController@destroy')->name('destroy')->middleware('can:delete-roles');
    });

    // Permission
    Route::prefix('permission')->name('permission.')->group(function () {
        Route::get('', 'PermissionsController@index')->name('index')->middleware('can:view-permissions');
    });

    // Debug
    Route::prefix('debug')->namespace('Debug')->name('debug.')->group(function () {
        Route::prefix('diagnosis')->name('diagnosis.')->group(function () {
            Route::get('', 'DiagnosisController@index')->name('index');
            Route::get('userdata', 'DiagnosisController@userdata')->name('userdata');
            Route::get('logs/{log}', 'DiagnosisController@log')->name('log');
        });
    });

    // Products
    Route::prefix('product')->name('product.')->group(function () {
        Route::get('/', 'ProductsController@index')->name('index')->middleware('can:view-admins');
        Route::delete('delete/{id}', 'ProductsController@destroy')->name('destroy')->middleware('can:view-admins');
        Route::get('edit/{id}', 'ProductsController@edit')->name('edit')->middleware('can:view-admins');
        Route::put('update/{id}', 'ProductsController@update')->name('update')->middleware('can:view-admins');
        Route::get('add', 'ProductsController@create')->name('create')->middleware('can:view-admins');
        Route::post('save', 'ProductsController@store')->name('store')->middleware('can:view-admins');
    });

    // Products
    Route::prefix('stock')->name('stock.')->group(function () {
        Route::get('/', 'StockController@index')->name('index');
    });

    // Orders
    Route::prefix('order')->name('order.')->group(function () {
        Route::get('/', 'OrdersController@index')->name('index');
        Route::delete('delete/{id}', 'OrdersController@destroy')->name('destroy')->middleware('can:view-admins');
        //Route::get('edit/{id}', 'OrdersController@edit')->name('edit')->middleware('can:view-admins');
        //Route::put('update/{id}', 'OrdersController@update')->name('update')->middleware('can:view-admins');
        Route::get('add', 'OrdersController@create')->name('create')->middleware('can:view-admins');
        Route::post('save', 'OrdersController@store')->name('store')->middleware('can:view-admins');
    });
});


