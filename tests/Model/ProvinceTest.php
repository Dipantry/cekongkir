<?php

namespace Dipantry\CekOngkir\Tests\Model;

use Dipantry\CekOngkir\Models\CKCity;
use Dipantry\CekOngkir\Models\CKProvince;
use Dipantry\CekOngkir\Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;

class ProvinceTest extends TestCase
{
    public function testProvinceHasManyCities()
    {
        $this->seed($this->provinceSeeder);
        $this->seed($this->citySeeder);

        $province = CKProvince::first();

        $this->assertInstanceOf(Collection::class, $province->cities);
        $this->assertInstanceOf(CKCity::class, $province->cities->first());
        $this->assertEquals(9, $province->cities->count());
    }

    public function testProvinceHasAttributes()
    {
        $this->seed($this->provinceSeeder);

        $province = CKProvince::first();

        $this->assertEquals('Bali', $province->name);
    }

    public function testProvinceHasAllData()
    {
        $this->seed($this->provinceSeeder);

        $list = CKProvince::all();
        $first = $list->first();

        $this->assertEquals(34, $list->count());
        $this->assertEquals(CKProvince::first()->id, $first->id);
    }
}