<?php

use Illuminate\Support\Facades\Route;


Route::namespace('Bizmates\\Controllers\\Api')->middleware('api')->group(function () {
    Route::prefix('weather')->group(function () {
        Route::post('get-by-city', 'WeathersController@getWeatherByCity');
        Route::post('get-by-coordinates', 'WeathersController@getWeatherByCoordinates');
    });

    Route::prefix('venues')->group(function () {
        Route::get('autocomplete', 'VenuesController@getAutocomplete');
        Route::post('trending', 'VenuesController@getVenuesTrending');
    });
});
