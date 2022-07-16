<?php

/*
|--------------------------------------------------------------------------
| OAuth Routes
|--------------------------------------------------------------------------
*/

// Authorization
Route::middleware(['web', 'auth', 'verified'])->group(function () {
    Route::prefix('authorize')->name('authorizations.')->group(function () {
        Route::get('', 'AuthorizationController@authorize')->name('authorize')->middleware('register');
        Route::post('', 'ApproveAuthorizationController@approve')->name('approve');
        Route::delete('', 'DenyAuthorizationController@deny')->name('deny');
    });
});

// Access Tokens
Route::post('token', 'AccessTokenController@issueToken')->name('token')->middleware(['throttle', 'api-headers']);
Route::prefix('tokens')->name('tokens.')->middleware(['web', 'auth'])->group(function () {
    Route::get('', 'AuthorizedAccessTokenController@forUser')->name('index');
    Route::delete('{token_id}', 'AuthorizedAccessTokenController@destroy')->name('destroy');
});

// Transient Tokens
Route::post('token/refresh', 'TransientTokenController@refresh')->name('token.refresh')->middleware(['web', 'auth']);

// Clients
/*
Route::prefix('clients')->middleware(['web', 'auth'])->name('clients.')->group(function () {
    Route::get('', 'ClientController@forUser')->name('index');
    Route::post('', 'ClientController@store')->name('store');
    Route::put('{client_id}', 'ClientController@update')->name('update');
    Route::delete('{client_id}', 'ClientController@destroy')->name('destroy');
});
*/
// Personal Access Tokens
/*
Route::middleware(['web', 'auth'])->group(function () {
    Route::get('scopes', 'ScopeController@all')->name('scopes.index');
    Route::prefix('personal-access-tokens')->name('personal.tokens.')->group(function () {
        Route::get('', 'PersonalAccessTokenController@forUser')->name('index');
        Route::post('', 'PersonalAccessTokenController@store')->name('store');
        Route::delete('{token_id}', 'PersonalAccessTokenController@destroy')->name('destroy');
    });
});
*/