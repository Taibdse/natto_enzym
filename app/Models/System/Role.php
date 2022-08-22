<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

class Role extends BaseModel
{
    protected $orderField = 'ordering';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'permission',
        'default',
        'ordering',
        'created_by',
        'updated_by',
        'status'
    ];

    public static function search($filter = [], $orderBy = 'ordering', $orderType = 'ASC', $activeOnly = true)
    {
        $query = self::select('*')->orderBy($orderBy, $orderType);

        if (isset($filter['keyword']) && $filter['keyword']){
            $query->where('title', 'LIKE', "%".$filter['keyword']."%");
        }

        if ($activeOnly) {
            $query->where('status', 4);
        }else{
            $query->where('status', '>=', 1);
        }

        return $query;
    }

    /**
     * Get select box data
     *
     * @param string $titleField   Title field
     * @param string $defaultTitle Default first option title
     *
     * @return array
     */
    public static function getSelectBox(
        $titleField = 'title',
        $defaultTitle = '--Select Role--'
    ) {
        $items = self::search()->pluck($titleField, 'id')->toArray();
        return [-2 => '--Select Role--', -1 => 'Full Permission', 0 => 'Custom Permission', -3 => 'Permission in Groups'] + $items;
    }
}
