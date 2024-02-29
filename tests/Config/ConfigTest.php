<?php

namespace Dipantry\CekOngkir\Tests\Config;

use Dipantry\CekOngkir\Tests\TestCase;

class ConfigTest extends TestCase
{
    public function testConfigPrefix()
    {
        $this->assertEquals('cekongkir_', config('cekongkir.table_prefix'));
    }

    public function testConfigTimeout()
    {
        $this->assertEquals(30, config('cekongkir.timeout'));
    }
}