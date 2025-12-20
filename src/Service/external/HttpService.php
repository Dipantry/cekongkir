<?php

namespace Dipantry\CekOngkir\Service\external;

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
    public function post(string $url, array $params, string $key)
    {
        try {
            $response = Http::withHeaders($this->getHeaders())
                ->connectTimeout($this->timeout)->post($this->baseUrl.$url, $params);
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

    private function getHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:122.0) Gecko/20100101 Firefox/122.0',
            'Origin' => 'https://shipper.id',
            'Accept-Language' => 'en-US,en;q=0.5',
            'x-app-name' => 'shp-homepage-v5',
            'x-app-version' => '1.0.0',
            'Referer' => 'https://shipper.id/',
        ];
    }
}