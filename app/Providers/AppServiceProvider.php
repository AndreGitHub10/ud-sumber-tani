<?php

namespace App\Providers;

use Carbon\Carbon;
use Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 */
	public function register(): void
	{
		//
	}

	/**
	 * Bootstrap any application services.
	 */
	public function boot(): void
	{
		if (Config::get('redirect_https.status')) {
			URL::forceScheme('https');
		}

		config(['app.locale' => 'id']);
		Carbon::setLocale('id');
		date_default_timezone_set('Asia/Jakarta');
	}
}
