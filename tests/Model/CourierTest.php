<?php

namespace Dipantry\CekOngkir\Tests\Model;

use Dipantry\CekOngkir\Models\CKCourier;
use Dipantry\CekOngkir\Models\CKRate;
use Dipantry\CekOngkir\Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;

class CourierTest extends TestCase
{
    public function testCourierHasManyRates()
    {
        $this->seed($this->courierSeeder);
        $this->seed($this->rateSeeder);

        $courier = CKCourier::first();

        $this->assertInstanceOf(Collection::class, $courier->rates);
        $this->assertInstanceOf(CKRate::class, $courier->rates->first());
        $this->assertEquals(6, $courier->rates->count());
    }

    public function testCourierHasAttribute()
    {
        $this->seed($this->courierSeeder);

        $courier = CKCourier::first();

        $this->assertEquals('JNE', $courier->code);
        $this->assertEquals('JNE', $courier->name);
    }

    public function testCourierHasAllData()
    {
        $this->seed($this->courierSeeder);

        $list = CKCourier::all();
        $first = $list->first();

        $this->assertEquals(11, $list->count());
        $this->assertEquals(CKCourier::first()->id, $first->id);
    }
}