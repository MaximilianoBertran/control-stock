<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('.well-known/openid-configuration', 'OAuth\OpenIDController@configuration');
Route::get('/', 'HomeController@index')->name('default');