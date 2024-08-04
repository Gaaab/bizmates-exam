<?php

namespace Bizmates\Services\Foursquare;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;

class FoursquareClient
{
    /**
     * The default Foursquare API url
     *
     * @var string
     */
    protected $apiUrl = 'https://api.foursquare.com/%version%/';

    /** @var Client */
    protected $httpClient;

    /** @var array */
    protected $config;

    protected $apiVersion = 'v3';

    public function __construct(array $config, $apiVersion = 'v3')
    {
        $this->config = $config;
        $this->apiVersion = $apiVersion;
        $this->httpClient = $this->createHttpClientInstance();
    }

    public function createHttpClientInstance(): Client
    {
        return new Client([
            'http_errors'   => true,
            'verify'        => false,
            'debug'         => false,
            'base_uri'      => $this->getApiUrl(),
            'headers'       => $this->getHttpClientHeaders(),
            'timeout'       => 10.0,
        ]);
    }

    public function getApiUrl(): string
    {
        return str_replace('%version%', $this->getApiVersion(), $this->apiUrl);
    }

    public function setApiVersion($version)
    {
        if (!in_array($version, ['v2', 'v3'])) {
            throw new InvalidArgumentException("{$version} is not supported");
        }

        $this->apiVersion = $version;

        // Reload instance
        $this->httpClient = $this->createHttpClientInstance();

        return $this;
    }

    public function getApiVersion(): string
    {
        return $this->apiVersion;
    }

    public function getHttpClientHeaders(): array
    {
        return [
            'Authorization' => $this->config['api_key'],
            'Accept' => 'application/json',
            'Content-type'  => 'application/json; charset=utf-8',
        ];
    }

    public function getHttpClient(): Client
    {
        return $this->httpClient;
    }

    /**
     * For version 2
    */
    public function getClientQueryHeaders()
    {
        return [
            'oauth_token' => $this->config['service_api_key'],
            'v' => date('Ymd'),
        ];
    }

    public function get(string $path, array $options = []): ResponseInterface
    {
        try {
            $parsedOptions = [];

            // Check version and append oauth token as per requirement
            if ($this->getApiVersion() === 'v2' && isset($options['query'])) {
                $parsedOptions['query'] = array_merge(
                    $this->getClientQueryHeaders(),
                    $options['query']
                );
            }

            return $this->getHttpClient()->request('GET', $path, $parsedOptions ?? $options);
        } catch (ServerException $e) {
            throw new Exception("Internal server error on FourSquare.", $e->getCode());
        } catch (ClientException $e) {
            throw new Exception("Client exception error on FourSquare.", $e->getCode());
        }
        catch (Exception $e) {
            throw $e;
        }
    }
}
