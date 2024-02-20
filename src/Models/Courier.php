<?php

namespace Dipantry\CekOngkir\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $courierName
 * @property string $courierCode
 * @property bool $doCashOnDelivery
 * @property string $courierServiceName
 * @property string $courierServiceCode
 * @property string $tier
 * @property string $description
 * @property string $serviceType
 * @property string $shippingType
 * @property string $shipmentDurationRange
 * @property string $shipmentDurationUnit
 */
class Courier extends Model
{
    protected $table = 'couriers';

    public $timestamps = false;

    public function __construct(array $attributes = [])
    {
        $this->table = config('cekongkir.table_prefix') . 'couriers';
        parent::__construct($attributes);
    }
}