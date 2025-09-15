<?php

namespace Kasparsb\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Console\AboutCommand;

use Kasparsb\Auth\TextUserProvider;
use Kasparsb\Auth\Console\Commands\ListUsersCommand;
use Kasparsb\Auth\Console\Commands\CreateUserCommand;
use Kasparsb\Auth\Console\Commands\DeleteUserCommand;

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

        $this->loadViewsFrom(__DIR__.'/resources/views', 'auth');

        $this->loadRoutesFrom(__DIR__.'/routes/web.php');

        Auth::provider('fileauth', function ($app, array $config) {
            // Must return instance of Illuminate\Contracts\Auth\UserProvider
            return new TextUserProvider();
        });


        /**
         * Kaut kāds info par package, ko izvadīs Laravel about cli komanda
         */
        AboutCommand::add('File auth', fn () => [
            'Users file' => config('fileauth.filename'),
            'Users file disk' => config('fileauth.disk'),
            'Version' => '1.0.6',
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                ListUsersCommand::class,
                CreateUserCommand::class,
                DeleteUserCommand::class,
            ]);
        }
    }
}
