<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    
    public function assignments()
    {
        return $this->hasMany('App\Assingment');
    }

    public function quizes()
    {
        return $this->hasMany('App\Quiz');
    }

    public function lessons()
    {
        return $this->hasMany('App\Lesson');
    }

    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    
}
