<?php

namespace App\Models\CMS;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

use App\Models\CMS\Category;
use App\Models\CMS\SEO;

class Fields extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cms_fields';
    protected $slugField = ['slug' => 'title'];
    protected $enableLog = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'productline_id',
        'title',
        'slug',
        'image',
        'image_intro',
        'image_home',
        'introtext',
        'fulltext',
        'text_plus',
        'featured',
        'is_hot',
        'views',
        'link_demo',
        'implement_date',
        'related_products',
        'gallery',
        'publish_at',
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

        if (isset($filter['category_id']) && $filter['category_id']){
            $query->where('category_id', Category::getChildrenIds($filter['category_id']));
        }

        if (isset($filter['tag_id']) && $filter['tag_id']){
            $query->whereHas('tags', function ($query) use ($filter) {
                $query->where('tag_id', $filter['tag_id']);
            });
        }

        if (isset($filter['slug']) && $filter['slug']){
            $query->where('slug', $filter['slug']);
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
        return $this->hasOne(FieldsCategory::class, 'id', 'category_id')->withDefault(function ($item) {
            $item->title = 'N/A';
            $item->id = 0;
        });
    }

    public function categories()
    {
        return $this->belongsToMany(FieldsCategory::class, 'cms_fields_to_categories', 'field_id', 'category_id');
    }

    public function getLinkAttribute()
    {
        return url($this->slug.'-f'.$this->id.'.html');
    }

    public function user()
    {
        return $this->belongsTo('App\\Models\\System\\Admin', 'created_by');
    }

    public function comments()
    {
        return $this->hasMany('App\\Models\\CMS\\Comments', 'module_item_id')
            ->where('module', 'news');
    }

    public function tags()
    {
        return $this->hasMany(TagsModules::class, 'module_item_id', 'id')
            ->where('module', 'news');
    }

    public function seo()
    {
        return $this->hasOne(SEO::class, 'module_item_id', 'id')->where('module', 'cms_news');
    }

    public function getRelatedProductsInfoAttribute()
    {
        $data = [];
        $products = explode(',', $this->related_products ?? '');
        foreach ($products as $product){
            if ($product) {
                $data[] = Product::find($product);
            }
        }

        return $data;
    }
}
