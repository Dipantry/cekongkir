<?php

namespace Dipantry\CekOngkir\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property-read Collection<int, CKCity> $cities
 */
class CKProvince extends Model
{
    public $timestamps = false;

    public function __construct(array $attributes = [])
    {
        $this->table = config('cekongkir.table_prefix') . 'provinces';
        parent::__construct($attributes);
    }

    public function cities()
    {
        return $this->hasMany(CKCity::class, 'province_id');
    }
}