<?php

namespace Dipantry\CekOngkir\Dto;

/**
 * @property-read string $id
 * @property-read string $name
 * @property-read string $code
 * @property-read string $logoUrl
 * @property-read string $companyName
 * @property-read bool $status
 */
class LogisticDto
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $code,
        public readonly string $logoUrl,
        public readonly string $companyName,
        public readonly bool $status
    ) {}
}