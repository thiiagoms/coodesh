<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Change default migrations path config
     *
     * @return void
     */
    private function customMigrations(): void
    {
        $migrationsPath = database_path('migrations');
        $directories    = glob($migrationsPath . '/*', GLOB_ONLYDIR);
        $paths          = array_merge([$migrationsPath], $directories);

        $this->loadMigrationsFrom($paths);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /**
         * Change default migrations path
         */
        $this->customMigrations();
    }
}
