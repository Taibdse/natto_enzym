<?php

namespace App\Http\Controllers;

use App\Models\CMS\Banners;
use App\Models\CMS\Category;
use App\Models\CMS\Fields;
use Illuminate\Http\Request;
use App\Models\CMS\News;

use Auth;
use Session;

class HomeController extends Controller
{

    protected $newsModel;
    protected $categoryModel;
    protected $bannerModel;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->newsModel = new News();
        $this->categoryModel = new Category();
        $this->bannerModel = new Banners();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $news = News::search([])->limit(15)->get();
        $banner = Banners::search([])->limit(5)->get();
        return view('natto.pages.home')
            ->with('news', $news)
            ->with('banner',$banner);
    }
}
