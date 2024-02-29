<?php

namespace Dipantry\CekOngkir\Service;

use Dipantry\CekOngkir\Exception\ApiResponseException;
use Exception;
use Illuminate\Support\Facades\Http;

class HttpService
{
    private string $baseUrl;
    private int $timeout;

    public function __construct(string $baseUrl, int $timeout)
    {
        $this->baseUrl = $baseUrl;
        $this->timeout = $timeout;
    }

    /**
     * @throws ApiResponseException
     */
    public function get(string $url, array $params, string $key)
    {
        try {
            $response = Http::timeout($this->timeout)->get($this->baseUrl.$url, $params);
        } catch (Exception) {
            throw new ApiResponseException('Connection Timed Out');
        }

        if (!$response->ok()) {
            throw new ApiResponseException($response->reason(), $response->status());
        }

        try {
            $result = $response[$key];
        } catch (Exception) {
            throw new ApiResponseException(
                $response['error'] ?? 'Unknown Error',
                $response->status() ?? 500
            );
        }

        return $result;
    }

    /**
     * @throws ApiResponseException
     */
    public function post(string $url, array $params, string $key)
    {
        try {
            $response = Http::timeout($this->timeout)->post($this->baseUrl.$url, $params);
        } catch (Exception) {
            throw new ApiResponseException('Connection Timed Out');
        }

        if (!$response->ok()) {
            throw new ApiResponseException($response->reason(), $response->status());
        }

        try {
            $result = $response[$key];
        } catch (Exception) {
            throw new ApiResponseException(
                $response['error'] ?? 'Unknown Error',
                $response->status() ?? 500
            );
        }

        return $result;
    }
}