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
        Schema::create(config('cekongkir.table_prefix').'couriers', function ($table) {
            $table->id();
            $table->string('name', 100);
            $table->string('code', 100);
            $table->string('image_url', 255);
            $table->string('company_name', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::drop(config('cekongkir.table_prefix').'couriers');
    }
};