<?php

namespace Dipantry\CekOngkir;

use Dipantry\CekOngkir\Exception\ApiResponseException;

class CekOngkirService
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

    }
}