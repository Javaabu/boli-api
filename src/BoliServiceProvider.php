<?php

namespace Javaabu\Boli;

use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;

class BoliServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->singleton(Boli::class, function () {
            $config = $this->app['config']['services.boli'];
            $username = Arr::get($config, 'username');
            $password = Arr::get($config, 'password');
            $url = Arr::get($config, 'url');
            $client_options = Arr::get($config, 'client_options');

            return new Boli($username ?: '', $password ?: '', $url ?: null, $client_options ?: []);
        });

        // Register the main class to use with the facade
        $this->app->singleton('boli', function () {
            return $this->app->make(Boli::class);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [Boli::class];
    }
}
