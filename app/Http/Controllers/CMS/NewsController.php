<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\CMS\Comments;
use App\Models\CMS\Tags;
use Illuminate\Http\Request;

use App\Models\CMS\News;
use App\Models\CMS\Category;
use Illuminate\Support\Facades\Session;

class NewsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public $categoryModel;
    public $baseModel;

    public function __construct()
    {
        //$this->middleware('auth');
        $this->categoryModel = new Category();
        $this->baseModel = new News();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

    }

    public function show($alias, $id, Request $request)
    {
        $news = News::findOrFail($id);
        $news->incrementSession('views');

        $navs = Category::getNavigation($news->category_id);
        $related = News::search(['category_id' => $news->category_id])->where('id', '<>', $id)->limit(3)->get();

        return view('natto.pages.news-detail', compact('news', 'navs', 'related'));
    }

    public function category($slug, $id, Request $request)
    {
        if ($request->ajax()) {
            $data['items'] = $news = News::search(['category_id' => $id])->paginate(6);
            $data['html'] = view('natto.pages.news_items')->with('news', $news)->render();

            return $this->ajaxRespond(1, '', $data);
        }

        $category = Category::findOrFail($id);
        $navs = Category::getNavigation($id);
        $items = News::search(['category_id' => $id])->paginate(6);
        $itemFeature = News::search(['featured' => 1, 'category_id' => $id])->first();

        return view('natto.pages.news',
            compact('navs', 'category', 'items', 'itemFeature')
        );
    }

    public function tag($slug, $id, Request $request)
    {
        $category = Tags::findOrFail($id);
        $navs = [];
        $items = News::search(['tag_id' => $id])->paginate(10);

        return view('tpmeta.pages.news',
            compact('navs', 'category', 'items')
        );
    }

    public function search(Request $request)
    {
        $filter = [];
        $keyword = $request->input('keyword', '');

        if ($keyword) {
            $filter['keyword'] = $keyword;
        }

        $categories = $this->categoryModel->search()->get();
        $resultNews = $this->baseModel->search($filter)->paginate(8);

        return view('tpnews.pages.search')->with('resultNews', $resultNews)
            ->with('categories', $categories);
    }
}
