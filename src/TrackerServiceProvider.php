<?php

namespace Tracker;

use Illuminate\Support\ServiceProvider;
use Tracker\controllers\TrackerController;

class TrackerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
	    $this->loadRoutesFrom(__DIR__.'/routes.php');
	    $this->loadMigrationsFrom(__DIR__.'/migrations');

	    $this->app->bind('Tracker',function(){
	    	return new TrackerController();
	    });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
