<?php namespace Senemoglu\Currency\Contracts;

use GuzzleHttp\Message\Response;

interface ServiceInterface {
    public function parseResponse(Response $response);
} 