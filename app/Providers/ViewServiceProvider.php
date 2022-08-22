<?php

namespace App\Providers;

use App\Models\Shop\Brand;
use App\Models\System\Language;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use App\Models\CMS\Category;

use App\Models\Shop\Category as ShopCategory;
use App\Models\Shop\Brand as ShopBrand;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        view()->composer('*', function ($view) use ($request)
        {
            if ($request->is('admin*')) {
                $view->with('admin_module', config('module'));

                // Load valid language in admin
                $listLanguage = Language::search()->get();
                View::share('listLanguage', $listLanguage);
            }
        });

        $homeCategory = Category::search(['featured' => 1])->first();
        View::share('homeCategory', $homeCategory);

        view()->composer('tpmeta.*', 'App\Http\View\Composers\TPMetaComposer');
        view()->composer('tpant.*', 'App\Http\View\Composers\TPMetaComposer');
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
