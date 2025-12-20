<?php

namespace Dipantry\CekOngkir\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string $image_url
 * @property string $company_name
 * @property bool $is_active
 * @property-read Collection<int, CKRate> $rates
 * @mixin Model
 */
class CKCourier extends Model
{
    public $timestamps = false;

    public function __construct(array $attributes = [])
    {
        $this->table = config('cekongkir.table_prefix') . 'couriers';
        parent::__construct($attributes);
    }

    public function rates()
    {
        return $this->hasMany(CKRate::class, 'courier_id');
    }
}