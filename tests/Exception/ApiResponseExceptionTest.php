<?php

namespace Dipantry\CekOngkir\Tests\Exception;

use Dipantry\CekOngkir\CekOngkirService;
use Dipantry\CekOngkir\Tests\TestCase;
use Dipantry\CekOngkir\Exception\ApiResponseException;
use Exception;
use Illuminate\Support\Facades\Config;

class ApiResponseExceptionTest extends TestCase
{
    public function testConnectionTimeout()
    {
        Config::set('cekongkir.timeout', 1);

        try {
            (new CekOngkirService())->getOngkirCost(1, 99);
        } catch (Exception $e) {
            $this->assertInstanceOf(ApiResponseException::class, $e);
            $this->assertEquals('Connection Timed Out', $e->getMessage());
        }
    }
}