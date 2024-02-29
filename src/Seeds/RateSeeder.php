<?php

namespace Dipantry\CekOngkir\Seeds;

use Flynsarmy\CsvSeeder\CsvSeeder;
use Illuminate\Support\Facades\DB;

class RateSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->table = config('cekongkir.table_prefix').'rates';
        $this->filename = dirname(__FILE__, 3).'/resources/csv/rates.csv';
        $this->csv_delimiter = '|';
        $this->offset_rows = 1;
        $this->mapping = [
            0 => 'id',
            1 => 'name',
            2 => 'type',
            3 => 'courier_id',
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