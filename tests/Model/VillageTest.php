<?php

namespace Dipantry\CekOngkir\Tests\Model;

use Dipantry\CekOngkir\Models\CKDistrict;
use Dipantry\CekOngkir\Models\CKVillage;
use Dipantry\CekOngkir\Tests\TestCase;
use Illuminate\Support\Facades\DB;

class VillageTest extends TestCase
{
    public function testVillageHasDistrict()
    {
        $this->seed($this->villageSeeder);
        $this->seed($this->districtSeeder);

        $village = CKVillage::first();

        $this->assertInstanceOf(CKDistrict::class, $village->district);
        $this->assertEquals($village->district_id, $village->district->id);
    }

    public function testVillageHasAttributes()
    {
        $this->seed($this->villageSeeder);

        $village = CKVillage::first();

        $this->assertEquals('Pulukan', $village->name);
    }

    public function testVillageHasAllData()
    {
        $this->seed($this->villageSeeder);

        $list = CKVillage::all();
        $first = $list->first();

        $this->assertEquals(81231, $list->count());
        $this->assertEquals(CKVillage::first()->id, $first->id);
    }
}