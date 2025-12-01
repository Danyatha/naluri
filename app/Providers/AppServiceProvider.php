<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

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
        Blade::if('anyauth', function () {
            return Auth::guard('web')->check() || Auth::guard('admin')->check();
        });
        Blade::directive('currentuser', function ($guard = 'web') {
            return "<?php echo auth()->guard({$guard})->user(); ?>";
        });
    }
}
