<?php

namespace Blumen\Generators\Providers;

use Illuminate\Support\ServiceProvider;

class GeneratorServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {}

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        $this->registerMVCGenerator();
    }

    /**
     * Register the make:mvc generator command.
     */
    private function registerMVCGenerator() {
        $this->app->singleton('command.makemvc', function ($app) {
            return $app['Blumen\Generators\Commands\MVCCommand'];
        });
        $this->commands('command.makemvc');
    }

}