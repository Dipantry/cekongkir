<?php

namespace Dipantry\CekOngkir\Dto;

use Dipantry\CekOngkir\Models\CKCourier;

/**
 * @property-read string $trackingNumber
 * @property-read string $courierId
 * @property-read string $shipmentDate
 * @property-read array $details
 * @property-read PersonDto $sender
 * @property-read PersonDto $recipient
 */
class TrackingDto
{
    public function __construct(
        public readonly string $trackingNumber,
        public readonly string $courierId,
        public readonly string $shipmentDate,
        public readonly array $details,
        public readonly PersonDto $sender,
        public readonly PersonDto $recipient,
    ){}

    public function courier(): CKCourier
    {
        return CKCourier::find($this->courierId);
    }
}