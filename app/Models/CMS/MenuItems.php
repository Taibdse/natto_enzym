<?php

namespace App\Models\CMS;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

class MenuItems extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cms_menu_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'menu_id',
        'parent_id',
        'title',
        'icon',
        'title',
        'link',
        'target',
        'ordering',
        'status',
    ];

    public static function search($filter = [], $orderBy = 'ID', $orderType = 'DESC', $activeOnly = true)
    {
        $query = self::select('*')->orderBy($orderBy, $orderType);

        if (isset($filter['keyword']) && $filter['keyword']){
            $query->where('name', 'LIKE', "%".$filter['keyword']."%");
        }

        if ($activeOnly) {
            $query->where('status', 4);
        }else{
            $query->where('status', '>=', 1);
        }

        return $query;
    }

    public function items()
    {
        return $this->hasMany(MenuItems::class, 'parent_id', 'id')
            ->orderBy('ordering', 'ASC');
    }
}
