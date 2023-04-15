<?php

namespace App\Providers;

use App\Models\Interfaces\Contactable;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url)
    {
        Paginator::useBootstrap();
        if(env('APP_ENV') !== 'production')
        {
            $url->forceSchema('https');
        }
//        DB::listen(function ($query) {
//            $query->sql; // выполненная sql-строка
//            $query->bindings; // параметры, переданные в запрос (то, что подменяет '?' в sql-строке)
//            $query->time; // время выполнения запроса
//            Log::info([$query->sql, $query->time ]);
//        });
    }
}
