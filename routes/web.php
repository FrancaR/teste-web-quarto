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

Route::get('/', 'PropertyController@index')->name('properties.index');
Route::get('property-{id}', 'PropertyController@show')->name('properties.show');

Auth::routes();

Route::name('manager.')->prefix('manager')->namespace('Manager')->group(function () {
    Route::resource('properties', 'PropertyController');
    Route::post('properties/{id}/photo', 'PhotoController@store')->name('properties.photos');
});