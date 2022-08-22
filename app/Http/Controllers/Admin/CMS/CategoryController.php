<?php

namespace App\Http\Controllers\Admin\CMS;

use App\Helpers\StringHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

use App\Models\CMS\Category;
use App\Models\CMS\SEO;

class CategoryController extends Controller
{
    public $baseModel;
    public $route = 'admin.cms.category';

    const CATEGORY_MODULE = 1;

    public $filterHtml = [
        'fulltext',
    ];

    public $validateRule = [
        'title' => 'required|min:3|max:191',
        //'image' => 'required',
        'parent_id' => 'required|numeric',
        //'introtext' => 'required',
    ];

    public $selectCategory;

    public $categoryViews = [
        0 => 'None',
        1 => 'Column',
        2 => 'List',
        3 => 'Block',
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->baseModel = new Category();

        $this->middleware('admin');

        $this->selectCategory = $this->baseModel->getCategorySelect(self::CATEGORY_MODULE);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $this->authorize('permission', $this->route.'.view');

        $orderBy    = $request->input('_order_by', 'ordering');
        $orderType  = $request->input('_order_type', 'ASC');
        $limit      = $request->input('_limit', 20);
        $keyword    = $request->input('keyword', '');

        /*$items = $this->baseModel
            ->search(['keyword' => $keyword], $orderBy, $orderType, false)
            ->paginate($limit)
            ->appends($request->except('page'));*/

        $items = $this->baseModel->getCategoryTree(self::CATEGORY_MODULE, 0, '', false);

        if ($request->ajax()) {
            return $this->processDataTable($request, $items);
        }
        return view($this->route.'.index', compact('items'))
            ->with('orderBy', $orderBy)
            ->with('orderType', $orderType)
            ->with('limit', $limit)
            ->with('route', $this->route);
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
            ->with('selectCategory', $this->selectCategory)
            ->with('route', $this->route)
            ->with('categoryViews', $this->categoryViews);
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
            ->with('selectCategory', $this->selectCategory)
            ->with('item', $item)
            ->with('route', $this->route)
            ->with('categoryViews', $this->categoryViews);
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
        $data['module'] = self::CATEGORY_MODULE;
        $item = $this->baseModel->create($data);

        if (isset($data['seo'])) {
            SEO::createSEO('cms_category', $item->id, $data['seo']);
        }

        Session::flash('success', trans('admin.common.added_successfully'));
        if ($request->input('_action', 'save') == 'save') {
            return redirect(route($this->route));
        }else{
            return redirect(route($this->route) . '/' . $item->id . '/edit');
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
        $data['module'] = self::CATEGORY_MODULE;
        $this->baseModel
            ->find($id)
            ->update($data);

        if (isset($data['seo'])) {
            SEO::createSEO('cms_category', $id, $data['seo']);
        }

        Session::flash('success', trans('admin.common.updated_successfully'));
        if ($request->input('_action', 'save') == 'save') {
            return redirect(route($this->route));
        }else{
            return redirect(route($this->route) . '/' . $id . '/edit');
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
