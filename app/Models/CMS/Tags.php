<?php
/**
 * Created by PhpStorm.
 * User: Quyen
 * Date: 11/19/2019
 * Time: 9:07 AM
 */

namespace App\Models\CMS;
use App\Models\BaseModel;

class Tags extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cms_tags';
    protected $slugField = ['slug' => 'title'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'id',
        'title',
        'slug',
        'status',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
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

    public function getLinkProductAttribute()
    {
        return url($this->slug.'-st'.$this->id.'.html');
    }

    public function getLinkNewsAttribute()
    {
        return url($this->slug.'-nt'.$this->id.'.html');
    }
}
