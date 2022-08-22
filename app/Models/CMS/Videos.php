<?php

namespace App\Models\CMS;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Videos extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cms_video';
    protected $slugField = ['slug' => 'title'];
    protected $enableLog = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'youtube_id',
        'image',
        'media_link',
        'introtext',
        'fulltext',
        'featured',
        'is_hot',
        'related_products',
        'views',
        'status',
    ];

    public static function search($filter = [], $orderBy = 'ID', $orderType = 'DESC', $activeOnly = true)
    {
        $query = self::select('*')->orderBy($orderBy, $orderType);

        if (isset($filter['keyword']) && $filter['keyword']){
            $query->where('title', 'LIKE', "%".$filter['keyword']."%");
        }

        if (isset($filter['featured']) && $filter['featured']){
            $query->where('featured', $filter['featured']);
        }

        if (isset($filter['slug']) && $filter['slug']){
            $query->where('slug', $filter['slug']);
        }

        if (isset($filter['category_id']) && $filter['category_id']){
            $query->where('category_id', $filter['category_id']);
        }

        if ($activeOnly) {
            $query->where('status', 4);
        }else{
            $query->where('status', '>=', 1);
        }

        return $query;
    }

    public function category()
    {
        return $this->hasOne(VideosCategory::class, 'id', 'category_id')->withDefault(function ($item) {
            $item->title = 'N/A';
            $item->id = 0;
        });
    }

    public function getLinkAttribute()
    {
        return url($this->slug.'-v'.$this->id.'.html');
    }

    public function getRelatedProductsInfoAttribute()
    {
        $data = [];
        $products = explode(',', $this->related_products ?? '');
        foreach ($products as $product){
            if ($product) {
//                $data[] = Product::find($product);
            }
        }

        return $data;
    }
}
