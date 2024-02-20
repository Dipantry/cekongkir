<?php

namespace Dipantry\CekOngkir\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SeedCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ongkir:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed CekOngkir database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        Artisan::call('db:seed', ['--class' => 'Dipantry\CekOngkir\Seeds\DatabaseSeeder', '--force' => true]);
        $this->info('Seeded: CekOngkir Database');
    }
}