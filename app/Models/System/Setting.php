<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

class Setting extends BaseModel
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'language_id',
        'language_id',
        'type',
        'key',
        'value',
        'auto_load'
    ];

    public static function search($filter = [], $orderBy = 'ID', $orderType = 'DESC', $activeOnly = true)
    {
        $query = self::select('*')->orderBy($orderBy, $orderType);

        if (isset($filter['type']) && $filter['type']){
            $query->where('type', $filter['type']);
        }

        if (isset($filter['key']) && $filter['key']){
            $query->where('key', $filter['key']);
        }

        return $query;
    }
}