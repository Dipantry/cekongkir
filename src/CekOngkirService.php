<?php

namespace Dipantry\CekOngkir;

use Dipantry\CekOngkir\Constants\Constant;
use Dipantry\CekOngkir\Constants\URLs;
use Dipantry\CekOngkir\Controller\BaseCekOngkir;
use Dipantry\CekOngkir\Exception\ApiResponseException;

class CekOngkirService extends BaseCekOngkir
{
    /**
     * @throws ApiResponseException
     */
    public function getOngkirCost(
        int $origin,
        int $destination,
        int $weight = 1,
        int $width = 1,
        int $length = 1,
        int $height = 1,
        int $totalValue = 1,
    ) {
        $body = [
            'originAreaId'      => $origin,
            'destinationAreaId' => $destination,
            'weight'      => $weight,
            'width'       => $width,
            'length'      => $length,
            'height'      => $height,
            'itemValue'  => $totalValue,
            'validToOrder' => true
        ];

        $fullBody = [
            'operationName' => 'pricingDomestic',
            'variables' => [
                'payload' => $body
            ],
            'query' => Constant::$ongkirQuery
        ];

        $url = URLs::$baseUrl . URLs::$query;
        $data = $this->postHttp($url, $fullBody);

        return $data;
    }
}