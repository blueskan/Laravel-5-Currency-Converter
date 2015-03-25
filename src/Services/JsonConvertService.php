<?php namespace Senemoglu\Currency\Services;

use Senemoglu\Currency\Contracts\ServiceInterface;
use GuzzleHttp\Message\Response;

class JsonConvertService implements ServiceInterface
{
    public function parseResponse(Response $response)
    {
        $response = $response->getBody()->getContents();

        return $this->handler(json_decode($response, true));
    }

    protected function handler($response)
    {
        return current($response)['val'];
    }
}