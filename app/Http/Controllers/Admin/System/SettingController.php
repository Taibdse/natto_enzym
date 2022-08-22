<?php

namespace App\Http\Controllers\Admin\System;

use App\Helpers\StringHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Session;
use Cache;

use App\Models\System\Setting;

class SettingController extends Controller
{
    public $baseModel;
    public $route = 'admin.system.setting';

    public $filterHtml = [
        //'fulltext',
    ];

    public $validateRule = [
        //'title' => 'required|min:3|max:191',
        //'introtext' => 'required',
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->baseModel = new Setting();

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

        $settings = $this->baseModel->search([
            'type' => 'system',
        ])->get()->keyBy('key');

        return view($this->route.'.form')
            ->with('settings', $settings)
            ->with('route', $this->route);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $this->authorize('permission', $this->route.'.view');

        $this->filterData($request);
        $request->validate($this->validateRule);

        $data = $request->input('setting');
        foreach ($data as $key => $value){
            $value = strip_tags(trim($value));

            $this->baseModel->updateOrCreate(
                ['type' => 'system', 'key' => $key],
                ['type' => 'system', 'key' => $key, 'value' => $value]
            );
        }

        $this->baseModel->updateOrCreate(
            ['type' => 'system', 'key' => 'version'],
            ['type' => 'system', 'key' => 'version', 'value' => time()]
        );

        Log::info('Save setting successfully');
        Cache::flush();

        Session::flash('success', trans('admin.common.updated_successfully'));
        return redirect(route($this->route));
    }
}
