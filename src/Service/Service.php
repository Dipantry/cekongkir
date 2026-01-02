<?php

namespace Dipantry\CekOngkir\Service;

use Dipantry\CekOngkir\Constants\URLs;
use Dipantry\CekOngkir\Exception\ApiResponseException;
use Dipantry\CekOngkir\Service\External\HttpService;

class Service
{
    protected HttpService $httpService;

    public function __construct(int $timeout = 30)
    {
        $baseUrl = URLs::$baseUrl;

        $this->httpService = new HttpService($baseUrl, $timeout);
    }

    /* @throws ApiResponseException */
    public function postHttp($url, $operationName = '', $variables = [], $query = '')
    {
        return $this->httpService->post($url, [
            'operationName' => $operationName,
            'variables' => $variables,
            'query' => $query
        ], 'data');
    }
}