<?php

namespace Bizmates\Services;

use RakibDevs\Weather\Weather;

class WeatherService
{
    protected $weatherService;

    public function __construct(Weather $weather)
    {
        $this->weatherService = $weather;
    }

    public function getByCoordinates($lat, $lng)
    {
        return $this->weatherService->get3HourlyByCord($lat, $lng);
    }

    public function getCurrentByCity(string $city)
    {
        //return $this->weatherService->getCurrentByCity($city);
        return $this->weatherService->get3HourlyByCity($city);
    }
}
