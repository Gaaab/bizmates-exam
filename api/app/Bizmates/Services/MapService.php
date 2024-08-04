<?php

namespace Bizmates\Services;

use Bizmates\Services\Foursquare\Foursquare;

class MapService
{
    protected $mapService;

    public function __construct()
    {
        $this->mapService = app('bizmates-foursquare');
    }

    public function places(array $search = [])
    {
        return $this->mapService->places($search);
    }

    public function venuesTrending(array $search = [])
    {
        $data = $this->mapService->venuesTrending($search);
        return $data['response'] ?? [];
    }

    public function autocomplete(array $query = [])
    {
        return $this->mapService->autocomplete($query);
    }
}
