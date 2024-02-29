<?php

namespace Dipantry\CekOngkir\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $csv = new CsvToArray();
        $file = dirname(__FILE__, 3).'/resources/csv/cities.csv';
        $header = ['id', 'name', 'province_id'];
        $data = $csv->toArray($file, $header);

        $collection = collect($data);
        foreach ($collection->chunk(50) as $chunk) {
            DB::table(config('cekongkir.table_prefix').'cities')
                ->insertOrIgnore($chunk->toArray());
        }
    }
}