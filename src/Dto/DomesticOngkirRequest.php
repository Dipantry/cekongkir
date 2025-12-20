<?php

namespace Dipantry\CekOngkir\Dto;

/**
 * @property-read int $originId
 * @property-read int $destinationId
 * @property-read int $weight
 * @property-read int $length
 * @property-read int $height
 * @property-read int $quantity
 */
class DomesticOngkirRequest
{
    public function __construct(
        public int $originId,
        public int $destinationId,
        public int $weight = 1,
        public int $length = 1,
        public int $height = 1,
        public int $quantity = 1
    ) {}
}