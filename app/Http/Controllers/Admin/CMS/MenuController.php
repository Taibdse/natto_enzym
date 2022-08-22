<?php

namespace App\Http\Controllers\Admin\CMS;

use App\Helpers\StringHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

use App\Models\CMS\Menu;
use App\Models\CMS\MenuItems;
use App\Models\CMS\News;
use App\Models\CMS\Category;
use App\Models\CMS\Pages;

class MenuController extends Controller
{
    public $baseModel;
    public $route = 'admin.cms.menu';

    public $filterHtml = [
        //'fulltext',
    ];

    public $validateRule = [
        'title' => 'required|min:3|max:191',
        //'email' => 'required|email|min:3|max:191',
        //'mobile' => 'required|min:3|max:191',
        //'address' => 'required|min:3|max:191',
        //'introtext' => 'required',
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->baseModel = new Menu();

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

        $orderBy    = $request->input('_order_by', 'id');
        $orderType  = $request->input('_order_type', 'DESC');
        $limit      = $request->input('_limit', 20);
        $keyword    = $request->input('keyword', '');

        $items = $this->baseModel
            ->search(['keyword' => $keyword], $orderBy, $orderType, false)
            ->paginate($limit)
            ->appends($request->except('page'));

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
            ->with('menuData', $this->getMenuData())
            ->with('route', $this->route);
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
            ->with('menuData', $this->getMenuData())
            ->with('route', $this->route);
    }

    public function getMenuData()
    {
        $data['news'] = News::search()->limit(1000)->get();
        $data['category'] = Category::search()->limit(1000)->get();
        $data['pages'] = Pages::search()->limit(1000)->get();

        return $data;
    }

    public function setMenuData($menuId, $request)
    {
        $tree = $request->input('tree');
        $label = $request->input('label');
        $link = $request->input('link');

        $excludeIds = [0];
        $newIds = [];
        if ($tree){
            parse_str($tree, $items);

            if ($items && isset($items['item'])) {
                $ordering = 1;

                foreach ($items['item'] as $id => $parent) {
                    $parent = (string) $parent;
                    $id = (string) $id;

                    if ($parent == 'null') {
                        $parentId = 0;
                    } else {
                        $parentId = intval($parent) > 0 ? $parent : (isset($newIds[$parent]) ? $newIds[$parent] : 0);
                    }

                    if (strpos($id, '0.') !== false) {
                        // Create new item
                        $menu = MenuItems::create([
                            'menu_id' => $menuId,
                            'parent_id' => $parentId,
                            'title' => $label['item_'.$id],
                            'icon' => '',
                            'link' => $link['item_'.$id],
                            'target' => '',
                            'ordering' => $ordering++,
                            'status' => 4,
                        ]);

                        $newIds[$id] = $menu->id;
                        $id = $menu->id;

                    } else {

                        MenuItems::find($id)->update([
                            'menu_id' => $menuId,
                            'parent_id' => $parentId,
                            'title' => $label['item_'.$id],
                            'icon' => '',
                            'link' => $link['item_'.$id],
                            'target' => '',
                            'ordering' => $ordering++,
                            'status' => 4,
                        ]);
                    }

                    $excludeIds[] = $id;
                }
            }
        }

        MenuItems::whereNotIn('id', $excludeIds)
            ->where('menu_id', $menuId)
            ->delete();
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
        $item = $this->baseModel->create($data);

        $this->setMenuData($item->id, $request);

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
        $this->baseModel
            ->find($id)
            ->update($data);

        $this->setMenuData($id, $request);

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
