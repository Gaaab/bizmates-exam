<?php

namespace Bizmates\Controllers\Api;

use App\Http\Controllers\Controller;
use Bizmates\Services\WeatherService;
use Illuminate\Http\Request;

class WeathersController extends Controller
{
    public function __construct(
        protected WeatherService $weatherService
    )
    {
    }

    public function getWeatherByCoordinates(Request $request)
    {
        $validated = $request->validate([
            'lat' => [
                'required',
                'numeric',
            ],
            'lng' => [
                'required',
                'numeric',
            ],
        ]);

        return $this->weatherService->getByCoordinates(...$validated);
    }

    public function getWeatherByCity(Request $request)
    {
        $validated = $request->validate([
            'state' => 'required',
        ]);

        return $this->weatherService->getCurrentByCity($validated['state']);
    }
}
