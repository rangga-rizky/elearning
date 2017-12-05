<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    //
    public function role()
    {
        return $this->belongsTo('App/Role');
    }

    public function permission()
    {
        return $this->belongsTo('App/Permission');
    }
}
