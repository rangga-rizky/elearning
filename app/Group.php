<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'name'
    ];

    public $timestamps = false;

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
        return $this->hasMany('App\UserGroup','group_id','id');
    }

    public function grades(){
        return $this->hasMany('App\Grading');
    }
}
