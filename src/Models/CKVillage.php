<?php

namespace Dipantry\CekOngkir\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property int $district_id
 * @property-read CKDistrict $district
 */
class CKVillage extends Model
{
    public $timestamps = false;

    public function __construct(array $attributes = [])
    {
        $this->table = config('cekongkir.table_prefix') . 'villages';
        parent::__construct($attributes);
    }

    public function district()
    {
        return $this->belongsTo(CKDistrict::class, 'district_id');
    }
}