<?php

namespace PatricPoba\Mnotify;

use PatricPoba\MnotifySms;
use Illuminate\Support\ServiceProvider;
  
class MnotifyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    { 
        // Publish vendor/patricpoba/mnotify/src/Config/mnotify.php 
        // to Config/mnotify.php 
        $this->publishes([
            __DIR__.'/Config/mnotify.php' => config_path('mnotify.php'),
        ], 'mnotify_config');
  
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/Config/mnotify.php', 'mnotify'
        );

        /**
         *  'mNotifySms' will be resolve from the service container by 
         *  the Facades/SmsFacade.php
         */
        $this->app->bind('mNotifySms', function ($app){
            return new MnotifySms;
        });
    }
}
 