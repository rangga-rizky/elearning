<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
     protected $fillable = [
        'name', 'time','type','group_id'
    ];

    protected $public = false; 

	 public function group()
    {
        return $this->belongsTo('App\Group');
    }


     public function courses()
    {
        return $this->belongsTo('App\Course');
    }


    public function scopeByGroup($query,$groups)
    {        
        foreach ($groups as $group) {
            $group_ids[] = $group->group_id;
        }

        return $query->whereHas('group', function ($q) use($group_ids){
                $q->whereIn('group_id', $group_ids);   
            })->get();
    }

    public function scopeByCourse($query,$courses)
    {        
        foreach ($courses as $course) {
            $course_ids[] = $course->id;
        }

        return $query->whereHas('group', function ($q) use($course_ids){
                $q->whereIn('course_id', $course_ids);   
            })->get();
    }
}
