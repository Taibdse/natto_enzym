<?php
namespace App\Models\System;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admins';

    const ROLE_SUPER_ADMIN = -1;
    const ROLE_CUSTOM = -1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'language_id',
        'role_id',
        'permission',
        'mobile',
        'address',
        'avatar',
        'birthday',
        'gender',
        'others',
        'created_by',
        'updated_by',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function search($filter = [], $orderBy = 'ID', $orderType = 'DESC', $activeOnly = true)
    {
        $query = self::select('*')->orderBy($orderBy, $orderType);

        if (isset($filter['keyword']) && $filter['keyword']){
            $query->where('name', 'LIKE', "%".$filter['keyword']."%");
        }

        if (isset($filter['role_id']) && $filter['role_id'] != -2 && $filter['role_id'] != ''){
            $query->where('role_id', $filter['role_id']);
        }

        if (isset($filter['start_time']) && $filter['start_time']) {
            $query->where('created_at', '>=', $filter['start_time']);
        }
        if (isset($filter['end_time']) && $filter['end_time']) {
            $query->where('created_at', '<=', $filter['end_time']);
        }

        if ($activeOnly) {
            $query->where('status', 4);
        }else{
            $query->where('status', '>=', 1);
        }

        return $query;
    }

    public function role()
    {
        return $this->belongsTo('App\Models\System\Role', 'role_id', 'id');
    }

    public function getPermissionAttribute($permission)
    {
        if ($this->role_id > 0){
            $role = Role::find($this->role_id);
            if ($role) {
                return $role->permission;
            }
        }

        return $permission;
    }
}