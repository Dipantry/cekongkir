<?php

namespace Dipantry\CekOngkir\Dto;

/**
 * @property-read string $dateTime
 * @property-read string $name
 * @property-read string $description
 */
class TrackingDetailDto
{
    public function __construct(
        public readonly string $dateTime,
        public readonly string $name,
        public readonly string $description
    ) {}
}