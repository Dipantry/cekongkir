<?php

namespace Dipantry\CekOngkir\Seeds;

use Flynsarmy\CsvSeeder\CsvSeeder;
use Illuminate\Support\Facades\DB;

class DistrictSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->table = config('cekongkir.table_prefix').'districts';
        $this->filename = dirname(__FILE__, 3).'/resources/csv/districts.csv';
        $this->csv_delimiter = '|';
        $this->offset_rows = 1;
        $this->mapping = [
            0 => 'id',
            1 => 'name',
            2 => 'city_id',
        ];
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::disableQueryLog();
        DB::table($this->table);

        parent::run();
    }
}