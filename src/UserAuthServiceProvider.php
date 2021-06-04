<?php

namespace Sparkouttech\UserAuth;

use Illuminate\Support\ServiceProvider;

class UserAuthServiceProvider extends ServiceProvider
{

    private $packagePrefix = 'user-auth';

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/resources/lang', $this->packagePrefix);
        $this->loadViewsFrom(__DIR__.'/resources/views', $this->packagePrefix);
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');

        if ($this->app->runningInConsole()) {

            $this->configPublish();
            $this->viewPublish();
            $this->assetsPublish();
            $this->langPublish();

            // Registering package commands.
            $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/config/config.php', 'user-auth');

        // Register the main class to use with the facade
        $this->app->singleton('user-auth', function () {
            return new UserAuth;
        });
    }

    // Publishing the views.
    public function viewPublish()
    {
        $this->publishes([
            __DIR__.'/resources/views' => resource_path('views/vendor/user-auth'),
        ], 'views');
    }

    // Publishing config.
    public function configPublish()
    {
        $this->publishes([
            __DIR__.'/config/config.php' => config_path('user-auth.php'),
        ], 'config');
    }

    // Publishing assets.
    public function assetsPublish()
    {
        $this->publishes([
            __DIR__.'/resources/assets' => public_path('vendor/user-auth'),
        ], 'assets');
    }

    // Publishing the translation files.
    public function langPublish()
    {
        $this->publishes([
            __DIR__.'/resources/lang' => resource_path('lang/vendor/user-auth'),
        ], 'lang');
    }

}
