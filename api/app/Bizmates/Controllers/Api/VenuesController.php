<?php

namespace Bizmates\Controllers\Api;

use App\Http\Controllers\Controller;
use Bizmates\Services\MapService;
use Illuminate\Http\Request;

class VenuesController extends Controller
{
    public function __construct(
        protected MapService $mapService
    )
    {
    }

    public function getAutocomplete(Request $request)
    {
        $validated = $request->validate([
            'query' => [
                'required',
                'min:3',
                'string',
            ],
        ]);

        return $this->mapService->autocomplete($validated);
    }

    public function getVenuesTrending(Request $request)
    {
        $validated = $request->validate([
            'query' => [
                'required',
                'array',
            ],
            'query.near' => [
                'required',
                'string'
            ],
        ]);

        // @TODO: Have ability to edit on UI
        $validated['radius'] = 50000;

        return $this->mapService->venuesTrending($validated);
    }
}
