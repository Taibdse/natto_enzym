<?php

namespace App\Models\CMS;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

class Pages extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cms_pages';
    protected $slugField = ['slug' => 'title'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'image',
        'introtext',
        'fulltext',
        'status',
    ];

    public static function search($filter = [], $orderBy = 'ID', $orderType = 'DESC', $activeOnly = true)
    {
        $query = self::select('*')->orderBy($orderBy, $orderType);

        if (isset($filter['keyword']) && $filter['keyword']){
            $query->where('title', 'LIKE', "%".$filter['keyword']."%");
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

    public function getLinkAttribute()
    {
        return $this->slug.'-p'.$this->id.'.html';
    }
}
