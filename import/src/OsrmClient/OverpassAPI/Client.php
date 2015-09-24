<?php

namespace OsrmClient\OverpassAPI;

use GuzzleHttp\Client as HttpClient;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class Client
{
    protected $httpClient;

    public function __construct(HttpClient $httpClient = null, LoggerInterface $logger = null)
    {
        $this->httpClient = $httpClient ?: new HttpClient([
            'base_uri' => 'http://overpass-api.de/api/interpreter',
        ]);

        if (!isset($this->httpClient->getConfig()['base_uri'])) {
            throw new \InvalidArgumentException('You must specify a base_uri for your Guzzle client');
        }

        $this->logger = $logger ?: new NullLogger();
    }

    public function search($query)
    {
    }
}
