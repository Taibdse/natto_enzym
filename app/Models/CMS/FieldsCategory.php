<?php

namespace App\Models\CMS;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;
use App\Models\CMS\SEO;

class FieldsCategory extends BaseModel
{
    public const PROMOTION_ID = 16;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cms_fields_categories';
    protected $parentField = 'parent_id';
    protected $orderField = 'ordering';
    protected $slugField = ['slug' => 'title'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'title',
        'slug',
        'icon',
        'image',
        'introtext',
        'fulltext',
        'status',
        'ordering',
        'featured',
        'views',
        'module'
    ];

    public static function search($filter = [], $orderBy = 'ordering', $orderType = 'ASC', $activeOnly = true)
    {
        $query = self::select('*')
            ->orderBy('parent_id', 'ASC')
            ->orderBy($orderBy, $orderType);

        if (isset($filter['keyword']) && $filter['keyword']){
            $query->where('title', 'LIKE', "%".$filter['keyword']."%");
        }

        if (isset($filter['parent_id'])){
            $query->where('parent_id', $filter['parent_id']);
        }

        if (isset($filter['featured'])){
            $query->where('featured', $filter['featured']);
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

    public static function getCategoryTree($module = 1, $level=0, $prefix='', $activeOnly=true, $flatTree = true) {
        $query = self::where('parent_id', $level)
            ->where('module', $module)
            ->orderBy('ordering', 'asc');
        if ($activeOnly) {
            $query->where('status', 4);
        }else{
            $query->where('status', '>=', 1);
        }

        $rows = $query->get();
        $category = array();
        if (count($rows) > 0) {
            foreach ($rows as $row) {
                if ($flatTree) {
                    $row->title = $prefix . $row->title;
                    $category[] = $row;
                    $category = array_merge($category, self::getCategoryTree($module, $row->id, $prefix . '|---', $activeOnly));

                }else{

                    $row->items = self::getCategoryTree($module, $row->id, $prefix . '', $activeOnly, $flatTree);
                    $category[] = $row;
                }
            }
        }

        return $category;
    }

    public function getCategorySelect($module = 1, $level = 0, $prefix = '', $activeOnly = true){
        $selectCat = $this->getCategoryTree($module, $level, $prefix, $activeOnly);
        $parentCat = array();
        foreach ($selectCat as $row){
            $parentCat[$row->id] = $row->title;
        }
        $selectCat = array('0' => '--- Select ---') + $parentCat;

        return $selectCat;
    }

    public function getLinkAttribute()
    {
        return $this->slug.'-fc'.$this->id.'.html';
    }

    public function news()
    {
        return $this->hasMany('App\\Models\\CMS\\News', 'category_id')->orderBy('id', 'DESC');
    }

    public function videos()
    {
        return $this->hasMany('App\\Models\\CMS\\Videos', 'category_id')->orderBy('id', 'DESC');
    }

    public function children()
    {
        return $this->hasMany('App\\Models\\CMS\\FieldsCategory', 'parent_id')->where('status', 4);
    }

    public function seo()
    {
        return $this->hasOne(SEO::class, 'module_item_id', 'id')->where('module', 'cms_category');
    }
}
