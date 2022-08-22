<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\CMS\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\NotificationHelper;

use Auth;

class StaffController extends Controller
{
    public $baseModel;

    public function __construct()
    {
        $this->baseModel = new Staff();
    }

    public function index()
    {
        $items = $this->baseModel->search()->get();
        return view('visual.pages.team')->with('items', $items);
    }
}
