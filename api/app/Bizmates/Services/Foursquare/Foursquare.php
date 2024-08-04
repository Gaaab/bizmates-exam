<?php

namespace Bizmates\Services\Foursquare;

use Illuminate\Database\Eloquent\Casts\Json;
use InvalidArgumentException;

class Foursquare
{
    /** @var FoursquareClient */
    protected $client;

    public function __construct(array $config)
    {
        if (!isset($config['api_key']))
            throw new InvalidArgumentException('Expected values for api_key');

        $this->client = (new FoursquareClient($config));
    }

    public function places(array $options = []): array
    {
        $response =  $this->client->get('places/search', $options);

        return Json::decode(
            $response->getBody()->getContents(),
        );
    }

    public function venuesTrending(array $options = []): array
    {
        $response = $this->client
            ->setApiVersion('v2')
            ->get('venues/trending', $options);

        return Json::decode(
            $response->getBody()->getContents(),
        );
    }

    public function venueDetails($venue_id, array $options = []): array
    {
        $response = $this->client
            ->setApiVersion('v2')
            ->get("venues/{$venue_id}", $options);

        return Json::decode(
            $response->getBody()->getContents(),
        );
    }

    public function autocomplete(array $options = []): array
    {
        $response =  $this->client->get('autocomplete', $options);

        return Json::decode(
            $response->getBody()->getContents(),
        );
    }
}
