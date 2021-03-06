<?php

namespace OsrmClient\OverpassAPI;

use GuzzleHttp\Client as HttpClient;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use GuzzleHttp\Exception\ClientException;
use OsrmClient\Iterator\Osm3sXmlIterator;

class Client
{
    protected $httpClient;
    protected $logger;

    public function __construct(HttpClient $httpClient = null, LoggerInterface $logger = null)
    {
        $this->httpClient = $httpClient ?: $this->getDefaultHttpClient();

        if (!isset($this->httpClient->getConfig()['base_uri'])) {
            throw new \InvalidArgumentException('You must specify a base_uri for your Guzzle client');
        }

        $this->logger = $logger ?: new NullLogger();
    }

    /**
     * Send a query to the API interpreter.
     *
     * @param string $query
     *
     * @return Osm3xXmlAdapter
     */
    public function search($query)
    {
        try {
            $response = $this->httpClient->post('/api/interpreter', [
                'body' => $query
            ]);
        } catch (ClientException $e) {
            // Crate new exceptions
            throw $e;
        }

        return new Osm3sXmlIterator((string) $response->getBody());
    }

    /**
     * getDefaultHttpClient
     *
     * @return HttpClient
     */
    protected function getDefaultHttpClient()
    {
        return new HttpClient([
            'base_uri' => 'http://overpass-api.de',
        ]);
    }
}
