<?php

namespace App\Models\CMS;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

class Banners extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cms_banners';
    //protected $slugField = ['slug' => 'title'];
    protected $parentField = 'type';
    protected $orderField = 'ordering';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'image',
        'content',
        'link',
        'ordering',
        'type',
        'views',
        'status',
    ];

    public static function search($filter = [], $orderBy = 'ordering', $orderType = 'ASC', $activeOnly = true)
    {
        $query = self::select('*')->orderBy($orderBy, $orderType);

        if (isset($filter['keyword']) && $filter['keyword']){
            $query->where('title', 'LIKE', "%".$filter['keyword']."%");
        }

        if (isset($filter['type']) && $filter['type']){
            $query->where('type', $filter['type']);
        }


        if ($activeOnly) {
            $query->where('status', 4);
        }else{
            $query->where('status', '>=', 1);
        }

        return $query;
    }

}
