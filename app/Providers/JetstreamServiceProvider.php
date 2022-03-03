<?php

namespace App\Providers;

//use App\Actions\Jetstream\DeleteUser;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;
use Laravel\Fortify\Fortify;
use App\Models\{User};


class JetstreamServiceProvider extends ServiceProvider
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
        $user = User::whereId('1')->get();;
        Fortify::loginView(function () use ($user) {
            return view('auth.login', ['user' => $user]);
        });

		// pj $this->configurePermissions(); */

		// pj Jetstream::deleteUsersUsing(DeleteUser::class); */

		// we now register our new classes to override the default classes for but normal login and two factor authentication
/* 		PJ $this->app->singleton(
			\Laravel\Fortify\Contracts\LoginResponse::class,
			\App\Http\Responses\LoginResponse::class
		);
		$this->app->singleton(
			\Laravel\Fortify\Contracts\TwoFactorLoginResponse::class,
			\App\Http\Responses\LoginResponse::class
		); */
	}

	/**
	 * Configure the permissions that are available within the application.
	 *
	 * @return void
	 */
	protected function configurePermissions()
	{
		Jetstream::defaultApiTokenPermissions(['read']);

		Jetstream::permissions([
			'create',
			'read',
			'update',
			'delete',
		]);
	}
}
