<?php

namespace App\Http\Controllers\Admin\CMS;

use App\Helpers\StringHelper;
use App\Http\Controllers\Controller;
use App\Models\CMS\VideosCourse;
use Illuminate\Http\Request;
use Session;

use App\Models\CMS\Questions;
use App\Models\CMS\Category;
use App\Models\CMS\TagsModules;
use App\Models\CMS\SEO;

class VideosCourseController extends Controller
{
    public $baseModel;
    public $route = 'admin.cms.video_course';

    public $filterHtml = [
        'fulltext',
    ];

    public $validateRule = [
        'title' => 'required|min:3|max:191',
        //'refer_link' => 'required|min:3|max:191',
        'image' => 'nullable|max:191',
        'image2' => 'nullable|max:191',
    ];

    public $selectCategory;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->baseModel = new VideosCourse();
        $this->selectCategory = (new Category())->getCategorySelect();

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
            if($request->type == 'select2') {
                return $this->ajaxRespond(1, '', $items->items());
            }

            return $this->processDataTable($request, $items);
        }

        return view($this->route.'.index', compact('items'))
            ->with('orderBy', $orderBy)
            ->with('orderType', $orderType)
            ->with('limit', $limit)
            ->with('selectCategory', $this->selectCategory)
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
            ->with('selectCategory', $this->selectCategory)
            ->with('item', $item)
            ->with('route', $this->route);
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
        $data['gallery'] = isset($data['gallery']) ? json_encode($data['gallery']) : '';
        $data['related_products'] = isset($data['related_products']) ? implode(',', $data['related_products']) : '';
        $item = $this->baseModel->create($data);

        if (isset($data['seo'])) {
            SEO::createSEO('cms_news', $item->id, $data['seo']);
        }

        TagsModules::createTags('news', $item->id, $data);

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
        $this->authorize('permission', $this->route.'.update');

        $this->filterData($request);
        $request->validate($this->validateRule);

        $data = $request->all();
        $data['gallery'] = isset($data['gallery']) ? json_encode($data['gallery']) : '';
        $data['related_products'] = isset($data['related_products']) ? implode(',', $data['related_products']) : '';
        $this->baseModel
            ->find($id)
            ->update($data);

        if (isset($data['seo'])) {
            SEO::createSEO('cms_news', $id, $data['seo']);
        }

        TagsModules::createTags('news', $id, $data);

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
