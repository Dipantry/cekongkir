<?php

namespace Dipantry\CekOngkir\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property int $province_id
 * @property-read CKProvince $province
 * @property-read Collection<int, CKDistrict> $districts
 * @property-read int|null $districts_count
 */
class CKCity extends Model
{
    public $timestamps = false;

    public function __construct(array $attributes = [])
    {
        $this->table = config('cekongkir.table_prefix') . 'cities';
        parent::__construct($attributes);
    }

    public function province()
    {
        return $this->belongsTo(CKProvince::class, 'province_id');
    }

    public function districts()
    {
        return $this->hasMany(CKDistrict::class, 'city_id');
    }
}