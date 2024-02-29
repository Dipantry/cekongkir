<?php

namespace Dipantry\CekOngkir\Tests\Model;

use Dipantry\CekOngkir\Models\CKCity;
use Dipantry\CekOngkir\Models\CKDistrict;
use Dipantry\CekOngkir\Models\CKVillage;
use Dipantry\CekOngkir\Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;

class DistrictTest extends TestCase
{
    public function testDistrictHasManyVillages()
    {
        $this->seed($this->districtSeeder);
        $this->seed($this->villageSeeder);

        $district = CKDistrict::first();

        $this->assertInstanceOf(Collection::class, $district->villages);
        $this->assertInstanceOf(CKVillage::class, $district->villages->first());
        $this->assertEquals(8, $district->villages->count());
    }

    public function testDistrictHasCity()
    {
        $this->seed($this->citySeeder);
        $this->seed($this->districtSeeder);

        $district = CKDistrict::first();

        $this->assertInstanceOf(CKCity::class, $district->city);
        $this->assertEquals($district->city_id, $district->city->id);
    }

    public function testDistrictHasAttributes()
    {
        $this->seed($this->districtSeeder);

        $district = CKDistrict::first();

        $this->assertEquals('Pekutatan', $district->name);
    }

    public function testDistrictHasAllData()
    {
        $this->seed($this->districtSeeder);

        $list = CKDistrict::all();
        $first = $list->first();

        $this->assertEquals(7003, $list->count());
        $this->assertEquals(CKDistrict::first()->id, $first->id);
    }
}