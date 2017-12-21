<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function enrollments()
    {
        return $this->hasMany('App\Enrollment');
    }

    public function events()
    {
        return $this->hasMany('App\Event');
    }

    public function user_groups()
    {
        return $this->hasMany('App\UserGroup','id','group_id');
    }

    public function grades(){
        return $this->hasMany('App\Grading');
    }
}
