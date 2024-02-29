<?php

namespace Dipantry\CekOngkir\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property int $city_id
 * @property-read CKCity $city
 * @property-read Collection<int, CKVillage> $villages
 */
class CKDistrict extends Model
{
    public $timestamps = false;

    public function __construct(array $attributes = [])
    {
        $this->table = config('cekongkir.table_prefix') . 'districts';
        parent::__construct($attributes);
    }

    public function city()
    {
        return $this->belongsTo(CKCity::class, 'city_id');
    }

    public function villages()
    {
        return $this->hasMany(CKVillage::class, 'district_id');
    }
}