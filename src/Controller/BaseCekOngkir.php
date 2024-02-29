<?php

namespace Dipantry\CekOngkir\Controller;

use Dipantry\CekOngkir\Constants\URLs;
use Dipantry\CekOngkir\Exception\ApiResponseException;
use Dipantry\CekOngkir\Service\HttpService;

class BaseCekOngkir
{
    private HttpService $httpService;

    public function __construct()
    {
        $timeout = config('cekongkir.timeout');
        $baseUrl = URLs::$baseUrl;

        $this->httpService = new HttpService($baseUrl, $timeout);
    }

    /* @throws ApiResponseException */
    public function getHttp($url, $params = [])
    {
        return $this->httpService->get($url, $params, 'data');
    }

    /* @throws ApiResponseException */
    public function postHttp($url, $body = [])
    {
        return $this->httpService->post($url, $body, 'data');
    }
}