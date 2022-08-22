<?php
/**
 * Created by PhpStorm.
 * User: Quyen
 * Date: 11/19/2019
 * Time: 9:07 AM
 */

namespace App\Models\CMS;

use App\Models\BaseModel;

class SEO extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cms_seo';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'id',
        'module',
        'module_item_id',
        'title',
        'image',
        'description',
    ];

    public static function search($filter = [], $orderBy = 'ID', $orderType = 'DESC', $activeOnly = true)
    {
        $query = self::select('*')->orderBy($orderBy, $orderType);

        if (isset($filter['keyword']) && $filter['keyword']) {
            $query->where('title', 'LIKE', "%".$filter['keyword']."%");
        }

        if (isset($filter['featured']) && $filter['featured']) {
            $query->where('featured', $filter['featured']);
        }

        if ($activeOnly) {
            $query->where('status', 4);
        }else{
            $query->where('status', '>=', 1);
        }

        return $query;
    }

    public static function createSEO($module, $itemId, $seo)
    {
        self::updateOrCreate(
            ['module' => $module, 'module_item_id' => $itemId],
            [
                'module' => $module,
                'module_item_id' => $itemId,
                'title' => $seo['title'] ?? '',
                'image' => $seo['image'] ?? '',
                'description' => $seo['description'] ?? '',
            ]
        );
    }
}
