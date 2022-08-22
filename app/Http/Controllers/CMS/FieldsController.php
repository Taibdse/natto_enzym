<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\CMS\Comments;
use App\Models\CMS\Fields;
use App\Models\CMS\FieldsCategory;
use App\Models\CMS\ProductLine;
use App\Models\CMS\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Builder;

class FieldsController extends Controller
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
        $this->categoryModel = new FieldsCategory();
        $this->baseModel = new Fields();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

    }

    public function project()
    {
        $categoryFeatured = $this->categoryModel->search(['featured' => 1])->get();
        $categoryLeft = $this->categoryModel->search(['parent_id' => 0])->with('children')->get();

        return view('visual.pages.works')
            ->with('categoryLeft', $categoryLeft)
            ->with('categoryFeatured', $categoryFeatured);
    }

    public function show($alias, $id, Request $request)
    {
        $item = Fields::with('categories')->findOrFail($id);

        $view = view('visual.blocks.modal_content')->with('item', $item)->render();

        return $this->ajaxRespond(1, '', $view);
    }

    public function category($slug, $id, Request $request)
    {
        $category = FieldsCategory::findOrFail($id);

        $navs = FieldsCategory::getNavigation($id);
        $items = Fields::search(['category_id' => $id])->orWhereHas('categories', function (Builder $query) use ($id) {
            $query->where('category_id', '=', $id);
        })->with('categories')->paginate(28);
        $categoryLeft = $this->categoryModel->search(['parent_id' => 0])->with('children')->get();
        $parentCategory = FieldsCategory::find($category->parent_id);

        return view('visual.pages.work-item',
            compact('navs', 'category', 'parentCategory', 'items', 'categoryLeft')
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
