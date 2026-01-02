<?php

namespace Dipantry\CekOngkir\Dto;

use Dipantry\CekOngkir\Models\CKCourier;
use Dipantry\CekOngkir\Models\CKRate;

/**
 * @property-read string $courierId
 * @property-read string $rateId
 * @property-read int $totalPrice
 * @property-read int $minDay
 * @property-read int $maxDay
 * @property-read int $finalPrice
 * @property-read int $discountedPrice
 * @property-read int $insurancePrice
 * @property-read int $surchargePrice
 * @property-read float $discountValue
 */
class PricingDto
{
    public function __construct(
        public readonly string $courierId,
        public readonly string $rateId,
        public readonly int $totalPrice,
        public readonly int $minDay,
        public readonly int $maxDay,
        public readonly int $finalPrice,
        public readonly int $discountedPrice,
        public readonly int $insurancePrice,
        public readonly int $surchargePrice,
        public readonly float $discountValue
    ){}

    public function courier(): CKCourier
    {
        return CKCourier::find($this->courierId);
    }

    public function rate(): CKRate
    {
        return CKRate::find($this->rateId);
    }
}