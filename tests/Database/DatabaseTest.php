<?php

namespace Dipantry\CekOngkir\Tests\Database;

use Dipantry\CekOngkir\Models\CKCity;
use Dipantry\CekOngkir\Models\CKCourier;
use Dipantry\CekOngkir\Models\CKDistrict;
use Dipantry\CekOngkir\Models\CKProvince;
use Dipantry\CekOngkir\Models\CKRate;
use Dipantry\CekOngkir\Models\CKVillage;
use Dipantry\CekOngkir\Tests\TestCase;

class DatabaseTest extends TestCase
{
    public function testDatabaseSeed()
    {
        $this->artisan('cekongkir:seed');

        $couriers = CKCourier::all();
        $this->assertNotEmpty($couriers);

        $rates = CKRate::all();
        $this->assertNotEmpty($rates);

        $provinces = CKProvince::all();
        $this->assertNotEmpty($provinces);

        $cities = CKCity::all();
        $this->assertNotEmpty($cities);

        $districts = CKDistrict::all();
        $this->assertNotEmpty($districts);

        $villages = CKVillage::all();
        $this->assertNotEmpty($villages);
    }
}