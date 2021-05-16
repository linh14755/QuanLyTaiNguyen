<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    protected $guarded = [];
    use SoftDeletes;

    public function permission()
    {
        return $this->belongsToMany(Permission::class, 'permission_role', 'role_id', 'permission_id');
    }
    public function user(){
        return $this->belongsToMany(User::class, 'role_user', 'role_id', 'user_id');
    }
}
