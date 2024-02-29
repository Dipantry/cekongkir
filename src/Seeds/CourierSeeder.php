<?php

namespace Dipantry\CekOngkir\Seeds;

use Flynsarmy\CsvSeeder\CsvSeeder;
use Illuminate\Support\Facades\DB;

class CourierSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->table = config('cekongkir.table_prefix').'couriers';
        $this->filename = dirname(__FILE__, 3).'/resources/csv/couriers.csv';
        $this->csv_delimiter = '|';
        $this->offset_rows = 1;
        $this->mapping = [
            0 => 'id',
            1 => 'name',
            2 => 'code',
            3 => 'image_url',
            4 => 'company_name',
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