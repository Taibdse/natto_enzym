<?php
/**
 * Created by PhpStorm.
 * User: Quyen
 * Date: 1/13/2020
 * Time: 4:03 PM
 */

namespace App\Http\Controllers\Admin\System;

use App\Http\Controllers\Controller;
use App\Models\System\AuditLog;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public $baseModel;

    public $filterHtml = [
        'fulltext'
    ];

    public $validateRule = [];

    public function __construct()
    {
        $this->baseModel = new AuditLog();

        $this->middleware('admin');
    }
    public function view(Request $request)
    {

        $data = $this->baseModel->getLog($request->table, $request->id);

        return $this->ajaxRespond(1, '', ['data' => $data]);

    }
}