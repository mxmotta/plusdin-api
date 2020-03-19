<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('V1')->prefix('v1')->group( function(){
    
    Route::post('/token', 'UsersController@token')->name('token');

    Route::middleware('auth:airlock')->group(function () {

        Route::get('/cards', 'CardsController@list')->name('cards.list');
        Route::post('/cards', 'CardsController@create')->name('cards.create');
        Route::get('/cards/{id}', 'CardsController@get')->name('cards.get');
        Route::delete('/cards/{id}', 'CardsController@delete')->name('cards.delete');
    
    });
});