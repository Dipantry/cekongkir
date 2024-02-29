<?php

namespace Dipantry\CekOngkir\Tests\Model;

use Dipantry\CekOngkir\Models\CKCity;
use Dipantry\CekOngkir\Models\CKProvince;
use Dipantry\CekOngkir\Models\CKDistrict;
use Dipantry\CekOngkir\Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;

class CityTest extends TestCase
{
    public function testCityHasManyDistricts()
    {
        $this->seed($this->citySeeder);
        $this->seed($this->districtSeeder);

        $city = CKCity::first();

        $this->assertInstanceOf(Collection::class, $city->districts);
        $this->assertInstanceOf(CKDistrict::class, $city->districts->first());
        $this->assertEquals(5, $city->districts->count());
    }

    public function testCityHasProvince()
    {
        $this->seed($this->provinceSeeder);
        $this->seed($this->citySeeder);

        $city = CKCity::first();

        $this->assertInstanceOf(CKProvince::class, $city->province);
        $this->assertEquals($city->province_id, $city->province->id);
    }

    public function testCityHasAttributes()
    {
        $this->seed($this->citySeeder);

        $city = CKCity::first();

        $this->assertEquals('Jembrana', $city->name);
    }

    public function testCityHasAllData()
    {
        $this->seed($this->citySeeder);

        $list = CKCity::all();
        $first = $list->first();

        $this->assertEquals(509, $list->count());
        $this->assertEquals(CKCity::first()->id, $first->id);
    }
}