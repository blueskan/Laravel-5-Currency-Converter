<?php namespace Senemoglu\Currency;

use GuzzleHttp\Client;
use GuzzleHttp\Message\Response;
use Senemoglu\Currency\Contracts\ServiceInterface;
use Senemoglu\Currency\Exceptions\ApiDownException;

class Converter {
    protected $client;
    protected $service;

    public function __construct(Client $client, ServiceInterface $service)
    {
        $this->client = $client;
        $this->service = $service;
    }

    public function convert($from, $to, $amount = 1)
    {
        $response = $this->makeRequest($from, $to);

        if ( $response->getStatusCode() != 200) {
            throw new ApiDownException();
        }

        $rate = $this->service->parseResponse($response);

        return $this->calculate($rate, $amount);
    }

    protected function calculate($rate, $amount)
    {
        return $rate * $amount;
    }

    protected function makeRequest($from, $to)
    {
        $url = config('currency.api_url');
        $url = str_replace(
            ['{{from}}', '{{to}}'],
            [$from, $to],
            $url
        );

        return $this->client->get($url);
    }
} 