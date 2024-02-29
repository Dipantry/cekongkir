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
        DB::table(config('cekongkir.table_prefix').'couriers')->truncate();
        DB::table(config('cekongkir.table_prefix').'rates')->truncate();
        DB::table(config('cekongkir.table_prefix').'provinces')->truncate();
        DB::table(config('cekongkir.table_prefix').'cities')->truncate();
        DB::table(config('cekongkir.table_prefix').'districts')->truncate();
        DB::table(config('cekongkir.table_prefix').'villages')->truncate();
    }
}