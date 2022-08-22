<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

use App\Models\CMS\Videos;
use App\Models\CMS\VideosCategory;


class VideosController extends Controller
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
        $this->categoryModel = new VideosCategory();
        $this->baseModel = new Videos();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $videoCategory = $this->categoryModel->search(['featured' => 0])->first();
        $audioCategory = $this->categoryModel->search(['featured' => 1])->first();

        if ($request->ajax()) {
            $type = $request->input('type', '');
            $data['type'] = $type;

            if ($type == 'video') {
                $data['items'] = $videos = $this->baseModel->search(['category_id' => $videoCategory->id])->paginate(6);
                $data['html'] = view('natto.pages.'. $type .'_items')->with('videos', $videos)->render();
                return $this->ajaxRespond(1, '', $data);
            }
            else {
                $data['items'] = $audios = $this->baseModel->search(['category_id' => $audioCategory->id])->paginate(6);
                $data['html'] = view('natto.pages.'. $type .'_items')->with('audios', $audios)->render();
                return $this->ajaxRespond(1, '', $data);
            }
        }

        $videos = $this->baseModel->search(['category_id' => $videoCategory->id])->paginate(6);
        $audios = $this->baseModel->search(['category_id' => $audioCategory->id])->paginate(6);

        return view('natto.pages.video')
            ->with('videos', $videos)
            ->with('audios', $audios);
    }

    public function show($alias, $id, Request $request)
    {
        $video = Videos::findOrFail($id);

        // Increment views
        $sessionViews = Session::get('session_views_' . $video->id, '');
        if (! $sessionViews) {
            Session::put('session_views_' . $video->id, 1);
            $video->increment('views');
        }

        $navs = VideosCategory::getNavigation($video->category_id);
        $related = Videos::search(['category_id' => $video->category_id])->limit(10)->get();

        return view('tpmeta.pages.videos_details', compact('video', 'navs', 'related'));
    }

    public function category($slug, $id, Request $request)
    {
        $category = VideosCategory::findOrFail($id);
        $navs = VideosCategory::getNavigation($id);
        $items = Videos::search(['category_id' => $id])->paginate(10);

        return view('tpmeta.pages.videos',
            compact('navs', 'category', 'items')
        );
    }
}
