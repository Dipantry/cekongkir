<?php

namespace Dipantry\CekOngkir\Dto;

/**
 * @property-read string $id
 * @property-read string $name
 * @property-read string $type
 * @property-read string $courier_id
 */
class RateDto
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $type,
        public readonly string $courier_id
    ) {}
}