<?php

namespace Dipantry\CekOngkir\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $type
 * @property int $courier_id
 * @property-read CKCourier $courier
 */
class CKRate extends Model
{
    public $timestamps = false;

    public function __construct(array $attributes = [])
    {
        $this->table = config('cekongkir.table_prefix') . 'rates';
        parent::__construct($attributes);
    }

    public function courier()
    {
        return $this->belongsTo(CKCourier::class, 'courier_id');
    }
}