<?php

namespace App\Http\Controllers\Admin\CMS;

use App\Helpers\StringHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

use App\Models\CMS\Comments;

class CommentController extends Controller
{
    public $baseModel;
    public $route = 'admin.cms.comment';
    public $module = ['news' => 'Tin tức', Comments::COMMENT_SHOP_PRODUCT => 'Sản phẩm'];

    public $filterHtml = [
        //'fulltext',
    ];

    public $validateRule = [
        'name' => 'nullable|min:3|max:191',
        'mobile' => 'nullable|min:3|max:191',
        //'email' => 'required|email|min:3|max:191',
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->baseModel = new Comments();

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

        $orderBy    = $request->input('_order_by', 'updated_at');
        $orderType  = $request->input('_order_type', 'DESC');
        $limit      = $request->input('_limit', 20);
        $keyword    = $request->input('keyword', '');
        $module    = $request->input('module', Comments::COMMENT_SHOP_PRODUCT);

        $items = $this->baseModel
            ->search(['keyword' => $keyword, 'module' => $module, 'parent_id' => 0], $orderBy, $orderType, false)
            ->paginate($limit)
            ->appends($request->except('page'));

        if ($request->ajax()) {
            return $this->processDataTable($request, $items);
        }

        return view($this->route.'.index', compact('items'))
            ->with('orderBy', $orderBy)
            ->with('orderType', $orderType)
            ->with('limit', $limit)
            ->with('modules', $this->module)
            ->with('module', $module)
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
        $this->authorize('permission', $this->route.'.edit');

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

    /**
     * Reply data in list
     */
    public function reply(Request $request) {
        $this->authorize('permission', $this->route.'.create');
        $this->filterData($request);
        $user = Auth::user();

        $current_id = $request->input('current_id', 0);
        $data = $request->except('current_id');
        $data['name'] = "Admin";
        $data['email'] = $user->email;
        $data['mobile'] = $user->mobile;

        $comment = $this->baseModel->create($data);

        if ($comment) {
            $parentComment = $this->baseModel->find($current_id);
            if ($parentComment) {
                $parentComment->status = 4;
                $parentComment->save();

                return $this->ajaxRespond(1, '', []);
            }
            else {
                return $this->ajaxRespond(0, '', []);
            }
        }
    }

}
