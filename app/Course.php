<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title', 'description'
    ];   
    
    public function sessions()
    {
        return $this->hasMany('App\Session');
    }

    public function enrollments()
    {
        return $this->hasMany('App\Enrollment');
    }

     public function category()
    {
        return $this->belongsTo('App\CourseCategory','course_category_id');
    }


     public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function scopeEnrolled($query,$user_id)
    {
        return $query->whereHas('enrollments', function ($q) use($user_id){
    		$q->where('user_id', $user_id);	
		})->get();
    }
}
