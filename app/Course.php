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

    public function events()
    {
        return $this->hasMany('App\Event');
    }


     public function grades()
    {
        return $this->hasMany('App\Grading');
    }

     public function category()
    {
        return $this->belongsTo('App\CourseCategory','course_category_id');
    }


     public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function scopeEnrolled($query,$groups)
    {        

        foreach ($groups as $group) {
            $group_ids[] = $group->group_id;
        }

        return $query->whereHas('enrollments', function ($q) use($group_ids){
                $q->whereIn('group_id', $group_ids);   
            })->get();
    }
}
