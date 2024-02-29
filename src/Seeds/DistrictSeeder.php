<?php

namespace Dipantry\CekOngkir\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictSeeder extends Seeder
{
    public function run(): void
    {
        $csv = new CsvToArray();
        $file = dirname(__FILE__, 3).'/resources/csv/districts.csv';
        $header = ['id', 'name', 'city_id'];
        $data = $csv->toArray($file, $header);

        $collection = collect($data);
        foreach ($collection->chunk(50) as $chunk) {
            DB::table(config('cekongkir.table_prefix').'districts')
                ->insertOrIgnore($chunk->toArray());
        }
    }
}