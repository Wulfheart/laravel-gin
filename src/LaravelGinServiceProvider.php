<?php

namespace Wulfheart\LaravelGin;

use Illuminate\Support\ServiceProvider;
use Wulfheart\LaravelGin\Commands\LaravelGinCommand;
use Wulfheart\LaravelGin\Commands\PublishCommand;

class LaravelGinServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/laravel-gin.php' => config_path('laravel-gin.php'),
            ], 'config');

            $this->publishes([
                __DIR__ . '/../resources/views' => base_path('resources/views/vendor/laravel-gin'),
            ], 'views');

            $migrationFileName = 'create_laravel_gin_table.php';
            if (! $this->migrationFileExists($migrationFileName)) {
                $this->publishes([
                    __DIR__ . "/../database/migrations/{$migrationFileName}.stub" => database_path('migrations/' . date('Y_m_d_His', time()) . '_' . $migrationFileName),
                ], 'migrations');
            }

            $this->commands([
                LaravelGinCommand::class,
                PublishCommand::class,
            ]);
        }
        
        $this->loadRoutesFrom(__DIR__ . "/Routes/web.php");
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'laravel-gin');
      
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/laravel-gin.php', 'laravel-gin');
    }

    public static function migrationFileExists(string $migrationFileName): bool
    {
        $len = strlen($migrationFileName);
        foreach (glob(database_path("migrations/*.php")) as $filename) {
            if ((substr($filename, -$len) === $migrationFileName)) {
                return true;
            }
        }

        return false;
    }
}
