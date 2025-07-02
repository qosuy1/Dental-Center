<?php

namespace App\Providers;

use App\Models\Setting;
use App\Models\Department;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator as PaginationPaginator;

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
        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }

        
        PaginationPaginator::useBootstrapFive();
        Model::unguard();
        Model::preventLazyLoading();
        // Model::preventSilentlyDiscardingAttributes();
        // Model::eagerLoadRelations();
        Model::automaticallyEagerLoadRelationships();

        // cach for settings in footer
        View::composer('components.frontend.footer', function ($view) {
            $settings = Cache::rememberForever('site_settings', function () {
                if (Setting::count() > 0)
                    return Setting::first()->toArray(); // تأكد من عدم وجود Closures
                return [] ;
            });

            $view->with('settings', (object) $settings);   // نحوله لكائن إذا أردت استخدام -> في الـ blade
        });

        // cach for departments in navbar
        View::composer('components.frontend.navbar', function ($view) {
            $all_departments_names = Cache::rememberForever('departmetns_names', function () {
                return Department::pluck('name')->toArray();
            });

            $view->with('all_departments_names', $all_departments_names);
        });
    }
}
