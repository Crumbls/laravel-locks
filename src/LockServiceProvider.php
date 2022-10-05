<?php

namespace Crumbls\Lock;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Finder\Finder;


class LockServiceProvider extends ServiceProvider
{
    public function boot()
    {
	    $this->bootPublishes();

    }

    public function register()
    {
	    $this->app->bind('lock', function($app) {
		    return new Lock();
	    });
	    $loader = \Illuminate\Foundation\AliasLoader::getInstance();
	    $loader->alias('Lock', \Crumbls\Lock\Facades\Lock::class);
	}

	/**
	 * Publish assets
	 */
	public function bootPublishes() : void {
		$this->loadMigrationsFrom(__DIR__.'/../database/migrations');

		$this->publishes([
			__DIR__.'/../database/migrations/' => database_path('migrations')
		], 'migrations');
	}


}