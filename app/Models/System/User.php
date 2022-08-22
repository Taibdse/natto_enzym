<?php

namespace App\Models\System;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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
        'mobile',
        'address',
        'avatar',
        'birthday',
        'id_number',
        'facebook_id',
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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function search($filter = [], $orderBy = 'ID', $orderType = 'DESC', $activeOnly = true)
    {
        $query = self::select('*')->orderBy($orderBy, $orderType);

        if (isset($filter['keyword']) && $filter['keyword']){
            $query->where('name', 'LIKE', "%".$filter['keyword']."%");
        }

        if (isset($filter['role_id']) && $filter['role_id']){
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

    public function getPermissionAttribute()
    {
        $role = Role::find($this->role_id);
        if ($role) {
            return $role->permission;
        }

        return '';
    }

    public function role()
    {
        return $this->belongsTo('App\Models\System\Role', 'role_id', 'id');
    }

    public static function checkEmail($email, $id = 0)
    {
        $check = self::where('email', $email);
        if ($id) {
            $check->where('id', '!=', $id);
        }

        return $check->value('email');
    }
}
