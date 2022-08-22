<?php

namespace App\Http\Controllers\Admin\System;

use App\Helpers\StringHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Session;
use Cache;

use App\Models\System\Role;

class CacheController extends Controller
{
    public $baseModel;
    public $route = 'admin.system.cache';

    public $filterHtml = [
        //'fulltext',
    ];

    public $validateRule = [
        'title' => 'required|min:3|max:191',
        'introtext' => 'required',
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->baseModel = new Role();

        $this->middleware('admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $this->authorize('permission', $this->route.'.view');

        // Clear cache
        if ($request->clear == 'cache') {
            Cache::flush();
            Artisan::call('cache:clear');
            Session::flash('success', 'System cache cleared successfully!');
        }

        if ($request->clear == 'views') {
            Artisan::call('view:clear');
            Session::flash('success', 'System view cleared successfully!');
        }

        if ($request->clear == 'route') {
            Artisan::call('route:clear');
            Artisan::call('config:clear');

            //Artisan::call('route:cache');
            //Artisan::call('config:cache');

            Session::flash('success', 'System route and config cleared successfully!');
        }

        return view($this->route.'.index')
            ->with('route', $this->route);
    }
}
