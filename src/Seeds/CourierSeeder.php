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
        $this->csv_delimiter = ',';
        $this->offset_rows = 1;
        $this->mapping = [
            0 => 'id',
            1 => 'courier_name',
            2 => 'courier_code',
            3 => 'do_cash_on_delivery',
            4 => 'courier_service_name',
            5 => 'courier_service_code',
            6 => 'tier',
            7 => 'description',
            8 => 'service_type',
            9 => 'shipping_type',
            10 => 'shipment_duration_range',
            11 => 'shipment_duration_unit',
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