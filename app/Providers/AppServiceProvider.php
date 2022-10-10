<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\{Schema,Log,DB};
use Opcodes\LogViewer\Facades\LogViewer;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot() {
		Schema::defaultStringLength(191);
		//DB::listen(function($q) {Log::info($q->sql, $q->bindings, $q->time);});

		LogViewer::auth(function ($request) {
			return $request->user()
				&& in_array($request->user()->email, [
					'pj@pj.com',
					'talek@email.com',
					'admin@email.com',
					'cnaravadee@gmail.com',
				]);
		});
	}
}
