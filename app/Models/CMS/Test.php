<?php

namespace App\Models\CMS;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

class Test extends BaseModel
{
    public const TYPE_PRODUCT = 1;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cms_test';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'language_id',
        'type',
        'name',
        'email',
        'score',
        'mobile',
        'gender',
        'content',
        'user_id',
        'reply',
        'status',
    ];

    public static function search($filter = [], $orderBy = 'ID', $orderType = 'DESC', $activeOnly = true)
    {
        $query = self::select('*')->orderBy($orderBy, $orderType);

        if (isset($filter['keyword']) && $filter['keyword']){
            $query->where('name', 'LIKE', "%".$filter['keyword']."%");
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
}
