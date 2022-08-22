<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\CMS\Comments;
use http\Env\Request;
use Spatie\Analytics\AnalyticsFacade as Analytics;
use Spatie\Analytics\Period;

use App\Models\System\User;
use App\Models\CMS\News;
use App\Models\CMS\Contact;

use Illuminate\Support\Facades\App;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['admin', 'locale']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalContact = Contact::search()->count('id');
        $totalUser = User::search()->count('id');
        $totalNews = News::search()->count('id');

        $newUsers = User::search()->limit(10)->get();
        $newContact = Contact::search()->limit(10)->get();

        $total_visitors = Analytics::fetchTotalVisitorsAndPageViews(Period::days(21));
        $top_referrers = Analytics::fetchTopReferrers(Period::days(21));
        $user_types = Analytics::fetchUserTypes(Period::days(21));
        $top_browser = Analytics::fetchTopBrowsers(Period::days(21));
        $top_device = Analytics::performQuery(
            Period::days(21),
            'ga:users',
            [
                'dimensions' => 'ga:deviceCategory'
            ]
        );

        $top_device = is_object($top_device) ? $top_device->rows : [];
        $listDevice = [];
        foreach ($top_device as $dv){
            $listDevice[ucfirst($dv[0])] = $dv[1];
        }
        $deviceColor = [
            'Desktop' => 'success',
            'Mobile' => 'warning',
            'Tablet' => 'primary',
        ];

        $listUserTypes = [];
        foreach ($user_types as $dv){
            $listUserTypes[ucfirst($dv['type'])] = $dv['sessions'];
        }
        $userTypeColor = [
            'New Visitor' => 'success',
            'Returning Visitor' => 'primary',
        ];


        return view(
            'admin.dashboard',
            compact('totalContact',
                'totalNews', 'totalUser', 'newUsers', 'newContact',
                'total_visitors', 'top_referrers', 'top_browser', 'listDevice', 'deviceColor',
                'listUserTypes', 'userTypeColor'
            )
        );
    }

    public function counter()
    {
        $data = [];

        return $this->ajaxRespond(1, '', $data);
    }

}
