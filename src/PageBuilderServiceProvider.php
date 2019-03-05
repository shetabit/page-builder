<?php

namespace Shetabit\PageBuilder;

use Illuminate\Support\ServiceProvider;

class PageBuilderServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'shetabit-pagebuilder');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'shetabit-pagebuilder');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/pagebuilder.php', 'pagebuilder');

        // Register the service the package provides.
        $this->app->singleton('pagebuilder', function ($app) {
            return new PageBuilder;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['pagebuilder'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/pagebuilder.php' => config_path('shetabit/pagebuilder.php'),
        ], 'pagebuilder.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/shetabit'),
        ], 'pagebuilder.views');*/

        $this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/shetabit-pagebuilder/assets'),
        ], 'pagebuilder.views');

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/shetabit'),
        ], 'pagebuilder.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
