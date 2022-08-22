<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\CMS\Category;
use App\Models\CMS\Menu;
use App\Models\CMS\News;
use App\Models\CMS\Videos;
use App\Models\CMS\Banners;
use App\Models\Shop\Category as ShopCategory;
use App\Models\Shop\Brand as ShopBrand;
use App\Models\CMS\VideosCategory;
use Cache;

class TPMetaComposer
{
    /**
     * Create a new profile composer.
     */
    public function __construct()
    {
        // Dependencies automatically resolved by service container...
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $data = Cache::remember('data.view', 60 * 24, function () {
            $globalMostReadNews = News::search([], 'views', 'DESC')->limit(5)->get();

            // For footer
            $globalLatestNews = News::search([])->limit(4)->get();
            $globalNewVideo = Videos::search([])->limit(5)->get();
            $globalNewsCategory = Category::search(['parent_id' => 0])->limit(4)->get();

            // For footer
            $globalSupport = News::search(['category_id' => 1])->get();
            $globalConsult = Category::search(['parent_id' => 2])->get();
            $globalCook = Category::search(['parent_id' => 4])->get();
            $globalGift = Category::search(['parent_id' => 5])->get();
            $globalAboutUs = News::search(['category_id' => 3])->get();

            //For Header
            $banners1 = Banners::search(['type'=>'home1'], 'ordering', 'ASC')->get();
            $banners2 = Banners::search(['type'=>'home2'], 'ordering', 'ASC')->get();
            $globalPromotion = News::search(['category_id' => Category::PROMOTION_ID])->get();

            // Load Product category
            $shopCats = ShopCategory::search(['parent_id' => 0])->get();
            $videoCats = VideosCategory::search(['parent_id' => 0])->get();

            // Load Brand
            $globalBrands = ShopBrand::search(['featured' => 1])->limit(14)->get();

            $data = [
                'banners1' => $banners1,
                'banners2' => $banners2,
                'globalPromotion' => $globalPromotion,
                'globalNewsCategory' => $globalNewsCategory,
                'globalMostRead' => $globalMostReadNews,
                'globalLatestNews' => $globalLatestNews,
                'globalNewVideo' => $globalNewVideo,
                'globalSupport' => $globalSupport,
                'globalConsult' => $globalConsult,
                'globalAboutUs' => $globalAboutUs,
                'globalCook' => $globalCook,
                'globalGift' => $globalGift,
                'shopCats' => $shopCats,
                'videoCats' => $videoCats,
                'globalBrands' => $globalBrands,
            ];

            return $data;
        });

        $view->with($data);
    }
}
