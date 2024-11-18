<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
	/**
	 * Register services.
	 */
	public function register(): void
	{
		//
	}

	/**
	 * Bootstrap services.
	 */
	public function boot(): void
	{
		View::composer(
			'main', 'App\Http\View\Composers\MenuComposer'
		);
		View::composer(
			'components.header.main', 'App\Http\View\Composers\NotifComposer'
		);
	}
}
