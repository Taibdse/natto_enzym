<?php

namespace App\Http\Controllers\Admin\System;

use App\Helpers\StringHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Hash;

use App\Models\System\User;
use App\Models\System\Role;
use App\Http\Requests\UserRequest;

class UsersController extends Controller
{
    public $baseModel;
    public $route = 'admin.system.users';
    public $roles;

    public $filterHtml = [
        'fulltext',
    ];

    public $validateRule = [
        'name' => 'required|min:3|max:191',
        'email' => 'required|email|min:3|max:80|unique:users',
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->baseModel = new User();
        $this->roles = Role::getSelectBox();

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
        $role_id    = $request->input('role_id', '');

        $items = $this->baseModel
            ->search(['keyword' => $keyword, 'role_id' => $role_id], $orderBy, $orderType, false)
            ->paginate($limit)
            ->appends($request->except('page'));
        if ($request->ajax()) {
            return $this->processDataTable($request, $items);
        }
        return view($this->route.'.index', compact('items'))
            ->with('orderBy', $orderBy)
            ->with('orderType', $orderType)
            ->with('limit', $limit)
            ->with('roles', $this->roles)
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
            ->with('route', $this->route)
            ->with('roles', $this->roles);
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
            ->with('route', $this->route)
            ->with('item', $item)
            ->with('roles', $this->roles);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(UserRequest $request)
    {
        $this->authorize('permission', $this->route.'.create');

        $this->filterData($request);
        $request->validate($this->validateRule);

        $data = $request->all();

        if ($request->password_new) {
            $data['password'] = Hash::make(trim($data['password_new']));
        }

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

        $rule = $this->validateRule;
        $rule['email'] = 'required|email|min:3|max:80|unique:users,email,'.$id;
        $request->validate($rule);

        $data = $request->all();
        if ($request->password_new) {
            $data['password'] = Hash::make(trim($data['password_new']));
        }

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
