<?php

namespace App\Http\Controllers\Admin\CMS;

use App\Helpers\StringHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

use App\Models\CMS\Banners;

class BannersController extends Controller
{
    public $baseModel;
    public $route = 'admin.cms.banners';

    public $filterHtml = [
        'fulltext',
    ];

    public $validateRule = [
        'title' => 'required|min:3|max:191',
        'type' => 'required',
        'image' => 'required|min:3|max:191',
    ];

    public $bannersPosition = [
        'home1' => [
            'text' => 'Banner1',
            'width' => 1535,
            'height' => 588
        ],
        'home2' => [
            'text' => 'Banner2',
            'width' => 185,
            'height' => 140
        ],
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->baseModel = new Banners();

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

        $filter = [];

        $orderBy    = $request->input('_order_by', 'ordering');
        $orderType  = $request->input('_order_type', 'ASC');
        $limit      = $request->input('_limit', 20);
        $keyword    = $request->input('keyword', '');
        $type       = $request->input('type', 'home1');

        if ($keyword) {
            $filter['keyword'] = $keyword;
        }
        if ($type) {
            $filter['type'] = $type;
        }

        $items = $this->baseModel
            ->search($filter, $orderBy, $orderType, false)
            ->paginate($limit)
            ->appends($request->except('page'));

        if ($request->ajax()) {
            return $this->processDataTable($request, $items);
        }
        return view($this->route.'.index', compact('items'))
            ->with('orderBy', $orderBy)
            ->with('orderType', $orderType)
            ->with('limit', $limit)
            ->with('type', $type)
            ->with('route', $this->route)
            ->with('bannersPosition', $this->bannersPosition);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($id, Request $request)
    {
        $this->authorize('permission', $this->route.'.edit');

        $item = $this->baseModel->find($id);

        return view($this->route.'.form', compact('item'))
            ->with('route', $this->route)
            ->with('bannersPosition', $this->bannersPosition);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create(Request $request)
    {
        $this->authorize('permission', $this->route.'.create');
        $item = $this->getCreateItem($request);

        return view($this->route.'.form')
            ->with('item', $item)
            ->with('route', $this->route)
            ->with('bannersPosition', $this->bannersPosition);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $this->authorize('permission', $this->route.'.create');

        $this->filterData($request);
        $request->validate($this->validateRule);

        $data = $request->all();
        $data['status'] = 4;
        $item = $this->baseModel->create($data);

        Session::flash('success', trans('admin.common.added_successfully'));
        if ($request->input('_action', 'save') == 'save') {
            return redirect(route($this->route) . '?type=' . $data['type']);
        }else{
            return redirect(route($this->route) . '/' . $item->id . '/edit?position=' . $data['type']);
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update($id, Request $request)
    {
        $this->authorize('permission', $this->route.'.edit');

        $this->filterData($request);
        $request->validate($this->validateRule);

        $data = $request->all();
        $this->baseModel
            ->find($id)
            ->update($data);

        Session::flash('success', trans('admin.common.updated_successfully'));
        if ($request->input('_action', 'save') == 'save') {
            return redirect(route($this->route) . '?type=' . $data['type']);
        }else{
            return redirect(route($this->route) . '/' . $id . '/edit?position=' . $data['type']);
        }
    }

    public function deleteListItem($list)
    {
        $this->authorize('permission', $this->route.'.delete');
        try {
            $ids = explode(",", $list);
            $orgIds = $this->baseModel->whereIn('id', $ids)->delete();

        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
        return $this->ajaxRespond(1, trans('admin.common.deleted_successfully'), []);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function destroy($id, Request $request)
    {
        $this->authorize('permission', $this->route.'.delete');

        $this->baseModel
            ->find($id)
            ->delete();

        return $this->ajaxRespond(1, trans('admin.common.deleted_successfully'), []);
    }
}
