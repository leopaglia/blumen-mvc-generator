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
        $this->registerRESTGenerator();
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

    /**
     * Register the make:rest generator command.
     */
    private function registerRESTGenerator() {
        $this->app->singleton('command.makerest', function ($app) {
            return $app['Blumen\Generators\Commands\RESTCommand'];
        });
        $this->commands('command.makerest');
    }

}