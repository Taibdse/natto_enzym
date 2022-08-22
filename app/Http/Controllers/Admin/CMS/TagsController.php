<?php
/**
 * Created by PhpStorm.
 * User: Quyen
 * Date: 11/19/2019
 * Time: 9:06 AM
 */

namespace App\Http\Controllers\Admin\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\CMS\Tags;
use App\Models\CMS\News;
use App\Models\Contest\Contest;
use Illuminate\Support\Facades\Session;

class TagsController extends Controller
{

    public $baseModel;
    public $route = 'admin.cms.tags';

    public $filterHtml = [
        'fulltext',
    ];

    public $validateRule = [
        'title' => 'required|min:3|max:191',
        //'module' => 'required',
        //'module_item_id' => 'required|numeric',
    ];

    public function __construct()
    {

        $this->baseModel = new Tags();

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

        $listNewsAndContest = $this->getListNewsAndContest();
        $listNews = $listNewsAndContest['listNews'];
        $listContest = $listNewsAndContest['listContest'];

        return view($this->route.'.form', compact('item'))
            ->with('news', $listNews)
            ->with('contest', $listContest)
            ->with('route', $this->route);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    private function getListNewsAndContest()
    {
        // list news
        $news = News::all();
        foreach ($news as $row){
            $listNews[$row->id] = $row->title;
        }
        //list contest
        $contest = Contest::all();
        foreach ($contest as $row){
            $listContest[$row->id] = $row->title;
        }

        return ['listNews' => $listNews, 'listContest' => $listContest];
    }
    public function create(Request $request)
    {
        $this->authorize('permission', $this->route.'.create');
        $item = $this->getCreateItem($request);

        $listNewsAndContest = $this->getListNewsAndContest();
        $listNews = $listNewsAndContest['listNews'];
        $listContest = $listNewsAndContest['listContest'];

        return view($this->route.'.form')
            ->with('item', $item)
            ->with('news', $listNews)
            ->with('contest', $listContest)
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
        $item = $this->baseModel->create($data);
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
        $this->baseModel
            ->find($id)
            ->update($data);

        Session::flash('success', trans('admin.common.updated_successfully'));
        if ($request->input('_action', 'save') == 'save') {
            return redirect(route($this->route));
        }else{
            return redirect(route($this->route) . '/' . $id . '/edit');
        }
    }

    public function deleteListItem($list)
    {
        dd($list);
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
