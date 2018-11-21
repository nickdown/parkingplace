<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->group(function () {
    Route::get('/users/current', 'API\CurrentUserController@show')->name('users.current.show');
    Route::get('/tickets/current', 'API\CurrentTicketController@show')->name('tickets.current.show');
    Route::post('/entries', 'EntryController@store')->name('entries.store');
    Route::post('/purchases', 'PurchaseController@store')->name('purchases.store');
    Route::post('/exits', 'ExitController@store')->name('exits.store');
});
