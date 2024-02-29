<?php

namespace Dipantry\CekOngkir\Tests;

use Dipantry\CekOngkir\Facade;
use JetBrains\PhpStorm\ArrayShape;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public string $courierSeeder = 'Dipantry\CekOngkir\Seeds\CourierSeeder';
    public string $rateSeeder = 'Dipantry\CekOngkir\Seeds\RateSeeder';
    public string $provinceSeeder = 'Dipantry\CekOngkir\Seeds\ProvinceSeeder';
    public string $citySeeder = 'Dipantry\CekOngkir\Seeds\CitySeeder';
    public string $districtSeeder = 'Dipantry\CekOngkir\Seeds\DistrictSeeder';
    public string $villageSeeder = 'Dipantry\CekOngkir\Seeds\VillageSeeder';

    public function setUp(): void
    {
        parent::setUp();
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    public function getPackageProviders($app): array
    {
        return [
            FakeServiceProvider::class,
        ];
    }

    #[ArrayShape(['CekOngkir' => 'string'])]
    public function getPackageAliases($app): array
    {
        return [
            'CekOngkir' => Facade::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
        ]);
    }
}