<?php

namespace Dipantry\CekOngkir\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourierSeeder extends Seeder
{
    public function run(): void
    {
        $csv = new CsvToArray();
        $file = dirname(__FILE__, 3).'/resources/csv/couriers.csv';
        $header = ['id', 'name', 'code', 'image_url', 'company_name'];
        $data = $csv->toArray($file, $header);

        $collection = collect($data);
        foreach ($collection->chunk(50) as $chunk) {
            DB::table(config('cekongkir.table_prefix').'couriers')
                ->insertOrIgnore($chunk->toArray());
        }
    }
}