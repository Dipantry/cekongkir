<?php

namespace Dipantry\CekOngkir\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        $this->reset();

        $this->call(CourierSeeder::class);
        $this->call(RateSeeder::class);

        $this->call(ProvinceSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(DistrictSeeder::class);
        $this->call(VillageSeeder::class);

        Schema::enableForeignKeyConstraints();
    }

    private function reset(): void
    {
        DB::table(config('rajaongkir.table_prefix').'couriers')->truncate();
    }
}