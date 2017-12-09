<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
   public function sessions()
    {
        return $this->hasMany('App\Session');
    }

    public function enrollments()
    {
        return $this->hasMany('App\Enrollment');
    }

    public function scopeEnrolled($query,$user_id)
    {
        return $query->whereHas('enrollments', function ($q) use($user_id){
    		$q->where('user_id', $user_id);	
		})->get();
    }
}
