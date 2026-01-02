<?php

namespace Dipantry\CekOngkir\Dto;

/**
 * @property-read string $name
 * @property-read string $address
 */
class PersonDto
{
    public function __construct(
        public readonly string $name,
        public readonly string $address,
    ) {}
}