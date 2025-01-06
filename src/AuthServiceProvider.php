<?php

namespace Kasparsb\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

use Kasparsb\Auth\TextUserProvider;

class AuthServiceProvider extends ServiceProvider
{

    public function register(): void
    {

    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/config/fileauth.php' => config_path('fileauth.php'),
        ]);

        //$this->loadMigrationsFrom(__DIR__.'/database/migrations');

        // if ($this->app->runningInConsole()) {
        //     $this->commands([
        //         CreateFileFromUrlCommand::class,
        //     ]);
        // }

        $this->loadViewsFrom(__DIR__.'/resources/views', 'auth');

        $this->loadRoutesFrom(__DIR__.'/routes/web.php');

        Auth::provider('text', function ($app, array $config) {
            // Return an instance of Illuminate\Contracts\Auth\UserProvider...
            return new TextUserProvider();
        });
    }
}
