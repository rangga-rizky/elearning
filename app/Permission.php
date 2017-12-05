<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public function rolePermissions()
    {
        return $this->hasMany('App\RolePermission');
    }
}
