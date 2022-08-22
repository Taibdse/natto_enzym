<?php
/**
 * Created by PhpStorm.
 * User: Quyen
 * Date: 1/10/2020
 * Time: 3:46 PM
 */

namespace App\Models\System;
use App\Models\BaseModel;


class AuditLog extends BaseModel
{
    protected $table = 'audits';

    protected $fillable = [
        'module',
        'module_item_id',
        'type_changes',
        'action',
        'after',
        'before',
        'user_agent',
        'ip_address',
        'created_by',
    ];

    public static function getLog($module, $module_item_id)
    {
        return self::with('user')
            ->where('module', $module)
            ->where('module_item_id', $module_item_id)
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public function user()
    {
        return $this->belongsTo('App\Models\System\Admin', 'created_by');
    }
}