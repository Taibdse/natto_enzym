<?php

namespace App\Http\Controllers\Admin\System;

use App\Helpers\StringHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

use Session;

use App\Models\System\Role;

class BackupController extends Controller
{
    public $baseModel;
    public $route = 'admin.system.backup';

    public $filterHtml = [
        //'fulltext',
    ];

    public $validateRule = [
        'title' => 'required|min:3|max:191',
        'introtext' => 'required',
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->baseModel = new Role();

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

        if ($request->input('action') == 'backup_database') {
            $this->backupDatabase($request);
        }

        if ($request->input('action') == 'download_database') {
            return $this->downloadDatabase($request);
        }

        return view($this->route.'.index')
            ->with('route', $this->route);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function backupDatabase($request)
    {
        $fileName = 'app/public/backup_db_' . date('YmdHis').'.sql';
        $command = 'mysqldump --user='
            .env('DB_USERNAME').' --password='
            .env('DB_PASSWORD').' --host='
            .env('DB_HOST').' '.env('DB_DATABASE').' > '.storage_path($fileName);

        $process = new Process($command);
        $process->setTimeout(3600);
        $process->run();

        //if ($process->isSuccessful()) {
            Session::flash('success', 'Generate backup file successfully: <a href="'
                .route($this->route).'?action=download_database&file='
                .$fileName.'" class="btn btn-danger"><i class="la la-cloud-download"></i>'
                .$fileName.'</a>');
        //}
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function downloadDatabase($request)
    {
        $file= storage_path($request->file);

        $headers = array(
            'Content-Type: text/plain; charset=UTF-8',
        );

        return response()->download($file, basename($file), $headers);
    }
}
