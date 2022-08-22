<?php

namespace App\Models\CMS;

use App\Models\BaseModel;
use Carbon\Carbon;

class Comments extends BaseModel
{
    public const COMMENT_SHOP_PRODUCT = 'shop_product';

    protected $table = 'cms_comments';

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'content',
        'parent_id',
        'module',
        'module_item_id',
        'likes',
        'rating',
        'status',
        'created_by',
    ];

    public static function search($filter = [], $orderBy = 'ID', $orderType = 'DESC', $activeOnly = true)
    {
        $query = self::select('*')->orderBy($orderBy, $orderType);

        if (isset($filter['keyword']) && $filter['keyword']){
            $query->where('title', 'LIKE', "%".$filter['keyword']."%");
        }

        if (isset($filter['parent_id'])){
            $query->where('parent_id', $filter['parent_id']);
        }

        if (isset($filter['module']) && $filter['module']){
            $query->where('module', $filter['module']);
        }

        if (isset($filter['module_item_id']) && $filter['module_item_id']){
            $query->where('module_item_id', $filter['module_item_id']);
        }

        if (isset($filter['rating']) && $filter['rating'] !== false){
            $query->where('rating', $filter['rating']);
        }

        if (isset($filter['status']) && $filter['status'] !== false){
            $query->where('status', $filter['status']);
        }

        if ($activeOnly) {
            $query->where('status', 4);
        }else{
            $query->where('status', '>=', 1);
        }

        return $query;
    }

    public function user()
    {
        return $this->belongsTo('App\\Models\\System\\User', 'created_by');
    }

    public function children()
    {
        return $this->hasMany(Comments::class, 'parent_id')
                ->where('status', 4);
    }

    public function childrenAll()
    {
        return $this->hasMany(Comments::class, 'parent_id')
            ->where('status', '>=', 1);
    }

    public function getCreatedAtHumanAttribute()
    {
        $referDate = $this->created_at;
        return $referDate;//Carbon::create($referDate)->diffForHumans();
    }

    public static function calculateComments($module, $moduleItemId)
    {
        $items = self::search([
            'module' => $module,
            'module_item_id' => $moduleItemId,
            'parent_id' => 0,
        ])->get();

        $total = 0;
        $rating = 0;
        foreach ($items as $item) {
            $total++;
            $rating += $item->rating;
        }

        if ($module == self::COMMENT_SHOP_PRODUCT && $total) {
            $product = Product::find($moduleItemId);
            $product->comments = $total;
            $product->rating = round($rating/$total);
            $product->save();
        }
    }
}
