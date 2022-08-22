<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Models\System\Setting;
use Cache;

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
    public function boot(Request $request)
    {
        //
        Schema::defaultStringLength(191);

        $settings = Cache::remember('settings', 60, function()
        {
            if(Schema::hasTable('settings')){
                $settings = Setting::pluck('value', 'key')->toArray();
                return $settings;
            }else{
                return [];
            }
        });
        config()->set('system', $settings);

//        if ( strpos($request->url(), '.vn') !== false ) {
//            URL::forceScheme('https');
//        }
    }
}
