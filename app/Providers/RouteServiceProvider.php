<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // <-- add this

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     * Fallback if we can't determine a role.
     */
    public const HOME = '/dashboard';

    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }

    /**
     * Decide where to send the user after login/register.
     */
    public static function homeByRole(): string
    {
        $user = Auth::user();
        if (!$user) {
            return self::HOME; // not logged in, fallback
        }

        return match ($user->role) {
            'doctor' => '/doctor/dashboard',
            'patient' => '/patient/dashboard',
            default => self::HOME,
        };
    }
}
