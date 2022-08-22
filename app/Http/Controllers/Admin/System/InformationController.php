<?php

namespace App\Http\Controllers\Admin\System;

use App\Helpers\StringHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Rap2hpoutre\LaravelLogViewer\LaravelLogViewerServiceProvider;
use Illuminate\Foundation\Application;
use Session;

use App\Models\System\Role;

class InformationController extends Controller
{
    public $baseModel;
    public $route = 'admin.system.information';

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

        $laravelVersion = Application::VERSION;

        return view($this->route.'.index', compact('laravelVersion'))
            ->with('route', $this->route);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function php(Request $request)
    {
        $this->authorize('permission', $this->route.'.view');

        return (string) phpinfo();
    }
}
