<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(config('cekongkir.table_prefix').'cities', function ($table) {
            $table->id();
            $table->string('name', 255);
            $table->bigInteger('province_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::drop(config('cekongkir.table_prefix').'cities');
    }
};