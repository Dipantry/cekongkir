<?php

namespace Dipantry\CekOngkir;

use Dipantry\CekOngkir\Commands\SeedCommand;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {
        $this->app->bind('cekongkir', function () {
            return new CekOngkir();
        });

        $this->commands([
            SeedCommand::class
        ]);
    }

    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/cekongkir.php',
            'cekongkir',
        );

        $databasePath = __DIR__.'/../database/migrations';
        if ($this->isLumen()) {
            $this->loadMigrationsFrom($databasePath);
        } else {
            $this->publishes(
                [$databasePath => database_path('migrations')],
                'migrations'
            );
        }

        if (class_exists(Application::class)) {
            $this->publishes([
                __DIR__.'/../config/cekongkir.php' => config_path('cekongkir.php'),
            ], 'config');
        }
    }

    protected function isLaravel(): bool
    {
        return app() instanceof Application;
    }

    protected function isLumen(): bool
    {
        return !$this->isLaravel();
    }
}