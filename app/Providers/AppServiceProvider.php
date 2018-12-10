<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
	/**
	* Bootstrap any application services.
	*
	* @return void
	*/
	public function boot()
	{
		Schema::defaultStringLength(191);

		view()->composer('partials.navbar', function ($view) {
			$view->with('categories', \App\Category::orderBy('name')->get());
		});
	}

	/**
	* Register any application services.
	*
	* @return void
	*/
	public function register()
	{
		//
	}
}
