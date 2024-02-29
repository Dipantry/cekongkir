<?php

namespace Dipantry\CekOngkir\Tests\Model;

use Dipantry\CekOngkir\Models\CKCourier;
use Dipantry\CekOngkir\Models\CKRate;
use Dipantry\CekOngkir\Tests\TestCase;

class RateTest extends TestCase
{
    public function testRateHasCourier()
    {
        $this->seed($this->courierSeeder);
        $this->seed($this->rateSeeder);

        $rate = CKRate::first();

        $this->assertInstanceOf(CKCourier::class, $rate->courier);
        $this->assertEquals($rate->courier_id, $rate->courier->id);
    }

    public function testRateHasAttributes()
    {
        $this->seed($this->rateSeeder);

        $rate = CKRate::first();

        $this->assertEquals('Express', $rate->name);
        $this->assertEquals('Regular', $rate->type);
    }

    public function testRateHasAllData()
    {
        $this->seed($this->rateSeeder);

        $list = CKRate::all();
        $first = $list->first();

        $this->assertEquals(20, $list->count());
        $this->assertEquals(CKRate::first()->id, $first->id);
    }
}