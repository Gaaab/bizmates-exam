<?php

use Bizmates\Services\MapService;
use Bizmates\Services\WeatherService;
use Illuminate\Support\Facades\Artisan;

Artisan::command('test-weather-service', function (WeatherService $weatherService) {
    dd(
        $weatherService->getCurrentByCity('東京都')
    );
});

Artisan::command('test-map-service', function (MapService $mapService) {
    dd(
        //$mapService->autocomplete(['query' => 'Osaka'])
        //$mapService->getPlaces(['query' => 'Tokyo'])
        //$mapService->venuesTrending([
        //    'query' => [
        //        'near' => 'Japan',
        //    ]
        //])
    );
});
